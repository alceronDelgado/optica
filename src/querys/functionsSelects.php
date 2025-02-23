<?php 



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

function selectGeners(){

    global $pdo;

    $sql = "SELECT gen_id as 'genero',
    gen_nombre as 'nombreGenero' 
    FROM generos";

    $exe = $pdo->prepare($sql);

    $exe->execute();
    $data = array();
    if($exe->rowCount()>0){
        
        while ($row = $exe->fetch()) {
            $data[] = array(
                'genero' => $row['genero'],
                'nombreGenero' => $row['nombreGenero']
            );
        }
    }

    return $data;

    
}




?>