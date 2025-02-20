<?php

session_start();
require_once 'config/conn.php';
require_once 'src/querys/functionsSelects.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php require_once 'assets/templates/head.php'; ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinica de la visión</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="container">
        <div class="title">
            <h1>Clinica la visión</h1>
        </div>
        <div class="row">
            <!-- Contenedor de la Imagen -->
            <div class="col s12 m6">
                <img src="assets/img/optometra.svg" alt="Imagen de ejemplo" class="responsive-img">
            </div>

            <!-- Contenedor del Formulario -->
            <div class="col s12 m6">
                <span class="col s12 center-align">Iniciar sesión</span>
                <form action="" method="post" id="formLogin" class="">
                    <div class="input-field col s12">
                        <label for="rolesId">Rol:</label>
                        <select name="rolesId" id="rol_id">
                            <?php
                            $roles = selectRols();
                            foreach ($roles as $rolesInputs) {
                            ?>
                                <option value="<?php echo $rolesInputs['rolesId']; ?>">
                                    <?php echo $rolesInputs['nombreRol']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="user input-field col s12">
                        <label for="">Documento:</label>
                        <input type="number" name="user" id="usu_docum">
                    </div>
                    <div class="password input-field col s12">
                        <label for="">Contraseña:</label>
                        <input type="password" name="password" id="usu_clave">
                    </div>
                    <div class="buttom input-field col s12 center-align">
                        <button type="submit" id="submit" class="btn waves-effect waves-light">ingresar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require_once 'assets/templates/imports.php'; ?>

    <script src="assets/js/index.js"></script>
</body>
</html>