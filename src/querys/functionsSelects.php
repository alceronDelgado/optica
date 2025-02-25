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

function selectStratos(){
    global $pdo;

    $sql = "SELECT estr_id AS 'idEstratos', estr_nombre AS 'nombreEstrato' FROM estratos";

    $selectEstratos = $pdo->prepare($sql);
    $selectEstratos->execute();
    $data = array();
    if($selectEstratos->rowCount()>0){
        while($row = $selectEstratos->fetch()){
            $data[] = array(
                'idEstratos' => $row['idEstratos'],
                'nombreEstrato' => $row['nombreEstrato']
            );
        }
    }

    return $data;
}

function selectHobbies(){

    global $pdo;

    $sql = "SELECT hob_id as 'idHobbie', hob_nombre as 'nombreHobbie' FROM hobbies";
    $exe = $pdo->prepare($sql);
    $exe->execute();

    $data = array();
    if($exe->rowCount()>0){
        while($row = $exe->fetch()){
            $data[] = array(
                'idHobbie' => $row['idHobbie'],
                'nombreHobbie' => $row['nombreHobbie']
            );
        }
    }

    return $data;
}


?>