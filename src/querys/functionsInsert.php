<?php 

require_once '../../config/conn.php';

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

    global $pdo;
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

    

    $sql = "INSERT INTO paciente (pac_docum,pac_nombre,pac_apellido,pac_direccion,pac_telefono,pac_email,gen_id,estr_id) VALUES (:pac_docum,:pac_nombre,:pac_apellido,:pac_direccion,:pac_telefono,:pac_email,:gen_id,:estr_id)";

    $insertNewPacient = $pdo->prepare($sql);

    $insertNewPacient->bindParam(':pac_docum',$documentoPaciente,PDO::PARAM_INT);
    $insertNewPacient->bindParam(':pac_nombre',$nombrePaciente);
    $insertNewPacient->bindParam(':pac_apellido',$apellidoPaciente);
    $insertNewPacient->bindParam(':pac_direccion',$dirreccionPaciente);
    $insertNewPacient->bindParam(':pac_telefono',$telefonoPaciente);
    $insertNewPacient->bindParam(':pac_email',$emailPaciente);
    $insertNewPacient->bindParam(':gen_id',$generoPaciente);
    $insertNewPacient->bindParam(':estr_id',$estratoPaciente);


    if ($insertNewPacient->execute()) {
        $paciente = json_encode(["success" => "Registro exitoso"]);
        
    }
    return $paciente;

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $codigoInsert = $_POST['codigoInsert'];
    $data = $_POST['data'];
    $newData = json_decode($data,true);
    
    switch ($codigoInsert) {
        case 1:
            
            //La idea de esto es guardarlo en una variable y retornarlo para enviarlo al success del ajax.
            $data = newPaciente($newData);
            echo json_encode(["success" => "Registro exitoso","data" => $data]);
            break;
            
        default:
            echo "error";
            break;
    }
}

?>