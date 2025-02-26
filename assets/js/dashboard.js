$(document).ready( function () {
    // let myTable = $('#tabla').DataTable({
    //   "pageLength": 5,  // Número de registros por página por defecto
    //   "lengthMenu": [ [5, 10, 15, -1], [5, 10, 15, "Todos"] ],  // Mostrar opciones de 5, 10, 15 registros
    //   "language": {
    //     "sSearch": "Buscar:",  // Texto del campo de búsqueda
    //     "lengthMenu": "Mostrar _MENU_ registros por página",  
    //     "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",  
    //     "infoEmpty": "Mostrando 0 a 0 de 0 registros",  
    //     "infoFiltered": "(filtrado de _MAX_ registros)",  
    //     "paginate": {
    //       "first": "Primero",  
    //       "previous": "Anterior", 
    //       "next": "Siguiente",  
    //       "last": "Último"  
    //     }
    //   },
    //   "serverSide": false,
    //   "autoWidth": false,
    //   "responsive": true,
    //   "processing": true,
    //   "deferRender": true,
    //   "ajax": {
    //     "url": "querys/functionsSelectsTwo.php",
    //     "data": {codigoSelect: 1},
    //     "datatype": "json",
    //     "dataSrc": function (data) { 
    //           console.log(data);  
    //           return data || []; 
    //       },

    //     "error": function(xhr, status, error) {
    //             console.error("Error en la solicitud AJAX:", error);
    //         },
    //     "cache": false,
    //     "type": "POST",
    //     },
    //     "columns":[
    //         // columnas
    //         {
    //             "data":"documento"
    //         },
    //         {
    //             "data": "nombrePaciente"
    //         },
    //         {
    //             "data": "apellidoPaciente"
    //         },
    //         {
    //             "data": "estrato"
    //         },
    //         {
    //             "data": null,
    //             "render": function(data) {
    //                 return `
    //                 <div class="text-center"><div class="btn-group" role="group" aria-label="Button group"><button id="btnDetalle" class="btn btn-info" type="button" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="16" height="16"><path fill="white" d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" /></svg></button><button id="btnEditar" class="btn btn-primary editbtn" type="button" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg></button><button id="btnEliminar" data-id="${data.codigo}" "class="btn btn-info eliminarbtn" type="button" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button><button id="btnAdd" data-id="${data.codigo}" class="btn" style="background-color: yellow; color: white" type="button">
    //                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" viewBox="0 0 512 512">
    //                     <path d="M280 64h-48c-13.3 0-24 10.7-24 24v72c0 13.3 10.7 24 24 24h48c13.3 0 24-10.7 24-24V88c0-13.3-10.7-24-24-24zM128 32h256c8.8 0 16 7.2 16 16v400c0 8.8-7.2 16-16 16H128c-8.8 0-16-7.2-16-16V48c0-8.8 7.2-16 16-16z"/>
    //                 </svg>
    //             </button></div></div>
    //             `;
    //             }
                
    //         }
    //     ]
      
    // });


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
                              <button id="btnDetalle" class="btn btn-info" type="button">Ver Historia</button>
                              <button id="btnEditar" class="btn btn-primary" type="button">Editar</button>
                              <button id="btnEliminar" data-id="${info.documento}" class="btn btn-danger eliminarbtn" type="button">Eliminar</button>
                          </div>
                      </div>`;
              }
          }
      ]
  });
  
  
    $('#titleUser').text('Pacientes');


    

  //Editar datos del paciente
  $(document).on('click','#btnEditar', function (){
    //let row = $(this).closest('tr').find('td:eq(0)').text();
    let row = $(this).closest('tr');
    let data = myTable.row(row).data();


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


  //Mostrar modal de registro
  $('#btnAddPaciente').on('click',function(g) {
    g.preventDefault();
      $("#myModal").fadeIn();
      $('body').css('background-color', 'lightgray');

      //Implementar texto desde jquery.
      $('#modalTitle').text('Agregar Paciente');
      $('#labelDocumento').text("Número de documento");
      $('#labelNombre').text("Nombre");
      $('#labelApellido').text("Apellido");
      $('#labelDireccion').text("Dirección");
      $('#labelTelefono').text("Teléfono");
      $('#labelEmail').text("Email");
      
      $('.backgroundModal').css('background-color', '#26A69A');
      $('.close').css('color', 'black');
      $('#modalTitle').css('color', 'white');
  });


  //Registrar paciente
  $('#formPaciente').submit(function(e) {
    e.preventDefault();


    //En esta variable se almacena solo el valor del estrato seleccionado en base a si esta checked o no.
    let radioEstrato = $('input[name="radioEstrato"]:checked').val();

    //En la variable genero valido mediate option y no input ya que un select maneja options.
    let genero = $('option[name="genero"]:checked').val();

    //En la variable hobbies se almacena los checkbox seleccionados.
    let hobbies = $('input[name="hobbies"]:checked').map(function() {
      return this.value;
    }).get();

    //Capturar valores
    let documentoPaciente = $('#documentoPaciente').val();
    let nombrePaciente = $('#nombrePaciente').val();
    let apellidoPaciente = $('#apellidoPaciente').val();
    let dirreccionPaciente  = $('#dirreccionPaciente').val();
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
      dirreccionPaciente,
      telefonoPaciente,
      emailPaciente,
      generoPaciente,
      estratoPaciente,
      hobbiesPaciente,
      
    }

    const dataJson = JSON.stringify(data);

    Swal.fire({
      title:'¿Estás seguro de agregar este paciente?',
      showDenyButton:true,
      showCancelButton:true,
      confirmButtonText:'Si',
      denyButtonText:'No',
      cancelButtonText:'Cancelar',
      
    }).then((result) => {

      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "querys/functionsInsert.php",
          data: {data:dataJson,
            codigoInsert:codigoInsert},
          dataType: "json",
          success: function (data) {
            console.log(data.success);
            Swal.fire({
              title: data.success,
              icon: 'success',
              confirmButtonText: 'Aceptar',
              showCancelButton: false,
              });
          }
        });
      }
    }).catch((err) => {
      
    });


    //Editar datos de paciente
    $('#btnEdit').on('click',function(f){
      f.preventDefault();

    });

    


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

    //Cerrar modal con la tecla escape(27)
    $(document).keydown(function(e) {
      if (e.keyCode == 27) {
        $("#myModal").fadeOut();
        $('body').css('background-color', 'white');
  
      }
    });


});