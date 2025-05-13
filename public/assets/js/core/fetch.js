/**
 * @param {String} url - url en donde vamos a solicitar los recursos que vamos a utilizar.
 * @param {String} method - método de envio [GET, PUT,PULL,POST];
 * @returns {Promise<object>} - Respuesta del json después de ejecutar la función.
 * 
 * 
 */
export const dataFetch = async (url, method = "GET", data = null) => {
  try {
    const options = {
      method: method,
      // Como vamos a enviar la información
      headers: {
        "Content-Type": "application/json",
      },
      //BODY = Se envia el body solo cuando vamos a enviar datos en post o put
    };

    /**
     * se valida si el objeto tiene en la propiedad method el valor de o POST, PUT O DELETE, si lo tiene entonces al objeto implementarle el body.
     *
     */
    if (
      ["POST", "PUT", "DELETE"].includes(options.method.toUpperCase()) &&
      data
    ) {
      options.body = JSON.stringify(data);
    }

    let response = await fetch(url, options);

    //Espero a que traiga todos los datos para después transformarlo en json.
    let json = await response.json();


    //Valido en caso de que no haya traido ningun recurso.
    if (!response.ok) {
      throw new Error(`Error en la petición: ${response.status}`);
    }

    return json;

  } catch (error) {
    console.log(error);
  }
};

export default {
  dataFetch,
};
