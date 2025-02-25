$(document).ready( function () {
    let myTable = $('#myTable').DataTable({
      "pageLength": 5,  // Número de registros por página por defecto
      "lengthMenu": [ [5, 10, 15, -1], [5, 10, 15, "Todos"] ],  // Mostrar opciones de 5, 10, 15 registros
      "language": {
        "sSearch": "Buscar:",  // Texto del campo de búsqueda
        "lengthMenu": "Mostrar _MENU_ registros por página",  // Texto del menú de cantidad de registros
        "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",  // Texto que muestra el rango de registros
        "infoEmpty": "Mostrando 0 a 0 de 0 registros",  // Texto cuando no hay registros
        "infoFiltered": "(filtrado de _MAX_ registros)",  // Texto cuando se filtran registros
        "paginate": {
          "first": "Primero",  // Texto del botón de "Primero"
          "previous": "Anterior",  // Texto del botón de "Anterior"
          "next": "Siguiente",  // Texto del botón de "Siguiente"
          "last": "Último"  // Texto del botón de "Último"
        }
      }
    });


    //Título de la tabla.
  $('#titleUser').text('Pacientes');


  $('#btnAddPaciente').click(function() {
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


  //Cerrar modal con la tecla escape(27)
  $(document).keydown(function(e) {
    if (e.keyCode == 27) {
      $("#myModal").fadeOut();
      $('body').css('background-color', 'white');

    }
  });

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
          data: {data:dataJson,codigoInsert:codigoInsert},
          dataType: "dataType",
          success: function (info) {
            console.log(info);
            
          }
        });
      }
    }).catch((err) => {
      
    });

    


  });


});