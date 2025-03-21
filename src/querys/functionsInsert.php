<?php

use function PHPSTORM_META\type;

require_once '../../config/conn.php';
header('Content-Type: application/json; charset=UTF-8');

function insertNewUser($clave, $nombre, $rol, $passwordInput)
{
    global $pdo;
    $passwordHash = password_hash($passwordInput, PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios (usu_docum,usu_nombre,usu_clave, rol_id) VALUES (:usu_docum, :usu_nombre ,:usu_clave, :rol_id)";

    $exeInsert = $pdo->prepare($sql);

    $exeInsert->bindParam(':usu_docum', $clave, PDO::PARAM_INT);
    $exeInsert->bindParam(':usu_nombre', $nombre);
    $exeInsert->bindParam(':usu_clave', $passwordHash, PDO::PARAM_STR);
    $exeInsert->bindParam(':rol_id', $rol, PDO::PARAM_INT);

    if ($exeInsert->execute()) {

        $info = ["success" => "Registro exitoso"];

        echo json_encode($info);
    }

    return $info;
}

function newPaciente($formData)
{

    global $pdo;


    //var_dump($formData);

    $documentoPaciente = (!empty($formData['documento']) && is_numeric($formData['documento'])) ? $formData['documento'] : null;
    $nombrePaciente = $formData['nombrePaciente'];
    $apellidoPaciente = $formData['apellidoPaciente'];
    $direccionPaciente = $formData['direccionPaciente'];
    $telefonoPaciente = (is_numeric($formData['telefonoPaciente'])) ? $formData['telefonoPaciente'] : null;
    //Uso filter var para validar si el viene el campo vacio o null o si no es numerico, no aplico la condición de vacio porque ya lo valida el propio filter_var ya que si viene null o vacio, el devolvera false, empty hace lo mismo.
    $emailPaciente = (filter_var($formData['emailPaciente'], FILTER_VALIDATE_EMAIL)) ? $formData['emailPaciente'] : null;
    $generoPaciente = $formData['genero'];
    $estratoPaciente = $formData['estrato'];

    $hobbiesPaciente = (is_array($formData['hobbies']) && !empty($formData['hobbies'])) ? $formData['hobbies'] : [];
    $est_id = 1;


    //Creo sentencia que me permita saber si ya existe el dato en la bd.
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

        $sql = "INSERT INTO paciente (pac_docum,pac_nombre,pac_apellido,pac_direccion,pac_telefono,pac_email,gen_id,estr_id,est_id) VALUES (:pac_docum,:pac_nombre,:pac_apellido,:pac_direccion,:pac_telefono,:pac_email,:gen_id,:estr_id,:est_id)";

        $insertNewPacient = $pdo->prepare($sql);

        $insertNewPacient->bindParam(':pac_docum', $documentoPaciente, PDO::PARAM_INT);
        $insertNewPacient->bindParam(':pac_nombre', $nombrePaciente);
        $insertNewPacient->bindParam(':pac_apellido', $apellidoPaciente);
        $insertNewPacient->bindParam(':pac_direccion', $direccionPaciente);
        $insertNewPacient->bindParam(':pac_telefono', $telefonoPaciente);
        $insertNewPacient->bindParam(':pac_email', $emailPaciente);
        $insertNewPacient->bindParam(':gen_id', $generoPaciente, PDO::PARAM_INT);
        $insertNewPacient->bindParam(':estr_id', $estratoPaciente, PDO::PARAM_INT);
        $insertNewPacient->bindParam(':est_id', $est_id, PDO::PARAM_INT);


        //Antes de usar implode recomendable validar si los datos que vamos a unir en una cadena de texto sea de tipo arreglo. 
        if (!empty($hobbiesPaciente)) {
            $placeHolders = [];
            $values = [];
            foreach ($hobbiesPaciente as $hobby) {
                //Se colocan 2 ? que hacen referencia al número de columnas, si tenemos 5 columnas colocamos (?,?,?,?,?).
                $placeHolders[] = '(?,?)';
                $values[] = $documentoPaciente;
                $values[] = $hobby;
            }
            $pacienteHobies = "INSERT INTO paciente_hobbies (pac_id,hob_id) VALUES" . implode(", ", $placeHolders);
            $pacienteHobiesSql = $pdo->prepare($pacienteHobies);
            //Todo: Se aplica pero su conocimiento es bajo, investigar.
            foreach ($values as $inicio => $value) {
                $pacienteHobiesSql->bindValue($inicio + 1, $value, PDO::PARAM_INT);
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

function updatePaciente($formData, $dataLastRow)
{

    global $pdo;

    if (empty($formData)) {
        exit();
    }

    $dataExecute = [
        "status" => "success",
        "message" => "Datos de paciente actualizado."
    ];


    //Comparo si los valores con el método array_diff. Este método me compara solo los valores, no las claves del arreglo.
    if (empty(array_diff_assoc($formData, $dataLastRow))) {
        echo json_encode(['status' => 'info', 'message' => 'datos igualesS']);
        exit();
    }

    try {

        $pdo->beginTransaction();

        $pac_docum = (!empty($formData['documento'])) ? trim($formData['documento']) : null;
        //Valido nuevamente ya que si aplico valor ternario si empty esta vacio el va a guardarme un NULL, no un false. 
        if ($pac_docum === null) {
            echo json_encode(["error" => "El documento no puede estar vacío"]);
            exit();
        }
        $pac_nombre = trim($formData['nombrePaciente']);
        $pac_apellido = trim($formData['apellidoPaciente']);
        $pac_direccion = trim($formData['direccionPaciente']);
        $pac_telefono = trim($formData['telefonoPaciente']);
        $pac_email = trim($formData['emailPaciente']);
        $gen_id = trim($formData['genero']);
        $estrato = trim($formData['estrato']);
        //Capturo id Hobbies del formulario para comprar si ya están registrados o no.
        $idHobbies = is_array($formData['hobbies']) ? $formData['hobbies'] : explode(',', $formData['hobbies']);

        //Valido que nombre, documento y teléfono no esten vacios.
        if (empty($pac_nombre) || empty($pac_apellido) || empty($pac_telefono)) {
            echo json_encode(['status' => 'error', 'message' => 'faltan datos obligatorios']);
            exit();
        }

        $selectHobbies = "SELECT 
            ph.pac_id AS 'idDocumentopaciente',
            ph.hob_id AS 'idHobbie'
            FROM paciente_hobbies ph
            INNER JOIN paciente p ON
            p.pac_docum = ph.pac_id 
            WHERE ph.pac_id = :pac_docum";

        $stmSelect = $pdo->prepare($selectHobbies);
        $stmSelect->bindValue('pac_docum', $pac_docum);
        $stmSelect->execute();

        $hobbies = $stmSelect->fetchAll(PDO::FETCH_ASSOC);

        //Esta es la consulta que se realizó en base al paciente, para saber cuales son las transacciones que se deben de hacer y cuales no.
        $hobbiesRegistrados = array_column($hobbies, 'idHobbie');

        $hobbiesParaInsertar = array_diff($idHobbies, $hobbiesRegistrados);

        $hobbiesParaEliminar = array_diff($hobbiesRegistrados, $idHobbies);


        if (!empty($hobbiesParaInsertar)) {
            $insertQuery = "INSERT INTO paciente_hobbies (pac_id, hob_id) VALUES ";
            $insertValues = [];
            $params = [];

            foreach ($hobbiesParaInsertar as $index => $hobbie) {
                $insertValues[] = "(:pac_id, :hob_id$index)";
                $params[":hob_id$index"] = $hobbie;
            }

            $insertQuery .= implode(", ", $insertValues);
            $stmtInsert = $pdo->prepare($insertQuery);
            $stmtInsert->bindValue(":pac_id", $pac_docum, PDO::PARAM_INT);

            foreach ($params as $key => $value) {
                $stmtInsert->bindValue($key, $value, PDO::PARAM_INT);
            }

            $stmtInsert->execute();
        }

        if (!empty($hobbiesParaEliminar)) {
            $placeholders = implode(',', array_fill(0, count($hobbiesParaEliminar), '?'));
            $deleteQuery = "DELETE FROM paciente_hobbies WHERE pac_id = ? AND hob_id IN ($placeholders)";
            $stmtDelete = $pdo->prepare($deleteQuery);

            $stmtDelete->execute(array_merge([$pac_docum], $hobbiesParaEliminar));
        }

        $sql = "UPDATE paciente SET pac_nombre = :pac_nombre,pac_apellido= :pac_apellido, pac_direccion= :pac_direccion, pac_telefono= :pac_telefono,pac_email= :pac_email, gen_id= :gen_id, estr_id = :estr_id WHERE pac_docum = :pac_docum";

        $sqlUpdate = $pdo->prepare($sql);
        $sqlUpdate->bindValue(":pac_docum", $pac_docum, PDO::PARAM_INT);
        $sqlUpdate->bindValue(":pac_nombre", $pac_nombre, PDO::PARAM_STR);
        $sqlUpdate->bindValue(":pac_apellido", $pac_apellido, PDO::PARAM_STR);
        $sqlUpdate->bindValue(":pac_direccion", $pac_direccion, PDO::PARAM_STR);
        $sqlUpdate->bindValue(":pac_telefono", $pac_telefono, PDO::PARAM_INT);
        $sqlUpdate->bindValue(":pac_email", $pac_email, PDO::PARAM_STR);
        $sqlUpdate->bindValue(":gen_id", $gen_id, PDO::PARAM_INT);
        $sqlUpdate->bindValue(":estr_id", $estrato, PDO::PARAM_INT);



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
        $pdo->commit();
    } catch (\Throwable $th) {

        $dataExecute = [
            "status" => "error",
            "message" => "error al realizar la inserción $th"
        ];
        $pdo->rollBack();
        return $dataExecute;
    }
    return $dataExecute;
}

function newHistory($formData)
{

    global $pdo;

    $sql = "INSERT INTO historias (hist_esfod, hist_cilod, hist_ejeod, hist_diaod, hist_esfoi, hist_ciloi, hist_ejeoi, hist_diaoi, hist_recom, hist_motv, pac_id) 
            VALUES (:hist_esfod, :hist_cilod, :hist_ejeod, :hist_diaod, :hist_esfoi, :hist_ciloi, :hist_ejeoi, :hist_diaoi, :hist_recom, :hist_motv, :pac_id)";


    $insertHistory = $pdo->prepare($sql);

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

function inactivePaciente($documento)
{

    $deletePaciente = true;
    $est_id = 2;

    global $pdo;

    $sql = "UPDATE paciente SET est_id = :est_id WHERE pac_docum = :pac_docum";

    $stm = $pdo->prepare($sql);
    $stm->bindValue(':est_id', $est_id, PDO::PARAM_INT);
    $stm->bindValue(':pac_docum', $documento, PDO::PARAM_INT);

    if (!$stm->execute()) {
        $deletePaciente = ["error" => "Error al eliminar registro"];
        return $deletePaciente;
    }

    $deletePaciente = ["success" => "Registro Inhabilitado con exito."];

    return $deletePaciente;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $codigo = ($_POST['codigo'] == '1' || $_POST['codigo'] == '2' || $_POST['codigo'] == '3') || ($_POST['codigo'] == '4') ? $_POST['codigo'] : null;

    if ($codigo == '1') {
        $data = $_POST['data'];
    }


    $formData = [];

    if ($codigo == '2') {
        $data = $_POST['data'];
        //Esta variable me captura los registros anteriores al update del paciente, en caso de que se daban comparar o si no hay ningun cambio, así evitamos ejecutar un update.
        $dataLastRow = $_POST['lastRow'];

        $excludeKeys = ['idHobbies', 'idGenero', 'idEstrato'];

        //TODO: POR MEJORAR, LA IDEA ES COMPARAR EL ANTERIOR REGISTRO CON EL NUEVO PARA SABER SI LOS DATOS SON IGUALES, SI SON IGUALES JUNTO A SU CLAVE.. NO DEBE DE HABER UN CAMBIO.
        foreach ($excludeKeys as $keys) {
            unset($dataLastRow[$keys]);
        }
    }

    if ($codigo == '1') {
        $data = $_POST['data'];
    } else if ($codigo == '2') {
        $data = $_POST['data'];
        $dataLastRow = $_POST['lastRow'];
    } else if ($codigo == '3') {
        $data = $_POST['documento'];
    } else if ($codigo == '4') {
        $data = $_POST['data'];
    }

    if ($codigo == '3') {
        $documento = $_POST['documento'];
        if (empty($documento)) {
            echo json_encode(['error' => 'El documento no puede estar vacío']);
            exit();
        }
    }

    $newDataArg = json_decode($data, true);
    if (is_array($newDataArg)) {
        foreach ($newDataArg as $field) {
            $formData[$field['name']] = $field['value'];
        }
    }



    switch ($codigo) {
        //Insert
        case 1:

            $data = newPaciente($formData);
            break;

        //Update
        case 2:
            $data = updatePaciente($formData, $dataLastRow);
            break;

        //Delete
        case 3:
            $data = inactivePaciente($documento);
            break;
        case 4:
            $data = newHistory($formData);
            break;

        default:
            $data = ["error" => "Código no válido"];
            break;
    }

    echo json_encode($data);
}
