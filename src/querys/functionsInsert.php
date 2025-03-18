<?php 

require_once '../../config/conn.php';
header('Content-Type: application/json; charset=UTF-8');

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

function newPaciente($formData){

    global $pdo;

    $documentoPaciente = (!empty($formData['documento']) && is_numeric($formData['documento'])) ? $formData['documento'] : null;
    $nombrePaciente = $formData['nombre'];
    $apellidoPaciente = $formData['apellido'];
    $direccionPaciente = $formData['direccion'];
    $telefonoPaciente = (is_numeric($formData['telefono'])) ? $formData['telefono'] : null;
    //Uso filter var para validar si el viene el campo vacio o null o si no es numerico, no aplico la condición de vacio porque ya lo valida el propio filter_var ya que si viene null o vacio, el devolvera false, empty hace lo mismo.
    $emailPaciente = (filter_var($formData['email'],FILTER_VALIDATE_EMAIL)) ? $formData['email'] : null;
    $generoPaciente = $formData['genero'];
    $estratoPaciente = $formData['estrato'];

    $hobbiesPaciente = (is_array($formData['hobbies']) && !empty($formData['hobbies'])) ? $formData['hobbies'] : [];


    $checkDocumento = $pdo->prepare("SELECT COUNT(*) FROM paciente WHERE pac_docum = :documento");
    $checkDocumento->bindParam(':documento', $documentoPaciente, PDO::PARAM_INT);
    $checkDocumento->execute();
    $docExists = $checkDocumento->fetchColumn();

    if ($docExists > 0) {
        // Si ya existe un paciente con ese documento
        echo json_encode(['error' => 'Paciente ya está registrado.']);
        exit();
    }


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

            if (!$pacienteHobiesSql->execute()) {
                throw new Exception("Error Al insertar hobbies.", 1);
                
            }
            
        }

        //Si es diferente de true, mostrar un mensaje de error.
        if (!$insertNewPacient->execute()) {
            throw new Exception("Error al registrar un nuevo paciente.");
            
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

function updatePaciente($formData,$dataLastRow){

    global $pdo;

    if (empty($formData)) {
        exit();
    }

    $dataExecute = [
        "status" => "success",
        "message" => "Datos de paciente actualizado."
    ];

    //Comparo si los valores con el método array_diff. Este método me compara solo los valores, no las claves del arreglo.
    if (empty(array_diff_assoc($formData,$dataLastRow) )) {
        echo json_encode(['status'=>'info', 'message'=> 'datos igualesS']);
        exit();

    }

    try {

        $pac_docum = (!empty($formData['documento'])) ? trim($formData['documento']) : null;
        $pac_nombre = trim($formData['nombrePaciente']);
        $pac_apellido = trim($formData['apellidoPaciente']);
        $pac_direccion = trim($formData['direccionPaciente']);
        $pac_telefono = trim($formData['telefonoPaciente']);
        $pac_email = trim($formData['emailPaciente']);
        $gen_id = trim($formData['genero']);
        $estrato = trim($formData['estrato']);
        //Valido nuevamente ya que si aplico valor ternario si empty esta vacio el va a guardarme un NULL, no un false. 
        if ($pac_docum === null) {
            echo json_encode(["error" => "El documento no puede estar vacío"]);
            exit();
        }

        //Valido que nombre, documento y teléfono no esten vacios.
        if (empty($pac_nombre) || empty($pac_apellido) || empty($pac_telefono)) {
            echo json_encode(['status'=>'error','message'=>'faltan datos obligatorios']);
            exit();
        }

        $sql= "UPDATE paciente SET pac_nombre = :pac_nombre,pac_apellido= :pac_apellido, pac_direccion= :pac_direccion, pac_telefono= :pac_telefono,pac_email= :pac_email, gen_id= :gen_id, estr_id = :estr_id WHERE pac_docum = :pac_docum";

        $sqlUpdate = $pdo->prepare($sql);
        $sqlUpdate->bindValue(":pac_docum",$pac_docum,PDO::PARAM_INT);
        $sqlUpdate->bindValue(":pac_nombre",$pac_nombre,PDO::PARAM_STR);
        $sqlUpdate->bindValue(":pac_apellido",$pac_apellido,PDO::PARAM_STR);
        $sqlUpdate->bindValue(":pac_direccion",$pac_direccion,PDO::PARAM_STR);
        $sqlUpdate->bindValue(":pac_telefono",$pac_telefono,PDO::PARAM_INT);
        $sqlUpdate->bindValue(":pac_email",$pac_email, PDO::PARAM_STR);
        $sqlUpdate->bindValue(":gen_id",$gen_id,PDO::PARAM_INT);
        $sqlUpdate->bindValue(":estr_id",$estrato,PDO::PARAM_INT);

        

        if (!$sqlUpdate->execute()) {
            //Capturo el error de la consulta
            $errorSqlUpdate = $sqlUpdate->errorInfo();

            //En caso de error, retorno el arreglo para aplicar jsonEncode.
            $dataExecute = [
                "status" => "Error",
                "message" => "Error en consulta $errorSqlUpdate"
            ];
            
            return $dataExecute;
        }

        

    } catch (\Throwable $th) {
        
        $dataExecute = [
            "status" => "error",
            "message" => "error al realizar la inserción $th"
        ];
        return $dataExecute;

    }
    return $dataExecute;

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $codigo = ($_POST['codigo'] == '1' || $_POST['codigo'] == '2') ? $_POST['codigo'] : null;
    $data = $_POST['data'];

    $formData = [];


    if($codigo == "2"){
        $data = $_POST['data'];
        //Esta variable me captura los registros anteriores al update del paciente, en caso de que se daban comparar o si no hay ningun cambio, así evitamos ejecutar un update.
        $dataLastRow = $_POST['lastRow'];
        //var_dump($dataLastRow);

        $excludeKeys = ['idHobbies','idGenero','idEstrato'];

        foreach($excludeKeys as $keys){
            unset($dataLastRow[$keys]);
        }
    }
    
    //var_dump($dataLastRow);
    $newDataArg = json_decode($data,true);

    foreach ($newDataArg as $field) {
        $formData[$field['name']] = $field['value'];
    }
    //echo '<br>';

    //var_dump($formData);
    //var_dump($dataLastRow);

    switch ($codigo) {
        //Insert
        case 1:
            
            $data = newPaciente($formData);
            break;

        //Update
        case 2:
            $data = updatePaciente($formData,$dataLastRow);
            break;
            
        default:
            $data = ["error" => "Código no válido"];
            break;
    }

    echo json_encode($data);


}

?>