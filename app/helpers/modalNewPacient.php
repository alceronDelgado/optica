  <!-- Modal registrar paciente -->
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
            <label for="" id="radioEstrato" class="labelText col s12 center-align">Estrato:</label>

            <?php
            $dataEstratos = selectStratos();
            $estratoDefault = 1;

            foreach ($dataEstratos as $estratosRow) {
              // Verificar si el estrato actual es el seleccionado
              $checked = ($estratosRow['idEstratos'] == $estratoDefault) ? 'checked' : '';
            ?>

              <label>
                <input name="estrato" type="radio" id="" class="with-gap" value="<?php echo $estratosRow['idEstratos']; ?>" <?php echo $checked; ?> />
                <span name="radioEstratoNombre"><?php echo $estratosRow['nombreEstrato']; ?></span>
              </label>

            <?php } ?>
          </div>
          <!-- Genero -->
          <div class="input-field col s6">
            <label for='pacienteGeneroSelect' class='labelText'>Genero</label>
            <select name='genero' id='pacienteGeneroSelect' class="">
              <!-- <option value='0'>Seleccione un genero</option> -->
              <?php
              $dataGeneros = selectGeners();

              foreach ($dataGeneros as $generosRow) {

              ?>

                <option name="" class="generos" value="<?php echo $generosRow['genero'] ?>">
                  <?php echo $generosRow['nombreGenero']; ?>
                </option>
              <?php  }
              ?>
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