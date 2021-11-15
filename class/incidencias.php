<?php
class Incidencias
{
    private $db, $requestMethod, $userId;
    private static $valid = true;

    public function __construct($db, $requestMethod, $userId)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->userId = $userId;
    }

    public function gets()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->userId) {
                    $response = $this->incidencia($this->userId);
                } else {
                    $response = $this->mostrarIncidencias();
                };
                break;
            case 'POST':
                $response = $this->grabarIncidente();
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

    private function mostrarIncidencias()
    {
        $query = "SELECT * FROM usuarios";

        try {
            $statement = $this->db->query($query);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    private function incidencia($id)
    {
        $result = $this->find($id);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    private function grabarIncidente()
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
            $login_usuario = $pdo->prepare("SELECT * FROM usuarios WHERE email = '{$email}' AND password = '{$password}'");
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

    public function find($id)
    {
        $query = "SELECT * FROM bom_users_perfil bup
        INNER JOIN bom_users_perfil_datos bupd ON bup.wb_user_id = bupd.user_d_id
        WHERE bup.wb_user_id = '{$id}' AND bup.deleted = 0";

        try {
            $statement = $this->db->prepare($query);
            $statement->execute();
            if ($statement->rowCount() != 0) {
                $status = 'success';
                $message = $statement->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                $status  = "error";
                $message = "No existe el usuario {$id}";
            }
            $response['body'] = array(
                'status' =>  $status,
                'message' => $message
            );
            return $response;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
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
