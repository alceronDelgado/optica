<?php

//require_once __DIR__ . '/../config/conn.php';
//Esta clase debe de validar si los datos que ingreso son iguales a los de la base de datos.

//Clase que va a servir para autenticar los datos ingresados por el usuario.

/**
 * Puede que aca este la clase que valide ello y la clase que cree la sesión.
 * 
 */

class Auth
{

  private $email;

  private $password;

  private $rol;

  private $conn;

  private ?array $usuario = null;


  public function __construct(string $email, string $password, int $rol, ?array $usuario = null)
  {
    $this->email = $email;
    $this->password = $password;
    $this->rol = $rol;
    $this->usuario = $usuario;
  }

  /**
   * Summary of checkCredentials Esta función me debe de comparar los datos enviados por el usuario con los de la base de datos, retornar un true en caso de esos datos sean iguales y la password hasheada también.
   * @return bool
   */
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

    //Este error log lo puse para saber si me esta validando todo con la contraseña... lo encuentro en el xampp.
    error_log('Login exitoso');

   


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
