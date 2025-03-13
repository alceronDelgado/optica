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
    $direccionPaciente = $newData['direccionPaciente'];
    $telefonoPaciente = (is_numeric($newData['telefonoPaciente'])) ? $newData['telefonoPaciente'] : null;
    //Uso filter var para validar si el viene el campo vacio o null o si no es numerico, no aplico la condición de vacio porque ya lo valida el propio filter_var ya que si viene null o vacio, el devolvera false, empty hace lo mismo.
    $emailPaciente = (filter_var($newData['emailPaciente'],FILTER_VALIDATE_EMAIL)) ? $newData['emailPaciente'] : null;
    $emailPaciente = $newData['emailPaciente'];
    $generoPaciente = $newData['generoPaciente'];
    $estratoPaciente = $newData['estratoPaciente'];
    $documentoPaciente = (filter_var($newData['documentoPaciente'], FILTER_VALIDATE_INT)) ? $newData['documentoPaciente'] : null;


    //Esto es un arreglo. Si el arreglo no está vacio que me guarde la info enviada x POST a esa variable, en caso contrario, que me guarde un arreglo vacio sin más.
    $hobbiesPaciente = (!empty($newData['hobbiesPaciente'])) ? $newData['hobbiesPaciente'] : [];

    try {
            //Como vamos a insertar datos en multiples tablas, lo recomendable en pdo es usar la palabra reservada getTransation, esto hace que si hay un error, se puede revertir las operaciones si alguna falla.
            $pdo->beginTransaction();

            $sql = "INSERT INTO paciente (pac_docum,pac_nombre,pac_apellido,pac_direccion,pac_telefono,pac_email,gen_id,estr_id) VALUES (:pac_docum,:pac_nombre,:pac_apellido,:pac_direccion,:pac_telefono,:pac_email,:gen_id,:estr_id)";

            $insertNewPacient = $pdo->prepare($sql);
        
            $insertNewPacient->bindParam(':pac_docum',$documentoPaciente,PDO::PARAM_INT);
            $insertNewPacient->bindParam(':pac_nombre',$nombrePaciente);
            $insertNewPacient->bindParam(':pac_apellido',$apellidoPaciente);
            $insertNewPacient->bindParam(':pac_direccion',$direccionPaciente);
            $insertNewPacient->bindParam(':pac_telefono',$telefonoPaciente);
            $insertNewPacient->bindParam(':pac_email',$emailPaciente);
            $insertNewPacient->bindParam(':gen_id',$generoPaciente,PDO::PARAM_INT);
            $insertNewPacient->bindParam(':estr_id',$estratoPaciente,PDO::PARAM_INT);


            if (!$insertNewPacient->execute()) {
                throw new Exception('Error al insertar paciente');
            }

            //Antes de usar implode recomendable validar si los datos que vamos a unir en una cadena de texto sea de tipo arreglo. 
            if (!empty($hobbiesPaciente)) {
                $placeHolders = [];
                $values = [];
                foreach($hobbiesPaciente as $hobby){
                    //Se colocan 2 ? que hacen referencia al número de columnas, si tenemos 5 columnas colocamos (?,?,?,?,?).
                    $placeHolders[] = '(?,?)';
                    $values[] = $documentoPaciente;
                    $values[] = $hobby;
                }


                $pacienteHobies = "INSERT INTO paciente_hobbies (pac_id,hob_id) VALUES".implode(", ",$placeHolders);


                $pacienteHobiesSql = $pdo->prepare($pacienteHobies);

                //Todo: Se aplica pero su conocimiento es bajo, investigar.
                foreach ($values as $inicio => $value) {
                    $pacienteHobiesSql->bindValue($inicio+1,$value,PDO::PARAM_INT);
                }

                //Si es diferente de true, mostrar un mensaje de error.
                if (!$pacienteHobiesSql->execute()) {
                    throw new Exception('Error al insertar hobby');
                }
            }

            $pdo->commit();

            $paciente = json_encode(["success" => "Registro exitoso"]);
        
    } catch (Exception $th) {
        //En caso de que haya un error en la ejecución de la consulta, hago un rollback al commit que hice de la transacción.
        $pdo->rollBack();

        $paciente = json_encode(['error' => $th->getMessage()]);
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