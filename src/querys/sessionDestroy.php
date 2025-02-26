<?php

require_once '../../config/conn.php';
session_start();

session_unset();

session_destroy();

echo json_encode(['success'=>"variables de sesión inhabilitadas"]);

$pdo=null;





?>