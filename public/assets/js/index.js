import { validateData } from "./modules/login/validateInfo.js";

document.addEventListener("DOMContentLoaded", function () {
  let form = document.getElementById("formLogin");
  let usuario = document.querySelector("#usu_email");
  let password = document.querySelector("#usu_clave");
  let rol = document.querySelector("#rol_id");
  let usuarioTye = usuario.type;
  let passwordTye = password.type;

  usuario.addEventListener("change", (e) => {
    let usuarioDt = usuario.value;
    let objUsuario = e.target.id;
    const objData = {
      objUsuario: [usuarioTye, usuarioDt,objUsuario]
    };
    validateData(objData);
  });

  password.addEventListener("change",(f)=>{
    let passwordDt = password.value;
    let objPassword = f.target.id;
    const objData = {
      objPassword: [passwordTye,passwordDt,objPassword]
    }

    validateData(objData);

  });

  // let valuesAndKeys = [];

  // valuesAndKeys.push([usuarioTye, usuarioDt]);
  // //console.log(valuesAndKeys);
  // valuesAndKeys.push([passwordTye, passwordDt]);
  // //console.log(valuesAndKeys);

  // for (let index = 0; index < keys.length; index++) {
  //   const element = keys[index];
  //   dtaObj[[element]] = valuesAndKeys[index];
  // }

  // //La idea es cambiar el span según la vista de la infomación.
  //validateData(dtaObj);
});
