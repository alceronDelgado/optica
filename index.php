<?php 

include_once __DIR__ . '/app/core/getUrl.php';
//Usar este archivo php como frontController o enrutador.
/**
 * La idea de este archivo es analizar definir el modulo que voy a traer según mi necesidad, por defecto, implemento el login.
 * 
 */

 $urlObj = new Url();
 $module = $urlObj->validateModule();

 $controllerFile = __DIR__ . "/app/modules/$module/controller/{$module}Controller.php";
 if (file_exists($controllerFile)) {
    require_once $controllerFile;

    $login = new LoginController();
 }
 





?>
