<?php 

/**
 * render view será un archivo que contiene una función que me va a permitir traer la url y enviarle en forma de arreglo las variables que voy a usar ahí.
 * 
 */

 class RenderView{

    private $view;

    public static function renderView(String $modules, String $fileName, array $data =[]){

        /**
         * $data = va a ser una variable arreglo que me permita enviar todas las variables que voy a usar en esa vista.
         * 
         */

        $modulesPath =  self::mapViews();

        if (!$modulesPath) {
            echo 'modulos no encontrados';
            return;
        }

        $view = $modulesPath[$modules] . "/views/$fileName";

        if (file_exists($view)) {
            include $view;
        }

    }

    //Esta función sirve para mapear todos los elementos que contengan 
    public static function mapViews() {
        $viewsPath = __DIR__ . "/../modules/";
        $files = [];
        $modules = glob($viewsPath . '*', GLOB_MARK);

        foreach ($modules as $modulePath) {
            $moduleName = basename($modulePath);
            $files[$moduleName] = $modulePath;

        }

        return $files;

    }


 }


?>