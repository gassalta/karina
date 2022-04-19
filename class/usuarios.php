<?php
class Usuarios
{
    private $db, $requestMethod;
    private static $valid = true;

    public function __construct($db, $requestMethod)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
    }

    public function gets()
    {
        switch ($this->requestMethod) {
            case 'POST':
                $response = $this->loginUser();
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo json_encode($response['body']);
        }
    }

    private function loginUser()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        $sanitize = $input['body'];
        if (!$this->validatePost($input)) {
            return $this->unprocessableEntityResponse();
        }
        // VALIDACION basica

        $email     = htmlspecialchars($sanitize['email']);
        $password     = htmlspecialchars(md5($sanitize['password']));

        if (empty($email) or !filter_var($email, FILTER_VALIDATE_EMAIL) and empty($password)) {
            $status  = "error";
            self::$valid = false;
        }

        if (self::$valid) {

            $pdo = $this->db;
            // Verificar usuario y contraseña que este activo
            $login_usuario = $pdo->prepare("SELECT us.id,us.nombre,us.apellido,us.imagen, un.nivel_nombre nivel FROM usuarios us
                                            INNER JOIN user_niveles un ON un.id = us.nivel
                                            WHERE email = '{$email}' AND password = '{$password}' and estado = 1");
            // Bind values

            $login_usuario->execute();

            try {
                if ($row = $login_usuario->fetch()) {
                    $id = $row['id'];
                    // Actualizar el ultimo login
                    $pdo->exec("UPDATE usuarios SET ultfechaacceso = NOW() WHERE id = {$id}");
                    // Generar sesion de usuario
                    $this->prepLogin($id, $row);
                    $status = "success";
                } else {
                    $status  = "error";
                }
            } catch (\PDOException $e) {
                exit($e->getMessage());
            }
        }

        $response['status_code_header'] = 'HTTP/1.1 200';
        $response['body'] = array(
            'status' =>  $status
        );
        return $response;
    }


    public function prepLogin($id, $row)
    {
        $_SESSION['id'] = $id;
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['apellido'] = $row['apellido'];
        $_SESSION['nivel'] = $row['nivel'];
        $_SESSION['imagen'] = $row['imagen'];
    }


    private function validatePost($input)
    {
        /* if (!isset($input['title'])) {
            return false;
        }*/
        if (!isset($input['body'])) {
            return false;
        }

        return true;
    }

    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = [
            'error' => 'Invalid input'
        ];
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}
