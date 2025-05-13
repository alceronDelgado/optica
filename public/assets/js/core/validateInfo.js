const obje = {
  number: /^[0-9]{6,}$/,
  password: /^[a-zA-Z0-9@#%!()]{3,}$/,
  email: /^[0-9a-zA-Z._%+-]{4,30}@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
};

//Todo: modificar función que me permita validar los campos, su enfoque es eliminar los espacios en blanco y
const addText = (result, inputSelect, inputType) => {
  let spanElement = document.getElementById(`${inputSelect}`);
  //Si result es igual a false, entonces implementar el innerText, si es true, no.
  if (!result) {
    if (inputType === "email") {
      spanElement.textContent = 'Email no valido, minimo 4 caracteres, máximo 12 antes del arroba (@)';
    }
        
    if (inputType === 'password') {
      spanElement.textContent = 'Caracteres minimos incorrectos';
      
    }
  }else{
    spanElement.textContent = '';
  }

  
};

export const validateData = (data = {}) => {
  //tengo las llaves del arreglo.
  let keysObj = Object.keys(data);
  //Extraigo el valor para validar con switch case.
  let inputType = data[keysObj[0]][0];
  let valueData = data[keysObj[0]][1];

  //let inputSelector = data[keysObj[0]][2];
  let inputSelect = "";
  let result = false;
  switch (inputType) {
    case "email":
      inputSelect = "spanEmail";
      result = obje.email.test(valueData);
      addText(result, inputSelect, inputType);
      break;
    case "password":
      inputSelect = "spanPassword";
      result = obje.password.test(valueData);
      addText(result, inputSelect, inputType);
      break;

    default:
      return null;
  }

  // let regex = /[a-zA-Z]+/g;
  // //la idea de aca es validar la expresión regular e implementar el dentro de un div un span con el texto de que diga que no es optimo este genero.
  // let regexNumber = /[0-1]+/g;
  // generoValue.innerHTML = 'valor digitado: ' + genero;
  // //return alert('El genero digitado es '+genero);
  // //return regex.test(genero);
  // return regex.test(genero);
  //return data;
};

export default {
  validateData,
};
