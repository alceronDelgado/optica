<?php 

session_start();
include_once '../config/conn.php';
include_once 'querys/functionsInsert.php';
include_once 'querys/functionsSelects.php';

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
    <h1 class="center-align" id="titleUser"></h1>
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
      <div class="row backgroundModal">
        <div class="col s1">
          <span class="close">&times;</span>
        </div>
        <div class="col s11 center-align " id="">
          <h2 id="modalTitle"></h2>
        </div>
      </div>
        <form action="" method="post">
          <div class="row">
            
          <div class="col s6 m6">
            <label for="" id="labelDocumento" class="labelText"></label>
            <input type="number" name="documento" id="documentoPaciente" placeholder="Nro de documento">
          </div>

          <div class="col s6 m6">
            <label for="" id="labelNombre" class="labelText"></label>
            <input type="text" name="nombre" id="nombrePaciente" placeholder="Nombre">
          </div>

          <div class="col s6 m6">
            <label for="" id="labelApellido" class="labelText"></label>
            <input type="text" name="apellido" id="apellidoPaciente" placeholder="Apellido">
          </div>
          <div class="col s6 m6">
            <label for="" id="labelDireccion" class="labelText"></label>
            <input type="text" name="direccion" id="apellidoPaciente" placeholder="direccion">
          </div>
          <div class="col s6 m6">
            <label for="" id="labelTelefono" class="labelText"></label> 
            <input type="number" min="0" name="telefono" id="telefonoPaciente" placeholder="Telefono">
          </div>
          <div class="col s6 m6">
            <label for="" id="labelEmail" class="labelText"></label>
            <input type="email" name="email" id="emailPaciente" placeholder="Email">
          </div>
          <div class="col s6">
            <?php 
              $dataGeneros = selectGeners();

              if(count($dataGeneros)>0){
                echo "<label for='genero' class='labelText'>Genero</label>";
                echo "<select name='genero' id='generoPaciente'>";
                echo "<option value=''>Seleccione un genero</option>";
                foreach ($dataGeneros as $key => $value) {
                  echo "<option value='".$value['genero']."'>".$value['nombreGenero']."</option>";
                }
                echo "</select>";
              }
            
            ?>
            
          </div>

          <div class="col s12 center-align">
            <input type="button" value="Guardar" class=" btn waves-effect waves-light" id="btnSavePaciente">
          </div>
          </form>
    </div>

</div>

    


<?php require_once '../assets/templates/imports.php'; ?>
<script src="../assets/js/dashboard.js"></script>
<script src="../assets/js/index.js"></script>
</body>
</html>
