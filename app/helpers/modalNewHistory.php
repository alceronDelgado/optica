  <!-- Modal crear historia. -->
  <div id="myModalHistoria">
    <div class="modal-content">
      <div class="row backgroundModal" id="">
        <div class="col s1">
          <a href="#"><span id="closeModalPaciente" class="closeSpan">&times;</span></a>
        </div>
        <div class="col s11 center-align" id="">
          <h2 id="modalTitleHistoria"></h2>
        </div>
      </div>
      <form action="" method="post" id="formHistoriaPaciente">
        <div class="row">
          <div class="col s6 m6">
            <label for="" id="" class="labelText">Documento</label>
            <span name="pac_id" id="documentoPacienteHistoria"></span>
          </div>
          <div class="col s6 m6">
            <label for="" id="" class="labelText">Nombre</label>
            <span id="nombrePacienteHistoria"></span>
          </div>
          <div class="col s6 m6">
            <label for="" id="" class="labelText">Apellido</label>
            <span id="apellidoPacienteHistoria"></span>
          </div>
          <div class="col s6 m6">
            <label for="" id="" class="labelText">Teléfono</label>
            <span id="telefonoPacienteHistoria"></span>
          </div>
          <div class="col s6 m6">
            <label for="" id="" class="labelText">Genero</label>
            <span id="generoPacienteHistoria"></span>
          </div>
          <div class="col s6 m6">
            <label for="" id="" class="labelText">Estrato</label>
            <span id="estratoPacienteHistoria"></span>
          </div>
          <div class="col s12 m12">
            <label for="" id="" class="labelText  enter-align pt-4">Motivo Visita:</label>
            <textarea name="hist_motv" id="hist_motv" cols="30" rows="10"></textarea>
          </div>
          <div class="col s4 m4">
            <label for="" id="" class="labelText">Esfera OD:</label>
            <input type="number" name="hist_esfod" id="esferaOd" placeholder="Esfera Ojo derecho">
          </div>
          <div class="col s4 m4">
            <label for="" id="" class="labelText">Cilindo OD:</label>


            <input type="number" name="hist_cilod" id="cilindOD" placeholder="Cilindo Ojo derecho">
          </div>
          <div class="col s4 m4">
            <label for="" id="" class="labelText">Eje OD:</label>
            <input type="number" name="ejeOd" id="ejeOd" placeholder="Eje Ojo derecho">
          </div>
          <div class="col s4 m4">
            <label for="" id="" class="labelText">Esfera ID:</label>
            <input type="number" name="hist_esfoi" id="esferaId" placeholder="Esfera Ojo Izquierdo">
          </div>
          <div class="col s4 m4">
            <label for="" id="" class="labelText">Cilindo ID:</label>
            <input type="number" name="hist_ciloi" id="cilindOI" placeholder="Cilindo Ojo Izquierdo">
          </div>
          <div class="col s4 m4">
            <label for="" id="" class="labelText">Eje ID:</label>
            <input type="number" name="hist_ejeoi" id="ejeId" placeholder="Eje Ojo Izquierdo">
          </div>

          <div class="col s6 m6">
            <label for="" id="" class="labelText">Diagnostico OI:</label>
            <input type="number" name="hist_diaoi" id="diagOi" placeholder="Diagnostico Ojo Izquierdo">
          </div>
          <div class="col s6 m6">
            <label for="" id="" class="labelText">Diagnostico OD:</label>
            <input type="number" name="hist_diaod" id="diagOd" placeholder="Diagnostico Ojo Derecho">
          </div>
          <div class="col s12 m12">
            <label for="" id="" class="labelText">Recomendaciones:</label>
            <textarea name="hist_recom" id="hist_recom" cols="30" rows="10" style="resize: none;"></textarea>
          </div>

        </div>
        <div class="btnDivHistoria">
          <button type="submit" id="btnHistoriaPaciente" class="btn waves-effect waves-light center-align"></button>
        </div>
      </form>
    </div>
  </div>