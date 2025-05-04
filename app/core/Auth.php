<?php

require_once __DIR__ . '/app/config/conn.php';
//Esta clase debe de validar si los datos que ingreso son iguales a los de la base de datos.

//Clase que va a servir para autenticar los datos ingresados por el usuario.

/**
 * Puede que aca este la clase que valide ello y la clase que cree la sesión.
 * 
 */

class Auth
{

  private $user;

  private $password;

  private $rol;

  private $conn;

  private ?array $usuario = null;


  public function __construct(String $password, String $user, Int $rol)
  {
    $this->user = $user;
    $this->password = $password;
    $this->rol = $rol;

    //Creo una instancia de la clase.
    $conn = new Conn();
    $this->conn = $conn->getConnection();


    /**
     * Aca asigno 2 funciones que van a consultar los datos y de paso van a validar también si estos datos son correctos.
     * 
     */
    $usuario = $this->getUserByCredentials();
  }

  //Esta función me sirve para traer la información del usuario para saber si existe o no.
  public function getUserByCredentials(): ?array
  {
    $sqlQuery = "SELECT usu_nombre, usu_docum, usu_clave, rol_id FROM usuarios WHERE usu_nombre = :usu_nombre AND usu_docum = :usu_docum AND rol_id = :rol_id";

    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->bindParam(':usu_nombre', $this->user);
    $stmt->bindParam(':rol_id', $this->rol);
    $stmt->bindParam(':usu_docum', $this->user);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    return $usuario ?: null;
  }

  //
  public function checkCredentials(): bool
  {
    //Creo el objeto usuario para comparar con los datos ingresados.
    //En la variable usuario me retorna o null o un arreglo.
    if (!$this->usuario) return false;
    $passwordUser = $this->usuario['usu_clave'];
    if (!password_verify($this->password, $passwordUser)) {
      return false;
    }
    //CUANDO VAYA A REGISTRAR UN USUARIO, SI O SI DEBO DE HACER UN PASSWORD HASH CON LA OPCIÓN PASSWORD HASH_DEFAULT.

    return true;
  }

  //Función que me va a permitir hashear la contraseña, esta función la puedo usar para crear un nuevo usuario.
  /**
   * Summary of passwordHash
   * @param string $password
   * @return string Retorna el password Hasheado.
   */
  public static function passwordHash(String $password): string
  {
    return password_hash($password, PASSWORD_DEFAULT);
  }
}
