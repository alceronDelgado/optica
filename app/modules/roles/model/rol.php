<?php

//Incluir conexión.
require_once __DIR__ . '/../../../config/conn.php';
//El enfoque de esta clase es renderizar las tablas genericas que solo requieran un select * from tableName
class Rol
{

    private $pdo;

    private array $data;

    public function fetchRol()
    {

        try {

            $this->pdo = new Conn();
            $conn = $this->pdo->getConnection();
            $query = "SELECT * FROM roles";
            $st = $conn->prepare($query);

            if (!$st->execute()) {
                return;
            }

            while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
                $this->data[] = $row;

            }

            return $this->data;
        } catch (PDOException $th) {
            throw new Error("Error statement" . $th->getMessage());
        }
    }
}
