<?php 
//Esta clase va a hacer la consulta a la base de datos y retornará la data.
class userRepositories {
    private $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    /**
     * Esta función me trae el registro si es que hay una comparativa entre ambos.
     * @param string $email
     * @param int $rol
     * @throws \Exception
     */
    public function getUserByCredentials(string $email, int $rol): ?array {
        try {
            $sqlQuery = "SELECT usu_nombre, usu_email, usu_clave, rol_id FROM usuarios WHERE rol_id = :rol_id AND usu_email = :usu_email";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(':usu_email', $email);
            $stmt->bindParam(':rol_id', $rol);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario ?: null;
        } catch (PDOException $e) {
            throw new Exception("Error al consultar usuario: " . $e->getMessage());
        }
    }
}

?>