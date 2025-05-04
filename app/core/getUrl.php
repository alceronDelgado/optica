<?php

/**
 * Summary of GetUrl
 * El enfoque de esta clase es reemplazar la url y que se muestre una sola url, buscar como implementarlo usando urls amigables.
 */
class Url{
    private $module;
    private $controller = 'controller';
    private $file;
    private $accion;
    private array $urls;

    private $url;


    public function __construct() {
        $this->validateModule();
    }

    public function validateModule(){

        $url = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
        $segments = explode('/', trim($url, '/'));
        return $segments[1]??'login';
    }


}




// public function replaceUrl(String $module,String $file,String $accion){
//     $this->module = $module;
//     $this->file = $file;
//     $this->accion = $accion;
//     $this->controller = 'controller';

//     $urlRemplace = "http://localhost:8080/optometriaMvc/index.php?app/generos/controller/controllerGeneros.php?accion=eliminar";

//     if (!empty($this->module) || (!empty($this->file)) || (!empty($this->accion))) {
//         $url = "app/$this->module/$this->controller/$this->file.php";
//         $generosUrl = 'generos/view/';

//         //No funciona
//         $newUrl = str_replace($urlRemplace,$generosUrl,$url);

//         //Otra opción:
//         // $generosUrl = 'generos/view/';
//         // $baseUrl = "http://localhost:8080/optometriaMvc/index.php/";
//         // $newUrl = "$baseUrl$url";


//         //INTENTO: GUARDAR TODO EN UN ARREGLO CON UN PUSH.
//     }
    

//     return $newUrl;
// }


?>