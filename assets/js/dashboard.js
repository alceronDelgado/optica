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


    $('#btnAddPaciente').click(function() {
      $("#myModal").fadeIn();
      console.log('Modal abierto');
  });

} );