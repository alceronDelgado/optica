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
                        <button id="btnAddHistoria" class="btn green btn-action" type="button">Crear Historia</button>
                        <button id="btnEditar" class="btn btn blue btn-action" type="button">Editar</button>
                        <button id="btnEliminar" data-id="${info.documento}" class="btn red eliminarbtn btn-action" type="button">Eliminar</button>
                        <button id="btnDetalleHistoria"  class="btn red eliminarbtn btn-action" type="button">Historia</button>
                      </div>
                  </div>`;
        },
      },
    ],
  });

  $("#titleUser").text("Pacientes");
  let modal = $("#myModal");
  let modalPaciente = $("#myModalHistoria");
  let modalTitle = $("#modalTitle");
  let backGroundColorPrimary = $("body").css("background-color");
  let closeBtn = $("#closeModal");
  let backGroundModal;
  let labelsForm = {};
  let lastData;
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
    //let codigoModalPaciente = 1;
    //let codigoModalHistoria = 2;



    modalTitle.text(labelsForm.title);
    $("#labelDocumento").text(labelsForm.labelDocumento);
    $("#labelNombre").text(labelsForm.labelNombre);
    $("#labelApellido").text(labelsForm.labelApellido);
    $("#labelDireccion").text(labelsForm.labelDireccion);
    $("#labelTelefono").text(labelsForm.labelTelefono);
    $("#labelEmail").text(labelsForm.labelEmail);

    // Aquí cambiamos el texto del botón usando `labelsForm.textBtn`
    btn.text(labelsForm.textBtn);

    $(".backgroundModal").css("color", backGroundModal);


    // if (codigoModal === 2) {
    //   modalTitle.text(labelsForm.title);
    //   btn.text(labelsForm.textBtn);
    //   $(".backgroundModal").css("color", backGroundModal);

    // }


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
    let codigoModal = 1;
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
    let row = $(this).closest("tr");
    let data = myTable.row(row).data();
    let radioButtonNombres;
    let radioButtonIds = [];
    lastData = data;


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

    //Extraigo los ids y nombres del estrato que contiene el usuario.
    let dataIdEstrato = parseInt(data.idEstrato);
    let dataIdGenero = data.idGenero;
    //
    let dataIdHobbies = data.idHobbies
      ? (Array.isArray(data.idHobbies) ? data.idHobbies : data.idHobbies.split(',').map(h => h.trim()))
      : [];

    $("#documentoPaciente").val(data.documento);
    $("#nombrePaciente").val(data.nombrePaciente);
    $("#apellidoPaciente").val(data.apellidoPaciente);
    $("#direccionPaciente").val(data.direccionPaciente);
    $("#telefonoPaciente").val(data.telefonoPaciente);
    $("#emailPaciente").val(data.emailPaciente);

    //Estrato
    $('input[name="estrato"]').each(function () {
      //Valor del radio Button actual, por defecto es el 1.
      let radioButtonValue = $(this).val();

      // Comparo el valor del radio button del formulario con el del paciente.
      if (parseInt(radioButtonValue) === dataIdEstrato) {
        //Selecciono el radio button.
        $(this).prop("checked", true);
      }
    });

    //Hobbies
    $('input[name="hobbies"]').each(function () {
      let checkboxButtonValue = $(this).val();

      if (dataIdHobbies.includes(checkboxButtonValue)) {
        $(this).prop("checked", true);

      }
    });

    console.log("Hobbies del paciente (convertidos a array):", dataIdHobbies);

    let valuesArray = $('#pacienteGeneroSelect option').map(function () {
      return $(this).val();
    }).get();
    console.log(typeof valuesArray);
    console.log(typeof dataIdGenero);

    valuesArray.forEach(itemGenero => {
      console.log(typeof itemGenero);

      if (parseInt(itemGenero) === parseInt(dataIdGenero)) {
        console.log('dentro del if.');

        // Selecciona el option correcto
        $("#pacienteGeneroSelect").val(dataIdGenero);
      }
    });
    //Debo re inicializar materialize porque materialize no cambia los select de manera dinámica, el los reemplaza.
    $('select').formSelect();

  });

  //Botón para enviar datos a php.
  $(document).on("click", "#btnPaciente", lastData, function (f) {
    f.preventDefault();
    f.stopPropagation();

    // Capturar datos del formulario
    let dataEdit = form.serializeArray();

    let hobbiesSeleccionados = [];

    $('input[name="hobbies"]:checked').each(function () {
      hobbiesSeleccionados.push($(this).val());
    });

    dataEdit.push({ name: "hobbies", value: hobbiesSeleccionados.join(",") });


    let dataRegister = JSON.stringify(dataEdit);

    // Verificar si estamos en modo de edición
    if (editMode) {

      console.log(dataRegister);

      //Lo ideal es usar este formato para poder comparar.
      Swal.fire({
        title: "¿Deseas actualizar los datos?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Guardar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "querys/functionsInsert.php",
            data: {
              codigo: 2,
              data: dataRegister,
              lastRow: lastData
            },
            dataType: "json",
            success: function (response) {
              //TODO: refactorizar y separar en función los mensajes de alertas.
              if (response.status === 'success') {
                Swal.fire({
                  title: "Exito",
                  icon: "success",
                  text: response.message,
                  showCloseButton: true,
                });

                closeModal(modal);
                //TODO: mejorar por dibujar la fila, debo de solicitar el último registro actualizado Y devolverlo en el json encode.
                myTable.ajax.reload();

              } else if (response.status === 'info') {
                console.log('hello world info');
              } else if (response.status === 'info') {
                console.log('hello world error');
              } else {
                console.log('error');
              }

              console.log(response);
            },
            error: function (xhr, error) {
              throw new Error("Error en la consulta", xhr, error);

            }
          });
        } else {
          console.log('cancelado');
        }

      })


    } else {
      // Modo registro (insertar)

      Swal.fire({
        title: "¿Estás seguro de agregar este paciente?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Sí",
        denyButtonText: "No",
        cancelButtonText: "Cancelar",
      }).then((result) => {
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
                  confirmButtonText: "Aceptar"
                });

              } else {
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

  //Eliminar paciente
  $(document).on("click", "#btnEliminar", function (e) {
    e.preventDefault();
    let rw = $(this).closest("tr");
    let data = myTable.row(rw).data();
    let documento = data.documento;

    swal.fire({
      title: "",
      text: "¿Esta seguro de eliminar este paciente?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Eliminar",
    }).then(respuesta => {
      if (respuesta.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "querys/functionsInsert.php",
          datatype: "json",
          data: {
            codigo: 3,
            documento: documento,
          },
          dataType: "json",
          success: function (data) {
            console.log(data);
            if (data.success) {
              Swal.fire({
                title: "¡Exito!",
                text: data.success,
                icon: "success",
                showConfirmButton: true,
                confirmButtonText: "Aceptar"
              });
              myTable.ajax.reload();
            } else {
              Swal.fire({
                title: "Error",
                text: data.error,
                icon: "error",
                showConfirmButton: true,
                confirmButtonText: "Aceptar"
              });
            }
          },
        });
      }

    });

  });

  //Cerrar sesión
  $('#close').on('click', function (f) {
    f.preventDefault();

    Swal.fire({
      title: "¿Deseas salir de la aplicación?",
      draggable: true,
      icon: 'info',
      showDenyButton: true,
      showCancelButton: false,
      confirmButtonText: "Si",
      denyButtonText: `No`
    }).then((result) => {
      if (result.isConfirmed) {

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
          url: 'querys/sessionDestroy.php',
          type: 'POST',
          success: function (data) {
            if (data) {

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
      } else if (result.isDenied) {
        Swal.close();
      }

    });

  });


  /***
   * 
   * Historia Paciente
   * 
   */

  //Abrir modal historia.
  $(document).on("click", "#btnAddHistoria", function (f) {
    f.preventDefault();
    f.stopPropagation();

    let dataPac = $(this).closest("tr");
    let data = myTable.row(dataPac).data();

    $('#documentoPacienteHistoria').text(data.documento);
    $('#nombrePacienteHistoria').text(data.nombrePaciente);
    $('#apellidoPacienteHistoria').text(data.apellidoPaciente);
    $('#telefonoPacienteHistoria').text(data.telefonoPaciente);
    $('#generoPacienteHistoria').text(data.genero);
    $('#estratoPacienteHistoria').text(data.estrato);

    console.log(data);

    $("#myModalHistoria").show();
    $('#btnHistoriaPaciente').text("Guardar");
    $('#modalTitleHistoria').text("Historia Clinica");
    modalTitle.text(labelsForm.title);
    $("#backgroundModalHistoria").css("color", 'red');
    $('body').css('background-color', 'lightgray');
    modalKeydown();

  });

  //Evento submit envio formulario.
  $(document).on('submit', '#formHistoriaPaciente', function (e) {
    e.preventDefault();
    e.stopPropagation();

    let dataHistoria = $(this).serializeArray();

    console.log(dataHistoria);

    let spanPaciente = $('#documentoPacienteHistoria').text();
    console.log('Documento del paciente: ' + spanPaciente);

    // Agrega el valor del span al array dataHistoria
    dataHistoria.push({ name: 'pac_id', value: spanPaciente });

    let dataHistoriaRegister = JSON.stringify(dataHistoria);
    console.log(dataHistoria);

    $.ajax({
      type: "POST",
      url: "querys/functionsInsert.php",
      data: {
        codigo: 4,
        data: dataHistoriaRegister
      },
      dataType: "json",
      success: function (response) {
        console.log(response);
        if (response.status === 'success') {
          Swal.fire({
            title: "Éxito",
            icon: "success",
            text: response.message,
            showCloseButton: true,
          });
          closeModal(modalPaciente);
          //Reinicio modal después de insertar una historia.
          $('#formHistoriaPaciente')[0].reset();
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          title: "Error",
          icon: "error",
          text: "Error en la consulta",
          showCloseButton: true,
        });
      }
    });
  });

  $(document).on('click', '#btnDetalleHistoria', function (e) {
    e.preventDefault();
    e.stopPropagation();

    let data = $(this).closest("tr");
    let dataHistoria = myTable.row(data).data();
    let documentoPaciente = dataHistoria.documento;
    $.ajax({
      url: 'querys/functionsSelectsTwo.php',
      type: 'POST',
      data: {
        codigoSelect: 2,
        documento: documentoPaciente
      },
      dataType: 'json',
      success: function (data) {
        let pacienteData = data.data.data;

        if (data.data.status === false) {
          Swal.fire({
            title: "Error",
            icon: "error",
            text: "No se encontraron datos.",
            showCloseButton: true,
          });
        }

        if (data.data.status === true) {
          $("#myModalHistoria").show();
          $('#btnHistoriaPaciente').hide();
          $('#modalTitleHistoria').text("Detalle Historia Clinica");
          $('body').css('background-color', 'lightgray');
          $('#documentoPacienteHistoria').text(pacienteData.documento);
          $('#nombrePacienteHistoria').text(pacienteData.nombre);
          $('#apellidoPacienteHistoria').text(pacienteData.apellido);
          $('#telefonoPacienteHistoria').text(pacienteData.telefono);
          $('#generoPacienteHistoria').text(pacienteData.genero);
          $('#estratoPacienteHistoria').text(pacienteData.estrato);
          $('#esferaOd').val(pacienteData.esfod);
          $('#cilindOD').val(pacienteData.cilod);
          $('#ejeOd').val(pacienteData.ejeod);
          $('#esferaId').val(pacienteData.esfoid);
          $('#cilindOI').val(pacienteData.ciloi);
          $('#ejeId').val(pacienteData.ejeoi);
          $('#diagOi').val(pacienteData.diaoi);
          $('#diagOd').val(pacienteData.diaod);
          $('#hist_motv').text(pacienteData.motv);
          $('#hist_recom').text(pacienteData.recom);
          modalTitle.text(labelsForm.title);
          modalKeydown();
        }
      }
    });
  });


  //Cerrar modal historia
  $(document).on('click', '#closeModalPaciente', function (e) {
    $("#myModalHistoria").hide();
    $('body').css('background-color', 'white');
    $('#formHistoriaPaciente')[0].reset();
    //$('#hist_recom').val('');
    //$('#hist_motv').val('');


  });






});
