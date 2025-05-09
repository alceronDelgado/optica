//Todo: modificar función que me permita validar los campos, su enfoque es eliminar los espacios en blanco y 
const reExpresion = () => {
    let spanDocu = document.getElementById('spanDocu');
    let inputDocum = document.querySelector('#inputDocum');
    let inputPassword = document.querySelector('#inputPassword');
    
    inputDocum.addEventListener('change', function () {
        if (!validarData(data)) {
            console.log(data);
            
            spanDocu.innerText = 'tipo de dato no permitido';
            //inputDocum.innerHTML = 'Genero no permitido';
        }
    });
}

export const validateData = () =>{
    let regex = /[a-zA-Z]+/g;
    //la idea de aca es validar la expresión regular e implementar el dentro de un div un span con el texto de que diga que no es optimo este genero.
    let regexNumber = /[0-1]+/g;
    generoValue.innerHTML = 'valor digitado: ' + genero;
    //return alert('El genero digitado es '+genero);
    //return regex.test(genero);
    return regex.test(genero);

}


    
export default {
    validateData
}