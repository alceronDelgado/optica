<?php 

session_start();
include_once 'querys/functionsInsert.php';
include_once '../config/conn.php';
if(empty($_SESSION['userName']) || empty($_SESSION['rol']) || empty($_SESSION['rolNombre'])){

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
        <?php echo $_SESSION['userName'];?>
        </span>
        <span class="flow-text highlight">Rol: 
        <?php echo $_SESSION['rolNombre'];?>
        </span>
    </div>
</div>




<div class="table">
    <h1 class="center-align" id="titleUser">Lista de Usuarios</h1>
    <table class="responsive-table striped highlight bordered" id="myTable">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Email</th>
          <th>Rol</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Juan Pérez</td>
          <td>juan@ejemplo.com</td>
          <td>Admin</td>
          <td><a href="#" class="btn waves-effect waves-light">Editar</a></td>
        </tr>
        <tr>
          <td>Ana García</td>
          <td>ana@ejemplo.com</td>
          <td>Usuario</td>
          <td><a href="#" class="btn waves-effect waves-light">Editar</a></td>
        </tr>
        <tr>
          <td>Carlos López</td>
          <td>carlos@ejemplo.com</td>
          <td>Usuario</td>
          <td><a href="#" class="btn waves-effect waves-light">Editar</a></td>
        </tr>
      </tbody>
    </table>
  </div>




<div id="menuDrop">
    <button id="btnAddPaciente">
        <i class="large material-icons">group_add</i>
    </button>
    <i class="large material-icons">group_add</i>
    <i class="large material-icons">group_add</i>
</div>

<div class="modal" id="myModal">
    <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Añadir Paciente</h2>
        <form action="" method="post">
            <input type="text">
            <input type="text">
            <input type="text">
            <input type="button" value="Guardar">
        </form>
    </div>

</div>

    


<?php require_once '../assets/templates/imports.php'; ?>
<script src="../assets/js/dashboard.js"></script>
<script src="../assets/js/index.js"></script>
</body>
</html>
