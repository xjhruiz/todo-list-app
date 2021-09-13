<?php
ini_set('display_errors', 1);
ini_set('log_errors', 'on');
ini_set('display_startup_errors', 'on');
ini_set('error_reporting', E_ALL);

class Model extends Config
{
    private $db;
    private $dbhost;
    private $dbname;
    private $dbuser;
    private $dbpass;

    public function __construct()
    {
        $this->dbhost = Config::$BD_HOSTNAME;
        $this->dbname = Config::$DB_NAME;
        $this->dbuser = Config::$DB_USER;
        $this->dbpass = Config::$DB_PASSWORD;
    }

    public function connection()
    {
        try {
            $con = "mysql:host={$this->dbhost};port=3306;dbname={$this->dbname};charset=utf8";
            $errorPDO = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $pdo = new PDO($con, $this->dbuser, $this->dbpass, $errorPDO);
        } catch (PDOException $e) {
            print_r("¡Error connection ! " . $e->getMessage());
        }
        return $pdo;
    }
    public function __destroy()
    {
        $this->db->null;
    }

    public function checkLogin($name, $password)
    {
        $sql = "SELECT id, nombre, nombreUsuario FROM USERS WHERE nombreUsuario = ? and password =  md5( ? )";
        try {
            $statement = $this->connection()->prepare($sql);
            $statement->bindParam(1, $name, PDO::PARAM_STR);
            $statement->bindParam(2, $password, PDO::PARAM_STR);
            $statement->execute();
            $data = array();
            if ($statement->rowCount()) {
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $data = $row;
                }
                return $data;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r("¡Error to run query ! " . $e->getMessage());
        }
    }

    public function listTask($tableName)
    {
        $sql = "SELECT * FROM " . $tableName;
        try {
            $statement = $this->connection()->query($sql);
            $statement->execute();
            $data = array();
            if ($statement->rowCount()) {
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r("¡Error to run query ! " . $e->getMessage());
        }
    }

    public function listNombreIdUser()
    {
        $sql = "SELECT id, nombreUsuario FROM users";
        try {
            $statement = $this->connection()->query($sql);
            $statement->execute();
            $data = array();
            if ($statement->rowCount()) {
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r("¡Error to run query ! " . $e->getMessage());
        }
    }

    public function insertTask($nombre, $descripcion, $estado)
    {
        $sqlInsert = "INSERT INTO tasks (nombre, descripcion, estado) values ( ?, ? , ?)";
        try {
            $statement = $this->connection()->prepare($sqlInsert);
            $statement->bindParam(1, $nombre, PDO::PARAM_STR);
            $statement->bindParam(2, $descripcion, PDO::PARAM_STR);
            $statement->bindParam(3, $estado, PDO::PARAM_STR);
            $statement->execute();
            if ($statement->rowCount() < 1) {
                return false;
            }
            return true;
        } catch (PDOException $e) {
            print_r("¡Error to run query insertTask ! " . $e->getMessage());
            return false;
        }
    }
    public function updateStatuTask($estado, $idTask)
    {
        $sqlUpdate = "UPDATE TASKS SET estado = ? WHERE id = ?";
        try {
            $statement = $this->connection()->prepare($sqlUpdate);
            $statement->bindParam(1, $estado, PDO::PARAM_STR);
            $statement->bindParam(2, $idTask, PDO::PARAM_INT);
            $statement->execute();
            if ($statement->rowCount() < 1) {
                return false;
            }
            return true;
        } catch (PDOException $e) {
            print_r("¡Error to run query updateStatuTask ! " . $e->getMessage());
            return false;
        }
    }

    public function deleteTask($idTask)
    {
        $sqlDelete = "DELETE FROM TASKS WHERE id = ?";
        try {
            $statement = $this->connection()->prepare($sqlDelete);
            $statement->bindParam(1, $idTask, PDO::PARAM_INT);
            $statement->execute();
            if ($statement->rowCount() < 1) {
                return false;
            }
            return true;
        } catch (PDOException $e) {
            print_r("¡Error to run query deleteTask ! " . $e->getMessage());
            return false;
        }
    }
    
    //la parte de asginar las tareas a los usuarios y a los grupos no lo implemente, 
    // es un simple todolist que en un principio como lo implementé fue añadir tareas y modificar el estado de estas tareas de pendiente a completada, 
    // y poder eliminar aquellas que no quiera tenerlas registradas
    // si se quiere añadir mayor complejitdad a la app como añadir tareas a grupos de usuarios o a usuarios.
    //se debería de asociar una tarea a un usuario o grupos esta asociación entre tareas y usuarios o grupo, implicaría la creación  una tabla que guarde la referencia de la tarea y el grupo o e usuaraio
    // y en la tabla que muestra todoas las tareas, se tendría que cambiar y mostrar todas las tareas que esten o no asociadas a un grupo o a un usuario.
    // además un usuario puede pertenecer a un grupo o a varios, otra relación que implica la creación de una tabla auxiliar en la que se registre el id del usuario y el id del grupo
    // toda esta complejidad añadida implicaría crear más vistas, una que me permita asociar la tarea a un grupo o a un usuario, 
    // y un usuario a un grupo.
    public function asignarTareaAgrupo($idTask, $idGroup)
    {
        $sqlInsert = "INSERT INTO tasks_groups (id_tarea, id_grupo) values (?, ? ) ";
        try {
            $statement = $this->connection()->prepare($sqlInsert);
            $statement->bindParam(1, $idTask, PDO::PARAM_INT);
            $statement->bindParam(1, $idGroup, PDO::PARAM_INT);
            $statement->execute();
            if ($statement->rowCount() < 1) {
                return false;
            }
            return true;
        } catch (PDOException $e) {
            print_r("¡Error to run query deleteTask ! " . $e->getMessage());
            return false;
        }
    }

    public function asignarTareaAUsuario($idTask, $idUsuario)
    {
        $sqlInsert = "INSERT INTO tasks_groups (id_tarea, id_grupo) values (?, ? ) ";
        try {
            $statement = $this->connection()->prepare($sqlInsert);
            $statement->bindParam(1, $idTask, PDO::PARAM_INT);
            $statement->bindParam(1, $idUsuario, PDO::PARAM_INT);
            $statement->execute();
            if ($statement->rowCount() < 1) {
                return false;
            }
            return true;
        } catch (PDOException $e) {
            print_r("¡Error to run query deleteTask ! " . $e->getMessage());
            return false;
        }
    }
}
