import { validateData } from "./modules/login/validateInfo.js";
import { dataFetch } from "./modules/login/fetch.js";
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
   * traigo los roles, si en este archivo implemento mu
   * 
   */
  let datRol = dataFetch("app/api/getRoles.php", 'GET').then((roles)=>{
    let rolInput = document.querySelector('#rol_ids');
    
    rolInput.innerHTML = "<option disabled selected>Seleccione un rol</option>";
    roles.forEach(rl => {
      let optionInput = document.createElement('option');
      optionInput.value = rl.rol_id;
      optionInput.innerText = rl.rol_nombre;
      rolInput.appendChild(optionInput);

    });


    //Inicializar los elementos select. Esto es importante porque materialize pide renderizar los input.
    M.FormSelect.init(rolInput);


  });


  


});
