<?php 

//El enfoque de este apartado es recibir el la solicitud fetch y que este llame al modelo.

/**
 * Nota: lo puede hacer el controlador pero en este caso como es solo para consumir unos datos, no es del todo necesario darle utilidad al controlador, esto es debido a que si no va a haber más logica, lo ideal solo un enpoint para consumir los datos y ya.
 * 
 */
include_once __DIR__ . '/../modules/roles/model/rol.php';

header('Content-Type: application/json');

 $roles = new Rol();

 $dataRoles = $roles->fetchRol();

 echo json_encode($dataRoles);


?>