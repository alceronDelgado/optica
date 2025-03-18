<?php 

session_start();
include_once '../config/conn.php';
// include_once 'querys/functionsInsert.php';
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
    <i class="large material-icons">group_add</i>
    <a href="">
      <i class="large material-icons" id="close">close</i>
    </a>
</div>

<div class="modal" id="myModal">
    <div class="modal-content">
      <div class="row backgroundModal">
        <div class="col s1">
          <a href="#"><span id="closeModal">&times;</span></a>
        </div>
        <div class="col s11 center-align " id="">
          <h2 id="modalTitle"></h2>
        </div>
      </div>
        <form action="" method="post" id="formPaciente">
          <div class="row">
          <div class="col s6 m6">
            <label for="documento" id="labelDocumento" class="labelText"></label>
            <input type="number" name="documento" id="documentoPaciente" placeholder="Nro de documento">
          </div>
          <div class="col s6 m6">
            <label for="" id="labelNombre" class="labelText"></label>
            <input type="text" name="nombrePaciente" id="nombrePaciente" placeholder="Nombre">
          </div>
          <div class="col s6 m6">
            <label for="" id="labelApellido" class="labelText"></label>
            <input type="text" name="apellidoPaciente" id="apellidoPaciente" placeholder="Apellido">
          </div>
          <div class="col s6 m6">
            <label for="" id="labelDireccion" class="labelText"></label>
            <input type="text" name="direccionPaciente" id="direccionPaciente" placeholder="direccion">
          </div>
          <div class="col s6 m6">
            <label for="" id="labelTelefono" class="labelText"></label> 
            <input type="number" min="0" name="telefonoPaciente" id="telefonoPaciente" placeholder="Telefono">
          </div>
          <div class="col s6 m6">
            <label for="" id="labelEmail" class="labelText"></label>
            <input type="email" name="emailPaciente" id="emailPaciente" placeholder="Email">
          </div>
          
          <!-- Estratos -->
          <div class="col row s3">
            <label for="" id="radioEstrato" class="labelText col s12 center-align" >Estrato:</label>
          
              <?php 
                $dataEstratos = selectStratos();
                $estratoDefault = 1; 

                foreach ($dataEstratos as $estratosRow) { 
                  // Verificar si el estrato actual es el seleccionado
                  $checked = ($estratosRow['idEstratos'] == $estratoDefault) ? 'checked' : ''; 
              ?>
                
                  <label>
                    <input name="estrato" type="radio" id="" class="with-gap" value="<?php echo $estratosRow['idEstratos']; ?>" <?php echo $checked; ?>/>
                    <span name="radioEstratoNombre"><?php echo $estratosRow['nombreEstrato']; ?></span>
                  </label>
                
            <?php } ?>
          </div>
          <!-- Genero -->
          <div class="col s6">
          <label for='pacienteGeneroSelect' class='labelText'>Genero</label>
          <select name='genero' id='pacienteGeneroSelect'>
            <!-- <option value='0'>Seleccione un genero</option> -->
            <?php 
              $dataGeneros = selectGeners();
              foreach ($dataGeneros as $generosRow) {
            ?>
              <option name="" class="generos" value="<?php echo $generosRow['genero'] ?>">
                <?php echo $generosRow['nombreGenero']; ?>
              </option>
            <?php  } ?>
          </select>
            
            
          </div>
          <!-- Hobbies -->
          <div class="col row s3">
            <label for="labelHobbies" id="" class="labelText col s12 center-align">Hobbies:</label>
            <?php 
              $dataHobbies = selectHobbies();
              $defaultHobbies = 1;
              foreach ($dataHobbies as $rowHobbies) { 
                
                $checked = ($defaultHobbies == $rowHobbies['idHobbie']) ? 'checked' : '';
                
            ?>
              <label for="<?php echo $rowHobbies['idHobbie']; ?>" class="col s12">
                <input type="checkbox" class="filled-in" value="<?php echo $rowHobbies['idHobbie']; ?>" id="<?php echo $rowHobbies['idHobbie']; ?>" name="hobbies" />
                <span>
                  <?php echo $rowHobbies['nombreHobbie']; ?>
                </span>
              </label>

            <?php } ?>
            
          </div>

          <div class="col s12 center-align btnDiv">
            <button type="submit" class="btn pacBtn waves-effect waves-light" id="btnPaciente"></button>
          </div>
          </form>
    </div>

</div>

<?php require_once '../assets/templates/imports.php'; ?>
<script src="../assets/js/dashboard.js"></script>
<script src="../assets/js/index.js"></script>
</body>
</html>
