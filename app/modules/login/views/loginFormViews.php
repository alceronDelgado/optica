<?php

/**
 * valido si los datos que envio a la vista se envian de manera correcta.
 */
//var_dump($dataRol);

?>

<div class="container">
    <div class="title">
        <h1>Clinica la visión</h1>
    </div>
    <div class="row">
        <!-- Contenedor de la Imagen -->
        <div class="col s12 m6">
            <img src="public/assets/img/optometra.svg" alt="Imagen de ejemplo" class="responsive-img">
        </div>

        <!-- Contenedor del Formulario -->
        <div class="col s12 m6">
            <span class="col s12 center-align">Iniciar sesión</span>
            <form action="" method="post" id="formLogin" class="">
                <div class="input-field col s12">
                    <!-- La idea es renderizarlos desde js -->
                    <select name="rolesId" id="rol_ids" class="">

                    </select>
                    <label for="rolesId" class="col s2">Rol:</label>
                </div>
                <div class="user input-field col s12">
                    <label for="usu_email">Email:</label>
                    <input type="email" name="email" id="usu_email">
                    <div class="card-panel1">
                        <span class="red-text text-darken-2" id="spanEmail"></span>
                    </div>
                </div>
                <div class="password input-field col s12">
                    <label for="">Contraseña:</label>
                    <input type="password" name="password" id="usu_clave">
                    <div class="card-panel1">
                        <span class="red-text text-darken-2" id="spanPassword"></span>
                    </div>
                </div>
                <div class="buttom input-field col s12 center-align">
                    <button type="submit" id="submitLogin" class="btn waves-effect waves-light">ingresar</button>
                </div>
            </form>
        </div>
    </div>
</div>