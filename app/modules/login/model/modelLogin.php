<?php 


require_once __DIR__ . '/../../../config/conn.php';
require_once __DIR__ . '/repositories/userRepositories.php';
require_once __DIR__ . '/../../../core/Auth.php';

class ModelLogin {
    private $repository;

    public function __construct() {
        $conn = new Conn();
        $this->repository = new userRepositories($conn->getConnection());
    }

    public function login(string $email, string $password, int $rol): ?array {
        
        //Me trae los datos de la consulta.
        $user = $this->repository->getUserByCredentials($email, $rol);
        if (!$user) return null;

        //var_dump($user);

        //Crea una instancia de auth para comparar con los datos de la base de datos y validar.
        $Auth = new Auth($email, $password, $rol, $user);

        //var_dump($Auth);

        if ($Auth->checkCredentials()) {
        return $user; 
        }


        return null;
    }
}

?>