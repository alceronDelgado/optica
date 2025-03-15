<?php 
header('Content-Type: application/json');
require_once '../../config/conn.php';

function selectPacientes(){
    global $pdo;

    $sql ="SELECT 
        pac.pac_docum AS 'documento',
        pac.pac_nombre AS 'nombrePaciente',
        pac.pac_apellido AS 'apellidoPaciente',
        pac.pac_direccion AS 'direccionPaciente',
        pac.pac_telefono AS 'telefonoPaciente',
        pac.pac_email AS 'emailPaciente',
       	es.estr_id AS 'idEstrato',
        es.estr_nombre AS 'estrato',
        g.gen_nombre AS 'genero',
        g.gen_id AS 'idGenero',
        GROUP_CONCAT(h.hob_id SEPARATOR ', ') AS 'idHobbies',
        GROUP_CONCAT(h.hob_nombre SEPARATOR ', ') AS 'hobbies'
        FROM paciente pac 
        INNER JOIN estratos es ON es.estr_id = pac.estr_id 
        INNER JOIN generos g ON g.gen_id = pac.gen_id
        INNER JOIN paciente_hobbies ph ON ph.pac_id = pac.pac_docum
        INNER JOIN hobbies h ON ph.hob_id = h.hob_id
        GROUP BY(pac.pac_docum)";


    $selectSql = $pdo->prepare($sql);
    $selectSql->execute();
    $data = array();

    if ($selectSql->rowCount()>0) {
        
            while ($row = $selectSql->fetch()) {
                $data[] = array(
                    'documento' => $row['documento'],
                    'nombrePaciente' => $row['nombrePaciente'],
                    'apellidoPaciente' => $row['apellidoPaciente'],
                    'direccionPaciente' => $row['direccionPaciente'],
                    'telefonoPaciente' => $row['telefonoPaciente'],
                    'emailPaciente' => $row['emailPaciente'],
                    'idEstrato' => $row['idEstrato'],
                    'estrato' => $row['estrato'],
                    'genero' => $row['genero'],
                    'idGenero' => $row['idGenero'],
                    'idHobbies' => $row['idHobbies'], 
                    'hobbies' => $row['hobbies']
                    
                );
            }

    
    }else{

        $data[] = ["info" => "No hay pacientes registrados"];
        
    }

    return $data;

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigoSelect = $_POST['codigoSelect'];

    switch ($codigoSelect) {
        case 1:
            $dataSelect = selectPacientes();
            echo json_encode(["data"=>$dataSelect]);
            break;
        default:
            echo json_encode(array('error' => 'No se encontro el codigo'));
            break;
    }
}

?>