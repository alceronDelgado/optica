$(document).ready( function () {
    //Título de la tabla.
    let myTable = $('#tabla').DataTable({
      "pageLength": 5,  // Número de registros por página por defecto
      "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],  // Mostrar opciones de 5, 10, 15 registros
      "language": {
          "sSearch": "Buscar:", 
          "lengthMenu": "Mostrar _MENU_ registros por página",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
          "infoEmpty": "Mostrando 0 a 0 de 0 registros",
          "infoFiltered": "(filtrado de _MAX_ registros)",
          "paginate": {
              "first": "Primero",
              "previous": "Anterior",
              "next": "Siguiente",
              "last": "Último"
          }
      },
      "serverSide": false,
      "autoWidth": false,
      "responsive": true,
      "processing": true,
      "deferRender": true,
      "ajax": {
          "url": "querys/functionsSelectsTwo.php",
          "data": {codigoSelect: 1},
          "datatype": "json",
          "dataSrc": function(info) { 
              console.log(info); 
              return info.data || [];
          },
          "error": function(xhr, status, error) {
              console.error("Error en la solicitud AJAX:", error);
          },
          "cache": false,
          "type": "POST"
      },
      "columns": [
          { "data": "documento" },
          { "data": "nombrePaciente" },
          { "data": "apellidoPaciente" },
          { "data": "estrato" },
          {
              "data": null,
              "render": function(info) {
                  return `
                      <div class="text-center">
                          <div class="btn-group" role="group" aria-label="Button group">
                              <button id="btnDetalleHistoria" class="btn btn-info" type="button">Ver Historia</button>
                              <button id="btnEditar" class="btn btn-primary" type="button">Editar</button>
                              <button id="btnEliminar" data-id="${info.documento}" class="btn btn-danger eliminarbtn" type="button">Eliminar</button>
                          </div>
                      </div>`;
              }
          }
      ]
  });

  $('#titleUser').text('Pacientes');
  let modal = $('#myModal');
  let modalTitle = $('#modalTitle');
  let backGroundColorPrimary = $('body').css('background-color');
  let closeBtn = $('#closeModal');
  let backGroundModal;
  let labelsForm = {};

  function closeModal(modal){
    modal.fadeOut();
    $('body').css('background-color',backGroundColorPrimary);
  }
  function openModal(modal){
    modal.fadeIn();
    $('body').css('background-color', 'lightgray');
  }

  function modalKeydown(){
    //Cerrar modal con la tecla escape(27), se implementa off para que se aplique una sola vez.
    $(document).off('keydown').on('keydown', function (e){
      if (e.keyCode == 27) {
        closeModal(modal);
      }
    });
  }

  //Función para enviar las propiedades específicas del modal.
  function modalPropertyes(labelsForm,modalTitle,backGroundColorPrimary,closeBtn,backGroundModal){
    console.log('hello world');

    modalTitle.text(labelsForm.title);
    $('#labelDocumento').text(labelsForm.labelDocumento);
    $('#labelNombre').text(labelsForm.labelNombre);
    $('#labelApellido').text(labelsForm.labelApellido);
    $('#labelDireccion').text(labelsForm.labelDireccion);
    $('#labelTelefono').text(labelsForm.labelTelefono);
    $('#labelEmail').text(labelsForm.labelEmail);
    closeBtn.css('color', 'black');
    $('.backgroundModal').css('background-color', backGroundModal);
    


    //Implementar texto desde jquery.
    // $('#modalTitle').text('Agregar Paciente');
    // $('#labelDocumento').text("Número de documento");
    // $('#labelNombre').text("Nombre");
    // $('#labelApellido').text("Apellido");
    // $('#labelDireccion').text("Dirección");
    // $('#labelTelefono').text("Teléfono");
    // $('#labelEmail').text("Email");
    
    // $('.close').css('color', 'black');
    // $('#modalTitle').css('color', 'white');
  }

  closeBtn.on('click', function(e) {
    e.preventDefault(); 
    closeModal(modal);
  });

  //Mostrar modal de registro
  $('#btnAddPaciente').on('click',function(g) {
    g.preventDefault();
    openModal(modal);
    modalKeydown();
    backGroundModal = '#26A69A';
    labelsForm = {
      title: 'Agregar paciente',
      labelDocumento: 'Número de documento',
      labelNombre: 'Nombre',
      labelApellido: 'Apellido',
      labelDireccion: 'Dirección',
      labelTelefono: 'Teléfono',
      labelEmail: 'Email',

    };

    //Aplico propiedades específicas al modal.
    modalPropertyes(labelsForm,modalTitle,backGroundColorPrimary,closeBtn,backGroundModal);

  });

    //Registrar paciente
  $('#formPaciente').submit(function(e) {
      e.preventDefault();
  
      //En esta variable se almacena solo el valor del estrato seleccionado en base a si esta checked o no.
      let radioEstrato = $('input[name="radioEstrato"]:checked').val();
  
      //En la variable genero valido mediate option y no input ya que un select maneja options.
      let genero = $('select[name="genero"]').val();
  
      //En la variable hobbies se almacena los checkbox seleccionados.
      let hobbies = $('input[name="hobbies"]:checked').map(function() {
        return this.value;
      }).get();
  
      //Capturar valores
      let documentoPaciente = $('#documentoPaciente').val();
      let nombrePaciente = $('#nombrePaciente').val();
      let apellidoPaciente = $('#apellidoPaciente').val();
      let direccionPaciente  = $('#direccionPaciente').val();
      let telefonoPaciente = $('#telefonoPaciente').val();
      let emailPaciente = $('#emailPaciente').val();
      let estratoPaciente = radioEstrato;
      let hobbiesPaciente = hobbies;
      let generoPaciente = genero;
      let codigoInsert = 1;
  
      const data = {
        documentoPaciente,
        nombrePaciente,
        apellidoPaciente,
        direccionPaciente,
        telefonoPaciente,
        emailPaciente,
        generoPaciente,
        estratoPaciente,
        hobbiesPaciente,
        
      }
  
      const dataJson = JSON.stringify(data);
  
      Swal.fire({
        title: '¿Estás seguro de agregar este paciente?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Sí',
        denyButtonText: 'No',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "querys/functionsInsert.php",
            data: {
              data: dataJson,
              codigoInsert: codigoInsert
            },
            dataType: "json",
            success: function (data) {
              console.log(data.success);
              Swal.fire({
                title: data.success,
                icon: 'success',
                confirmButtonText: 'Aceptar',
                showCancelButton: false
              });
              closeModal(modal);  
              myTable.ajax.reload();
              $('#formPaciente')[0].reset(); 
            }
          });
        }
      }).catch((err) => {
        console.error(err);
      });
  
  
      
  });


  //Capturar datos.
  $('#btnEdit').on('click',function(f){
    f.preventDefault();
    openModal(modal);
    console.log('hello world')

  });

    //Editar datos del paciente
    $(document).on('click','#btnEditar', function (){
      //let row = $(this).closest('tr').find('td:eq(0)').text();
      let row = $(this).closest('tr');
      let data = myTable.row(row).data();
      console.log(data.emailPaciente);
  
      //Mostrar modal
      $("#myModal").fadeIn();
      $('#documentoPaciente').val(data.documento);
      $('#nombrePaciente').val(data.nombrePaciente);
      $('#apellidoPaciente').val(data.apellidoPaciente);
      $('#direccionPaciente').val(data.direccionPaciente);
      $('#telefonoPaciente').val(data.telefonoPaciente);
      $('#emailPaciente').val(data.emailPaciente);
      estrato = parseInt(data.estrato);
  
      //Estrato
      $('input[name="radioEstrato"]').each(function (){
        if(parseInt($(this).val()) === estrato){
          $(this).prop('checked',true);
          
        }
      });
  
      //Genero
  
  
    });


  //Cerrar sesión
  $('#close').on('click',function(f){
    f.preventDefault();
    
    Swal.fire({
      title:"¿Deseas salir de la aplicación?",
      draggable: true,
      icon:'info',
      showDenyButton: true,
      showCancelButton: false,
      confirmButtonText: "Si",
      denyButtonText: `No`
    }).then((result) =>{
      if(result.isConfirmed){

        Swal.fire({
          title: 'Cerrando sesión...',
          text: 'Por favor espera mientras se cierra tu sesión.',
          icon: 'info',
          showConfirmButton: false,
          willOpen: () => {
            Swal.showLoading();
          }
        });

        $.ajax({
          url:'querys/sessionDestroy.php',
          type:'POST',
          success: function(data){
            if(data){

              Swal.fire({
                title: '¡Hasta luego!',
                text: 'Has cerrado sesión exitosamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
              }).then(() => {
                window.location.replace("../index.php"); 
              });
            }
            
          }

        });
      }else if(result.isDenied){
        Swal.close();
      }

    });

  });

});