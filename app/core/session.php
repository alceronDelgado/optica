<?php

class Session
{
  private $idRol;
  private $usu_docum;
  private $nombre;

  public function __construct(int $rol, String $usu_docum, String $nombre)
  {
    $this->idRol = $rol;
    $this->usu_docum = $usu_docum;
    $this->nombre = $nombre;
  }

  //Crear session.
  public function createSession()
  {
    session_start();
    session_regenerate_id(true);

    $_SESSION['dataUser'] = [
      'rol_id' => $this->idRol,
      'usu_docum' => $this->usu_docum,
      'nombre' => $this->nombre
    ];

    /**
     * Después puedo usar algo como esto:
     * $_SESSION['dataUser']['rol_id']
     */


    return $_SESSION['dataUser'];
  }

  //Destruir la sesión.
  /**
   * Summary of destroySession
   * @return void Cuando cierro la sesión debo de usar el headerlocation y la palabra exit();
   */
  public function destroySession()
  {
    session_start();
    $_SESSION = array();
    session_unset();
    session_destroy();
  }
}
