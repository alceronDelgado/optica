<?php 

class Conn {
    private $user;
    private $dbName;
    private $host;
    private $password;

    private $dns;

    private $pdo;

    //Constructor.
    public function __construct(){
        $this->setConnect();
    }

    //Functions
    public function setConnect(){
        
        try {
            require_once 'config.php';
            //Valido si estan definidas las variables constantes de configuración.
            if (!defined('DB_NAME') || !defined('USER') || !defined('HOST') || !defined('PASSWORD')) {
               throw new InvalidArgumentException("Faltan valores por definir para establecer conexión.", 1);
               
            }

            if (empty(DB_NAME) || empty(USER) || empty(HOST)) {
                throw new InvalidArgumentException("Las constantes de conexión están definidas pero vacías.");
            }

            $this->user = USER;
            $this->password = PASSWORD;
            $this->host = HOST;
            $this->dbName = DB_NAME;

            $this->dns = "mysql:dbname=$this->dbName;host=$this->host";
            $this->pdo = new PDO($this->dns,$this->user,$this->password, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,   //Siempre muestra mensajes de error.
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,         //Todos los resultados los devuelve con arreglos asociativos.
                PDO::ATTR_EMULATE_PREPARES   => false,       //Por defecto, prepara las consultas.     
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4" //Permitir carácteres especiales.
            ]);


        } catch (PDOException $e) {
            throw new RuntimeException("Error al conectar con la base de datos: " . $e->getMessage(), 0, $e);
        }

        
    }

    public function getConnection(){
        return $this->pdo;
    }

}


?>