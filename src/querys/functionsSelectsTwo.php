<?php
header('Content-Type: application/json');
require_once '../../config/conn.php';

function selectPacientes()
{
    global $pdo;

    //TODO: Mejorar consulta.
    $sql = "SELECT 
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
        LEFT JOIN estratos es ON es.estr_id = pac.estr_id 
        LEFT JOIN generos g ON g.gen_id = pac.gen_id
        LEFT JOIN paciente_hobbies ph ON ph.pac_id = pac.pac_docum
        LEFT JOIN hobbies h ON ph.hob_id = h.hob_id
        WHERE pac.est_id = 1 GROUP BY(pac.pac_docum)";


    $selectSql = $pdo->prepare($sql);
    $selectSql->execute();
    $data = array();

    if ($selectSql->rowCount() > 0) {

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
    } else {

        $data[] = ["info" => "No hay pacientes registrados"];
    }

    return $data;
}

function selectHistory($documento)
{
    global $pdo;

    $sql = "SELECT
p.pac_docum AS 'documento',
p.pac_nombre AS 'nombre',
p.pac_apellido AS 'apellido',
p.pac_telefono AS 'telefono',
g.gen_nombre AS 'genero',
est.estr_nombre AS 'estrato',
h.hist_esfod AS 'esfod',
h.hist_cilod AS 'cilod',
h.hist_ejeod AS 'ejeod',
h.hist_diaod AS 'diaod',
h.hist_esfoi AS 'esfoid',
h.hist_ciloi AS 'ciloi',
h.hist_ejeoi AS 'ejeoi',
h.hist_diaoi AS 'diaoi',
h.hist_recom AS 'recom',
h.hist_motv AS 'motv'
FROM paciente p
INNER JOIN historias h ON
h.pac_id = p.pac_docum
INNER JOIN generos g ON
g.gen_id = p.gen_id
INNER JOIN estratos est ON 
est.estr_id = p.estr_id WHERE p.pac_docum = :pac_docum LIMIT 1";

    $stm = $pdo->prepare($sql);
    $stm->bindParam(':pac_docum', $documento);
    $stm->execute();
    $dataInfo = $stm->fetch(PDO::FETCH_ASSOC);

    //Uso valor ternario para determinar si hay o no historias asociadas al documento del paciente.
    $dataSucces = $dataInfo ?
        ['status' => true, 'data' => $dataInfo] : ['status' => false, 'data' => 'No se encontro la historia'];

    return $dataSucces;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigoSelect = $_POST['codigoSelect'];

    if ($codigoSelect == 2) {
        $documento = $_POST['documento'];
    }



    switch ($codigoSelect) {
        case 1:
            $dataSelect = selectPacientes();
            break;

        case 2:
            $dataSelect = selectHistory($documento);
            break;
        default:
            echo json_encode(array('error' => 'No se encontro el codigo'));
            break;
    }

    echo json_encode(["data" => $dataSelect]);
}
