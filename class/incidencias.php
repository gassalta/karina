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
        if ($response) {
            echo json_encode($response);
        }
    }

    public function mostrarIncidencias()
    {
        $query = 'SELECT ins.id,ins.titulo,ins.descripcion,u.nombre,u.apellido,ua.area_nombre area, ie.est_nombre estado, ip.pri_nombre prioridad, DATE_FORMAT(ins.fecha, "%d/%m%Y %H:%i:%s") fechas FROM incidencias ins
        INNER JOIN inc_prioridades ip ON ins.prioridad = ip.pri_id 
        INNER JOIN inc_estado ie ON ins.estado = ie.est_id
        INNER JOIN usuarios u ON ins.creado_por = u.id
        INNER JOIN user_areas ua ON u.area = ua.id
        ORDER by ins.prioridad ASC;';

        try {
            $statement = $this->db->query($query);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

        $response = $result;
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
        $titulo     = htmlspecialchars($sanitize['titulo']);
        $detalles     = htmlspecialchars($sanitize['detalles']);
        $prioridad     = htmlspecialchars($sanitize['prioridad']);
        $usuario    = $_SESSION['id'];


        if (empty($titulo) and empty($detalles) and empty($prioridad)) {
            $status  = "error";
            self::$valid = false;
        }

        if (self::$valid) {

            $pdo = $this->db;

            try {
                $insertar = "INSERT INTO incidencias (titulo,descripcion,creado_por,fecha,prioridad,estado)
						   VALUES ('{$titulo}','{$detalles}','{$usuario}',NOW(),'{$prioridad}',1)";

                $incidenciaSql = $pdo->prepare($insertar);
                $incidenciaSql->execute();
                $status = 'success';
                
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
