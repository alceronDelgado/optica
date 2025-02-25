<?php 


function insertNewUser($clave,$nombre,$rol, $passwordInput){
    global $pdo;
    $passwordHash = password_hash($passwordInput,PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios (usu_docum,usu_nombre,usu_clave, rol_id) VALUES (:usu_docum, :usu_nombre ,:usu_clave, :rol_id)";

    $exeInsert = $pdo->prepare($sql);

    $exeInsert->bindParam(':usu_docum',$clave,PDO::PARAM_INT);
    $exeInsert->bindParam(':usu_nombre',$nombre);
    $exeInsert->bindParam(':usu_clave',$passwordHash,PDO::PARAM_STR);
    $exeInsert->bindParam(':rol_id',$rol,PDO::PARAM_INT);

    if ($exeInsert->execute()) {
       
        $info = ["success" => "Registro exitoso"];

        echo json_encode($info);
    }

    return $info;

}

function newPaciente($newData){
    
    $documentoPaciente = $newData['documentoPaciente'];
    $nombrePaciente = $newData['nombrePaciente'];
    $apellidoPaciente = $newData['apellidoPaciente'];
    $dirreccionPaciente = $newData['dirreccionPaciente'];
    $telefonoPaciente = $newData['telefonoPaciente'];
    $emailPaciente = $newData['emailPaciente'];
    $generoPaciente = $newData['generoPaciente'];
    $estratoPaciente = $newData['estratoPaciente'];

    //Esto es un arreglo.
    //TODO: buscar como insertar los arreglos en el sql en la tabla pacientes_hobbies.
    $hobbiesPaciente = $newData['hobbiesPaciente'];


    global $pdo;


}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $codigoInsert = $_POST['codigoInsert'];
    $data = $_POST['data'];
    //Decodifico el json y paso el valor de true para que me devuelva un array asociativo.
    $newData = json_decode($data,true);
    
    switch ($codigoInsert) {
        case 1:
            
            //La idea de esto es guardarlo en una variable y retornarlo para enviarlo al success del ajax.
            newPaciente($newData);
            break;
        
        default:
            # code...
            break;
    }
}

?>