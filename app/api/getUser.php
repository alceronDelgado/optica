<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../modules/login/controller/loginController.php';

/**
 * 
 * El enfoque es aca recibir la data y llamar al controlador para poder manejar la información.
 */

$data = json_decode(file_get_contents("php://input"), true);

//var_dump($data);

if (!$data || empty($data['usu_clave']) || empty($data['usu_email']) || !isset($data['rol_id'])) {
    http_response_code(422);
    echo json_encode(['error' => 'Datos incompletos.']);
    exit;
}

$usu_clave = $data['usu_clave'];
$usu_email = $data['usu_email'];
$rol_id = (int) $data['rol_id'];

$controlerLogin = new LoginController($usu_email, $usu_clave, $rol_id);
ob_clean();
if ($controlerLogin->authData()) {
    http_response_code(200);
    echo json_encode(['status' => true, 'message' => 'login exitoso' ]);
} else {
    http_response_code(404);
    echo json_encode(['status' => false, 'message' => 'Credenciales inválidas', ]);
}
