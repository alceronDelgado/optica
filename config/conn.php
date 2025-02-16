<?php 

$dsn = 'mysql:dbname=clinicavision;host=localhost';
$user = 'root';
$password = '';

try {

    $pdo = new PDO($dsn,$user,$password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    return $e->getMessage();
}

?>