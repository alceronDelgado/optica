/**
 * user : 29114652
 * password: opt29
 *
 *
 * user: 14362442
 * password: oft14
 *
 * user: 63453452
 * password: re6345
 *
 */

import { validateData } from "./core/validateInfo.js";
import { dataFetch } from "./core/fetch.js";
import { loading, loginSuccess, succesAlt } from "./core/alerts.js";
document.addEventListener("DOMContentLoaded", function () {
  let formLogin = document.querySelector("#formLogin");
  let usuario = document.querySelector("#usu_email");
  let password = document.querySelector("#usu_clave");
  let rol = document.querySelector("#rol_id");
  let rolInput = document.querySelector("#rol_ids");
  let usuarioTye = usuario.type;
  let passwordTye = password.type;

  usuario.addEventListener("change", (e) => {
    let usuarioDt = usuario.value;
    let objUsuario = e.target.id;
    const objData = {
      objUsuario: [usuarioTye, usuarioDt, objUsuario],
    };
    validateData(objData);
  });

  password.addEventListener("change", (f) => {
    let passwordDt = password.value;
    let objPassword = f.target.id;
    const objData = {
      objPassword: [passwordTye, passwordDt, objPassword],
    };
    validateData(objData);
  });

  /**
   * Traigo los roles usando fetch pero esperando su respuesta, usando async y await.
   * Puedo implementarla también con then.
   *
   */
  const getRoles = async () => {
    let { statusCode, data } = await dataFetch("app/api/getRoles.php", "GET");
    let dataRoles = null;
    if (statusCode === 200 && data.status) {
      dataRoles = data.data;

      rolInput.innerHTML =
        "<option disabled selected>Seleccione un rol</option>";
      dataRoles.forEach((dtRol) => {
        let optionInput = document.createElement("option");
        optionInput.value = dtRol.rol_id;
        optionInput.innerText = dtRol.rol_nombre;
        rolInput.appendChild(optionInput);
      });
    }

    //   //Inicializar los elementos select. Esto es importante porque materialize pide renderizar los input.
    M.FormSelect.init(rolInput);
  };

  getRoles();

  let userData = {};
  //Evento submit del formulario.
  formLogin.addEventListener("submit", (f) => {
    f.preventDefault();
    f.stopPropagation();
    const form = new FormData(formLogin);
    userData = Object.fromEntries(form.entries());

    const getData = async () => {


      let { statusCode, data } = await dataFetch(
        "/optica/app/api/getUser.php",
        "POST",
        userData
      );

      if (statusCode === 200 && data.status) {
        return {
          success: true,
          message: data.message
        };
      }

      return {
        success: false,
        message: data?.message || 'Error en autenticación'
      };
    };

    //Limpiar formulario después de redireccionar.
    //formLogin.reset();

    loginSuccess("/optica/app/dashboard.php", "Cargando...", getData);
  });
});
