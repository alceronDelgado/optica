<?php 

include_once __DIR__ . '/../app/core/getUrl.php';
//Usar este archivo php como frontController o enrutador.
/**
 * La idea de este archivo es analizar el enrut
 * 
 */

 $urlObj = new Url();
 $module = $urlObj->validateModule();


 $controllerFile = "app/modules/$module/controller/{$module}Controller.php";
 if (file_exists($controllerFile)) {
    require_once $controllerFile;
 }else {
    //echo $controllerFile."<br>";
    echo "Controlador no encontrado para el módulo: $module";
}
?>
