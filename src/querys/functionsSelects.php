<?php 

    require_once 'config/conn.php';

    function selectRols(){

        global $pdo;

        $sql = "SELECT rol_id as 'rolesId', rol_nombre as 'nombreRol' FROM roles";

        $exe = $pdo->prepare($sql);

        $exe->execute();
        $data = array();
        if($exe->rowCount()>0){
            
            while ($row = $exe->fetch()) {
                $data[] = array(
                    'rolesId' => $row['rolesId'],
                    'nombreRol' => $row['nombreRol']
                );
            }
        }

        return $data;

    }



?>