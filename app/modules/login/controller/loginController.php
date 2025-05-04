<?php
//Aca debe de ir todo los elementos para validar la información.
//Debo capturar la información de los datos y retornarlos para redirigir al dashboard.
include_once __DIR__ . '/app/core/Auth.php';

$userInput = $_POST['usu_docum'];
$userPassword = $_POST['usu_clave'];
$userRol = $_POST['rol_id'];

echo 'hello world controller login';
echo "Controlador LOGIN cargado correctamente.";

if (empty($userInput) || empty($userPassword) || empty($userRol)) {
  return false;
}

//Creo el objeto Auth
$auth = new Auth($userPassword, $userInput, $userRol);

//Valido las credenciales, si existe, debe redireccionar.
if ($auth->checkCredentials()) {
  //Acá redirecciono y creo la session.
  $session = new Session($rol, $userInput, $userNombre);
  $session->createSession();
  //redirecciono.
  header('location:/dashboard.php');
  exit();
} else {
  //Muestro un mensaje de error.
}
