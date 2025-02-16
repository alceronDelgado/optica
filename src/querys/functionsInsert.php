<?php 


function insertNewUser($clave,$nombre,$rol, $passwordInput){
    global $pdo;
    $passwordHash = password_hash($passwordInput,PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios (usu_docum,usu_nombre,usu_clave, rol_id) VALUES (:usu_docum, :usu_nombre ,:usu_clave, :rol_id)";

    $exeInsert = $pdo->prepare($sql);

    $exeInsert->bindParam(':usu_docum',$clave,PDO::PARAM_INT);
    $exeInsert->bindParam(':usu_nombre',$nombre);
    $exeInsert->bindParam(':usu_clave',$passwordHash,PDO::PARAM_STR);
    $exeInsert->bindParam(':rol_id',$rol,PDO::PARAM_INT);

    if ($exeInsert->execute()) {
       
        $info = ["success" => "Registro exitoso"];

        echo json_encode($info);
    }

    return $info;

}

?>