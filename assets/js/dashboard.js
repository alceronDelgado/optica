$(document).ready(function () {
  //Título de la tabla.
  let myTable = $("#tabla").DataTable({
    pageLength: 5, // Número de registros por página por defecto
    lengthMenu: [
      [5, 10, 15, -1],
      [5, 10, 15, "Todos"],
    ], // Mostrar opciones de 5, 10, 15 registros
    language: {
      sSearch: "Buscar:",
      lengthMenu: "Mostrar _MENU_ registros por página",
      info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
      infoEmpty: "Mostrando 0 a 0 de 0 registros",
      infoFiltered: "(filtrado de _MAX_ registros)",
      paginate: {
        first: "Primero",
        previous: "Anterior",
        next: "Siguiente",
        last: "Último",
      },
    },
    serverSide: false,
    autoWidth: false,
    responsive: true,
    processing: true,
    deferRender: true,
    ajax: {
      url: "querys/functionsSelectsTwo.php",
      data: { codigoSelect: 1 },
      datatype: "json",
      dataSrc: function (info) {
        console.log(info);
        return info.data || [];
      },
      error: function (xhr, status, error) {
        console.error("Error en la solicitud AJAX:", error);
      },
      cache: false,
      type: "POST",
    },
    columns: [
      { data: "documento" },
      { data: "nombrePaciente" },
      { data: "apellidoPaciente" },
      { data: "estrato" },
      {
        data: null,
        render: function (info) {
          return `
                      <div class="text-center">
                          <div class="btn-group" role="group" aria-label="Button group">
                              <button id="btnDetalleHistoria" class="btn btn-info" type="button">Ver Historia</button>
                              <button id="btnEditar" class="btn btn-primary" type="button">Editar</button>
                              <button id="btnEliminar" data-id="${info.documento}" class="btn btn-danger eliminarbtn" type="button">Eliminar</button>
                          </div>
                      </div>`;
        },
      },
    ],
  });

  $("#titleUser").text("Pacientes");
  let modal = $("#myModal");
  let modalTitle = $("#modalTitle");
  let backGroundColorPrimary = $("body").css("background-color");
  let closeBtn = $("#closeModal");
  let backGroundModal;
  let labelsForm = {};
  let btn = $(".btnDiv #btnPaciente");
  let form = $("#formPaciente");
  //False para editar, true para registrar.
  let editMode;

  function closeModal(modal) {
    modal.fadeOut();
    $("body").css("background-color", backGroundColorPrimary);
    //Reinicio el modal para que cuando presione el botón de agregar modal se limpien los registros.
    form[0].reset();
  }
  function openModal(modal) {
    modal.fadeIn();
    $("body").css("background-color", "lightgray");
  }

  function modalKeydown() {
    //Cerrar modal con la tecla escape(27), se implementa off para que se aplique una sola vez.
    $(document)
      .off("keydown")
      .on("keydown", function (e) {
        if (e.keyCode == 27) {
          closeModal(modal);
        }
      });
  }

  //Función para enviar las propiedades específicas del modal.
  function modalPropertyes(labelsForm, modalTitle, btn, backGroundModal) {
    console.log(labelsForm);
    console.log({ "texto botón": labelsForm.textBtn });
    modalTitle.text(labelsForm.title);
    $("#labelDocumento").text(labelsForm.labelDocumento);
    $("#labelNombre").text(labelsForm.labelNombre);
    $("#labelApellido").text(labelsForm.labelApellido);
    $("#labelDireccion").text(labelsForm.labelDireccion);
    $("#labelTelefono").text(labelsForm.labelTelefono);
    $("#labelEmail").text(labelsForm.labelEmail);

    console.log(btn);
    btn.text(labelsForm.textBtn);
    // Aquí cambiamos el texto del botón usando `labelsForm.textBtn`

    $(".backgroundModal").css("color", backGroundModal);
  }

  closeBtn.on("click", function (e) {
    e.preventDefault();
    closeModal(modal);
  });

  //Mostrar modal de registro
  $("#btnAddPaciente").on("click", function (g) {
    editMode = false; //Modo insert
    g.preventDefault();
    g.stopPropagation();
    openModal(modal);
    modalKeydown();
    backGroundModal = "#26A69A";
    labelsForm = {
      title: "Agregar paciente",
      labelDocumento: "Número de documento",
      labelNombre: "Nombre",
      labelApellido: "Apellido",
      labelDireccion: "Dirección",
      labelTelefono: "Teléfono",
      labelEmail: "Email",
      textBtn: "Registrar",
    };

    //Aplico propiedades específicas al modal.
    modalPropertyes(labelsForm, modalTitle, btn, backGroundModal);
  });

  //Capturar datos del paciente.
  $(document).on("click", "#btnEditar", function () {
    editMode = true; //Modo editar
    console.log({ "mode update": editMode });
    let row = $(this).closest("tr");
    let data = myTable.row(row).data();
    let radioButtonNombres;
    let radioButtonIds = [];

    //btn.text('Guardar cambios');

    openModal(modal);
    modalKeydown();

    backGroundModal = "#2bbbad";
    labelsForm = {
      title: "Editar paciente",
      labelDocumento: "Número de documento",
      labelNombre: "Nombre",
      labelApellido: "Apellido",
      labelDireccion: "Dirección",
      labelTelefono: "Teléfono",
      labelEmail: "Email",
      textBtn: "Guardar Cambios",
    };

    modalPropertyes(labelsForm, modalTitle, btn, backGroundModal);

    //Extraigo los ids y nombres del hobbie que contiene el usuario.
    let dataIdEstrato = parseInt(data.idEstrato);
    let dataIdGenero = data.idGenero;
    let dataGeneroNmbr = data.genero;

    $("#documentoPaciente").val(data.documento);
    $("#nombrePaciente").val(data.nombrePaciente);
    $("#apellidoPaciente").val(data.apellidoPaciente);
    $("#direccionPaciente").val(data.direccionPaciente);
    $("#telefonoPaciente").val(data.telefonoPaciente);
    $("#emailPaciente").val(data.emailPaciente);

    //Estrato
    $('input[name="radioEstrato"]').each(function () {
      //Valor del radio Button actual, por defecto es el 1.
      let radioButtonValue = $(this).val();

      // Comparo el valor del radio button del formulario con el del paciente.
      if (parseInt(radioButtonValue) === dataIdEstrato) {
        //Selecciono el radio button.
        $(this).prop("checked", true);
      }
    });

    //Genero TODO: POR ARREGLAR.
    // $('#pacienteGeneroSelect').find('option').each(function () {
    //   let valueGenero = $(this).val();  // Obtiene el valor de la opción

    //   // Si el valor de la opción coincide con el valor de dataIdGenero
    //   if ($(this).val() === dataIdGenero) {
    //     console.log('dentro del if.');
    //       //$(this).prop('selected', true);
    //       $("#pacienteGeneroSelect option[value="+ dataIdGenero +"]").attr("selected",true);
    //       //console.log($(this).prop('selected', true));

    //   }
    // });

    //Opción generada por chatGpt
    $("#pacienteGeneroSelect").val(data.idGenero);
  });

  //Botón para enviar datos a php.
  $(document).on("click", "#btnPaciente", function (f) {
    f.preventDefault();
    f.stopPropagation();


    let row = myTable.row($(this).closest('tr'));
    let dataRow = row.data();

    console.log({"datos capturados":dataRow});

    // Capturar datos del formulario
    let dataEdit = form.serializeArray();
    let dataRegister = JSON.stringify(dataEdit);
    console.log(dataRegister);

    // Verificar si estamos en modo de edición
    if (editMode) {
      // Modo edición (actualización)
      console.log({ "modo edit": dataEdit });
      //Swal.fire({
    //       title: '¿Estás seguro de agregar este paciente?',
    //       showDenyButton: true,
    //       showCancelButton: true,
    //       confirmButtonText: 'Sí',
    //       denyButtonText: 'No',
    //       cancelButtonText: 'Cancelar',
    //     }).then((result) => {
    //       if (result.isConfirmed) {
    //         $.ajax({
    //           type: "POST",
    //           url: "querys/functionsInsert.php",
    //           data: {
    //             data: dataJson,
    //             codigo: 1
    //           },
    //           dataType: "json",
    //           success: function (data) {
    //             console.log(data.success);
    //             Swal.fire({
    //               title: data.success,
    //               icon: 'success',
    //               confirmButtonText: 'Aceptar',
    //               showCancelButton: false
    //             });
    //             closeModal(modal);
    //             myTable.ajax.reload();
    //             $('#formPaciente')[0].reset();
    //           }
    //         });
    //       }
    //     }).catch((err) => {
    //       console.error(err);
    //     });
    } else {
      console.log(dataRegister);
      // Modo registro (insertar)


    
      Swal.fire({
        title: "¿Estás seguro de agregar este paciente?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Sí",
        denyButtonText: "No",
        cancelButtonText: "Cancelar",
      })
        .then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              type: "POST",
              url: "querys/functionsInsert.php",
              data: {
                data: dataRegister,
                codigo: 1,
              },
              dataType: "json",
              success: function (data) {
                console.log(data);
                if (data.error) {
                  Swal.fire({
                    title: "Error",
                    text: data.error,
                    icon: "error",
                    showConfirmButton: true,
                    confirmButtonText:"Aceptar"
                  });
                  
                }else{
                  Swal.fire({
                    title: "Registro Exitoso",
                    text: data.success,
                    icon: "success",  
                    showConfirmButton: true,
                    confirmButtonText: "Aceptar"
                  });
                  
                  
                  closeModal(modal);
                  myTable.ajax.reload();
                  $("#formPaciente")[0].reset();
                  
                }
                
                
                
              },
            });
          }
        })
        .catch((err) => {
          console.error(err);
        });
    }

    
  });

  //Cerrar sesión
  $("#close").on("click", function (f) {
    f.preventDefault();
  });
});
