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
    console.log('Formulario enviado');
    let radioEstrato = $('input[name="radioEstrato"]:checked').val();
  });


});