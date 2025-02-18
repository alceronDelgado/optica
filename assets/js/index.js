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

$(document).ready(function(){
    $('select').formSelect();  // Inicializa los select de Materialize
    M.updateTextFields(); // Asegura que los campos de texto (input) se muestren correctamente

    //Función submit
    $('#submit').click(function(e){

        e.preventDefault();

        let rol = $('#rol_id').val();
        let documento = $('#usu_docum').val();
        let password = $('#usu_clave').val();

        console.log(rol, documento, password);

        $.ajax({
            type: "POST",
            url: "src/querys/login.php",
            data: {
                usu_docum: documento,
                usu_clave: password,
                rol_id: rol

            },
            dataType: "json",
            success: function (info) {
                console.log(usu_docum, usu_clave, rol_id);
                if (info.success) {

                    Swal.fire({
                        "title": info.success,
                        "text": info.usuario,
                        "icon": 'success',
                        "showConfirmButton": false,
                        "timer":2500
                    })
                    //Establecer tiempo para redirección.
                    setTimeout(() => {
                        Swal.close();
                        window.location.href = 'src/dashboard.php';
                    }, 2500);
                }else{
                    
                    Swal.fire({
                        "title": 'Error',
                        "text" : info.error,
                        "icon" : 'error',
                        "showConfirmButton": false,
                        //Implementar html en el sweet Alert.
                        'html':`
                        <button type="submit" id="submit" class="btn waves-effect waves-light">Ok</button>`
                    });

                    //Evento click para cerrar el modal en caso de datos incorrectos.
                    $(document).on('click', '#submit', function() {
                        Swal.close(); //Cierra alerta sweetAlert
                    });
                }
            },
            error: function(error,xhr){
                Swal.fire(
                  'heading',
                  'Erorr al ingresar '+xhr,
                  'error'
                );
            }
            
        });


    });
});
