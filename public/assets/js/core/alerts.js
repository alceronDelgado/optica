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

export const loginSuccess = (redirectUrl = '/index.php',title = "") => {
  return Swal.fire({
    icon: "info",
    title: title,
    showCancelButton: false,
    cancelButtonText: false,
    timer: 3000,
    timerProgressBar: true,
    //El bloque didOpen se ejecuta SOLO CUANDO se abre el PopUp
    didOpen: () => {
      //Muestra en mi mensaje de alerta el modal de cargando.
      Swal.showLoading();
      setInterval(() => {}, 1000);
    },
    willClose: () => {
      clearInterval();
      Swal.close();
    },
  }).then(() => {
    //Redireccionar.
    window.location.href = redirectUrl;
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
