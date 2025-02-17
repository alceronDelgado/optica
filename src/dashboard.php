<?php 

session_start();
include_once 'querys/functionsInsert.php';
include_once '../config/conn.php';
if(empty($_SESSION['userName']) || empty($_SESSION['rol'])){

    header("location:../index.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <?php require_once '../assets/templates/head.php' ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

<div class="row" id="spanId">
    <div class="col s3 offset-s9 ">
        <span class="flow-text highlight">This div is 7-columns wide on pushed to the right by 5-columns.</span>
    </div>
</div>

<div class="col s9 center table">
    <p id="parrafo"> 
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora optio, at quidem explicabo possimus qui molestiae. Et sequi adipisci tenetur illo magni. Omnis harum dolorem dolores nobis velit, perferendis quos!
    Sit beatae dolorem fugit error fugiat provident. Temporibus velit, repellendus dolore nisi, reprehenderit voluptates iste natus cumque nam, eligendi placeat sapiente adipisci quaerat qui voluptatum consequuntur facilis? Tempore, iste blanditiis!
    Maiores aperiam eum ut unde maxime sit sapiente alias! Laborum delectus accusantium provident. Ea, quo quod adipisci, in culpa dolor, impedit sapiente voluptas aperiam distinctio nulla id esse itaque quam!
    </p>
    
</div>


<menu id="menuDrop">
    <span>item#1</span>
    <span>item#1</span>
    <span>item#1</span>
</menu>

<?php require_once '../assets/templates/imports.php'; ?>
<script src="../assets/js/index.js"></script>
</body>
</html>
