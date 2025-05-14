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
include_once __DIR__ . '/../../login/model/modelLogin.php';
include_once __DIR__ . '/../../../core/session.php';

class LoginController
{

  private $usu_email;
  private $usu_clave;
  private $rol_id;

  private array $namesModules;
  private array $namesHelpers;

  public function __construct(String $usu_email = '', String $usu_clave = '', Int $rol_id = 0)
  {
    $this->usu_email = $usu_email;
    $this->usu_clave = $usu_clave;
    $this->rol_id = $rol_id;
  }


  //Me muestra el login, esto es solo renderizado en vista.
  public function login()
  {

    // $rol = new Rol();
    // $dataRol = $rol->fetchRol();


    $this->namesModules = RenderView::mapViews();
    //Renderiza el head de la página.

    if ($head = RenderView::renderHelpers('head.php'))  include $head;

    /**
     * $dataRol = es el arreglo que me sirve para manejar la data del formulario
     * 
     */
    if ($view = RenderView::renderView('login', 'loginFormViews.php')) include $view;


    // Renderiza la parte final de la estructura html junto a sus js
    if ($imports = RenderView::renderHelpers('imports.php')) include $imports;




    exit();
  }

  //Función para comprar datos y ejecutar.
  public function authData()
  {
    $loginModel = new ModelLogin();
    $dataUsuario = $loginModel->login($this->usu_email, $this->usu_clave, $this->rol_id);

    //Si me devuelve true, que me cree la sesión.
    if ($dataUsuario) {
      $session = new Session($dataUsuario['rol_id'], $dataUsuario['usu_email'], $dataUsuario['usu_nombre']); 
        $session->createSession();
        return true;
    }

    return false;

  }
}
