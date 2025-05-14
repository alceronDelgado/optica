export const succesAlt = (text = "") => {
  return Swal.fire({
    icon: "success",
    title: "!Exito!",
    text: text,
    draggable: true,
  });
};

export const errorAlert = (text = "") => {
  return Swal.fire({
    icon: "error",
    title: "Error",
    text: text || "Algo salió mal. Por favor, intenta nuevamente.",
  });
};

export const loginSuccess = async (redirectUrl = '/index.php',title = "",getDataFn) => {
  await Swal.fire({
    icon: "info",
    title: title,
    showCancelButton: false,
    cancelButtonText: false,
    timer: 3000,
    timerProgressBar: true,
    //El bloque didOpen se ejecuta SOLO CUANDO se abre el PopUp
    didOpen: async () => {
      //Muestra en mi mensaje de alerta el modal de cargando.
      Swal.showLoading();

      try {

        const result = await getDataFn();

      Swal.close();

      if (result.success) {
        await Swal.fire({
          icon: 'success',
          title: '¡Éxito!',
          text: result.message,
          timer: 2000,
          showConfirmButton: false
        });
        window.location.href = redirectUrl;
      } else {
        await Swal.fire({
          icon: 'error',
          title: 'Error',
          text: result.message,
          showConfirmButton: true
        });
      }
        if (!result) {
          return;
        }
      } catch (error) {
        
      }
    },
    willClose: () => {
      
      Swal.close();
    },
  });


  
};


export const loading = (title = "Cargando...") => {
  return Swal.fire({
    icon: "info",
    title: title,
    showCancelButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: () => {
      Swal.showLoading();
    },
  });
};

export default {
  succesAlt,
  errorAlert,
  loginSuccess,
  loading
};
