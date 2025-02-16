<?php 

session_start();


if(empty($_SESSION['rol']) || empty($_SESSION['rol'])){

    header("location:../index.php");
    exit;
    
}else{
    echo "existe la session".$_SESSION['userName'];
    echo "existe el rol".$_SESSION['rol'];
    
}

?>