/**
 * @param {String} url - url en donde vamos a solicitar los recursos que vamos a utilizar.
 * @param {String} method - método de envio [GET, PUT,PULL,POST];
 * @returns {Promise<object>} 
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
    let json = null;
    try {
    json = await response.json();
      
    } catch (e) {
       throw new Error(`No se pudo parsear la respuesta como JSON. Posiblemente no se encontró el recurso (${response.status})`);
    }



    //Valido en caso de que no haya traido ningun recurso.
    if (!response.ok) {
      return{
        statusCode: response.status,
        data: json
      }
    }

    return {
      statusCode: response.status,
      data: json
    };

  } catch (error) {
    console.error("Fallo en dataFetch:", error.message);
  return {
    statusCode: 500,
    data: { status: false, message: error.message }
  };
  }
};

export default {
  dataFetch,
};
