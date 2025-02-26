<?php

//Inicio sesión para crear el usuario y validarlo. 
session_start();
require_once '../../config/conn.php';
// require_once 'functionsInsert.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $clave = $_POST['usu_docum'];
    $passwordInput = $_POST['usu_clave'];
    $rol = $_POST['rol_id'];
    //$nombre = "Jhon doe";

    //$sql = "SELECT * FROM usuarios WHERE usu_docum = :usu_docum";

    $sql = "SELECT 
    u.usu_nombre AS 'nombre',
    u.usu_clave as 'clave',
    r.rol_nombre as 'rol',
    r.rol_id as 'rol_id'
    FROM usuarios u 
    INNER JOIN roles r 
    ON u.rol_id = r.rol_id WHERE usu_docum = :usu_docum";

    $exeSql = $pdo->prepare($sql);
    $exeSql->bindParam(':usu_docum',$clave,PDO::PARAM_INT);
    $exeSql->execute();

    $user = $exeSql->fetch(PDO::FETCH_ASSOC);

    if ($user) {

            $userPassword = $user['clave'];
            $userNombre = $user['nombre'];
            //Id Del Rol
            $rolUser = $user['rol_id'];
            //Nombre del Rol
            $nombreRol = $user['rol'];
        if (password_verify($passwordInput,$userPassword)) {

            if($rolUser == $rol){
                $_SESSION['userName'] = $userNombre;
                $_SESSION['rol'] = $rolUser;
                $_SESSION['rolNombre'] = $nombreRol;

                $data = ["success" => "Bienvenido", "usuario" => $userNombre, "rol" => $rolUser, "rolNombre" => $nombreRol];
                echo json_encode($data,JSON_PRETTY_PRINT);
    
            }

            
        }else{
            echo json_encode(["error" => "Credenciales de acceso incorrectas.1"]);
            exit;
        }
    }else{
        echo json_encode(["error" => "Credenciales de acceso incorrectas."]);
        exit;
    }

    exit;

    
}


?>