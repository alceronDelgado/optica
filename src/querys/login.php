<?php

//Inicio sesión para crear el usuario y validarlo. 
session_start();
require_once '../../config/conn.php';
require_once 'functionsInsert.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $clave = $_POST['usu_docum'];
    $passwordInput = $_POST['usu_clave'];
    $rol = $_POST['rol_id'];
    $nombre = "Jhon doe";

    $sql = "SELECT * FROM usuarios WHERE usu_docum = :usu_docum";

    $exeSql = $pdo->prepare($sql);
    $exeSql->bindParam(':usu_docum',$clave,PDO::PARAM_INT);
    $exeSql->execute();

    $user = $exeSql->fetch(PDO::FETCH_ASSOC);

    if ($user) {

            $userPassword = $user['usu_clave'];
            $userNombre = $user['usu_nombre'];
            $rolUser = $user['rol_id'];
        if (password_verify($passwordInput,$userPassword)) {

            if($rolUser == $rol){
                $_SESSION['userName'] = $userNombre;
                $_SESSION['rol'] = $rolUser;
                $data = ["success" => "Bienvenido", "usuario" => $userNombre, "rol" => $rolUser];
                echo json_encode($data);
    
            }

            
        }else{
            echo "error";
        }
    }else{
        echo json_encode(["error" => "datos incorrectos"]);
    }

    exit;

    
}


?>