<?php

require_once __DIR__ . '/../../../config/conn.php';

class HistoriaModel{
    private $pdo;

    //Constructor, se crea en caso de que se requiera.
    public function __construct() {}


    //Functions.
 
    //public function addHistoria(Array $data= []){
    public function addHistoria($formData = []){

        $conn =  new Conn();
        $this->pdo = $conn->getConnection();


    global $pdo;

    $sql = "INSERT INTO historias (hist_esfod, hist_cilod, hist_ejeod, hist_diaod, hist_esfoi, hist_ciloi, hist_ejeoi, hist_diaoi, hist_recom, hist_motv, pac_id) 
            VALUES (:hist_esfod, :hist_cilod, :hist_ejeod, :hist_diaod, :hist_esfoi, :hist_ciloi, :hist_ejeoi, :hist_diaoi, :hist_recom, :hist_motv, :pac_id)";


    $insertHistory = $this->pdo->prepare($sql);

    // Vincular parámetros
    $insertHistory->bindParam(':hist_esfod', $formData['hist_esfod'], PDO::PARAM_STR);
    $insertHistory->bindParam(':hist_cilod', $formData['hist_cilod'], PDO::PARAM_STR);
    $insertHistory->bindParam(':hist_ejeod', $formData['ejeOd'], PDO::PARAM_STR);
    $insertHistory->bindParam(':hist_diaod', $formData['hist_diaod'], PDO::PARAM_STR);
    $insertHistory->bindParam(':hist_esfoi', $formData['hist_esfoi'], PDO::PARAM_STR);
    $insertHistory->bindParam(':hist_ciloi', $formData['hist_ciloi'], PDO::PARAM_STR);
    $insertHistory->bindParam(':hist_ejeoi', $formData['hist_ejeoi'], PDO::PARAM_STR);
    $insertHistory->bindParam(':hist_diaoi', $formData['hist_diaoi'], PDO::PARAM_STR);
    $insertHistory->bindParam(':hist_recom', $formData['hist_recom'], PDO::PARAM_STR);
    $insertHistory->bindParam(':hist_motv', $formData['hist_motv'], PDO::PARAM_STR);
    $insertHistory->bindParam(':pac_id', $formData['pac_id'], PDO::PARAM_STR);


    if ($insertHistory->execute()) {
        //$info = ["success" => "Registro exitoso"];
        $info = ["status" => "success", "message" => "Historia agregada con exito."];
    }

    json_encode($info);
    return $info;
}
}


?>