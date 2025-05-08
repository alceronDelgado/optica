<?php 

/**
 * render view será un archivo que contiene una función que me va a permitir traer la url y enviarle en forma de arreglo las variables que voy a usar ahí.
 * 
 */

 class RenderView{

    private $view;

    //Renderizar solo la estructura html.
    public static function renderView(String $modules, String $fileName, array $data =[]){

        /**
         * $data = va a ser una variable arreglo que me permita enviar todas las variables que voy a usar en esa vista.
         * 
         */

        $modulesPath =  self::mapViews();

        if (!$modulesPath) {
            return null;
        }


        $view = $modulesPath[$modules] . "views/$fileName";
        
        //Debo de comprar El archivo pero con la ruta completa.
        if (file_exists($view)) {
            //ob_start();
            return $view;
            //ob_clean();

        }
        return null;
    }

    /**
     * Summary of renderHelpers
     * Esta función me sirve para renderizar el helper que sea requerido.
     * @return void
     */
    public static function renderHelpers(string $fileHelp): ?string{
        
        $files = self::mapImports();


        if (!$files) {
            return null;
        }
        $importHelper = __DIR__ . "/../helpers/$fileHelp";

        //Debo de comprar El archivo pero con la ruta completa.
        if (file_exists($importHelper)) {
        //ob_start();
            //require_once $importHelper;
        //ob_clean();
            //return $importHelper;

            return $importHelper;


        }
        return null;
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

    public static function mapImports(){
        $viewsRenders = __DIR__ . '/../helpers/';
        $filesRenders = [];
        $views = glob($viewsRenders . '*', GLOB_MARK);

        foreach ($views as $view) {
            $vi = basename($view);
            $filesRenders[$vi] = $view;
        }

        return $filesRenders;
    }

 }


?>