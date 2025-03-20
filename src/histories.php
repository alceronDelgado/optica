<?php

session_start();
include_once '../config/conn.php';
// include_once 'querys/functionsInsert.php';
include_once 'querys/functionsSelects.php';

if (empty($_SESSION['userName']) || empty($_SESSION['rol']) || empty($_SESSION['rolNombre'])) {

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
    <div class="col s3 offset-5">
      <span class="flow-text highlight">Bienvenido:
        <?php echo $_SESSION['userName']; ?>
      </span>
      <span class="flow-text highlight">Rol:
        <?php echo $_SESSION['rolNombre']; ?>
      </span>
    </div>
  </div>

  <div class="table">
    <h1 class="center-align" id="titleUser"></h1>
    <table class="responsive-table striped highlight bordered" id="tabla">
      <thead>
        <tr>
          <th>documento</th>
          <th>nombrePaciente</th>
          <th>apellidoPaciente</th>
          <th>estrato</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <!-- render por ajax. -->
      </tbody>
    </table>
  </div>

  <div id="menuDrop">
    <a href="" id="btnAddPaciente">
      <i class="large material-icons">group_add</i>
    </a>
    <a href="" id="modalAddHistoria" class="">
      <i class="large material-icons">library_add</i>
    </a>
    <a href="">
      <i class="large material-icons" id="close">close</i>
    </a>
  </div>

  
  <?php require_once '../assets/templates/imports.php'; ?>
  <script src="../assets/js/dashboard.js"></script>
</body>

</html>