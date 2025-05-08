import { reExpresion } from "./modules/login/validateInfo.js";

let form = document.getElementById("formLogin");

form.addEventListener("submit", (e) => {
  e.preventDefault();
  e.stopPropagation();

  let usuario = document.getElementById("usu_docum").value;
  let password = document.getElementById("usu_docum").value;
  let rol = document.getElementById("rol").value;

  const form = new FormData(form);
  let data = form.entries();
  console.log(data);
  let arr = [];
  for ([usuario, password, rol] of data) {
    arr.push(data);
    console.log(arr);
  }

  //La idea es cambiar el span según la vista de la infomación.
  reExpresion.validateData(arr);
});
