<?php

/**
 * funciones de la clase.
 * login() = debe de mostrar la vista de login
 * checkCredencialts() = función para validar que los datos digitados x el usuario y los que se encuentran en la base de datos son iguales para re direccionar a dashboard. que en este caso es index.php
 * crearSession() = función para crear la sesión.
 * cerrarSesion() = función para cerrar la sesión (debe de ser creada en el archivo Sessions.php)
 * 
 * 
 * 
 */

//Aca debe de ir todo los elementos para validar la información.
//Debo capturar la información de los datos y retornarlos para redirigir al dashboard.
include_once __DIR__ . '/../../../core/Auth.php';
include_once __DIR__ . '/../../../core/renderView.php';
$userInput = $_POST['usu_docum'];
$userPassword = $_POST['usu_clave'];
$userRol = $_POST['rol_id'];


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

class LoginController{
  private $userInput;
  private $userPassword;
  private $userRol;

  private array $namesModules;


  public function __construct() {
    //Por defecto, apenas se haga la instancia, me debe de traer el formulario.
    $this->login();
  }

  //Me muestra el login
  public function login(){
    $this->namesModules = RenderView::mapViews();
    RenderView::renderView('login','loginFormViews.php');
    
  }


}
