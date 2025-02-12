/**
 * Archivo donde validamos el formulario de login
 */
$(document).ready(function () { //Cuando la pagina haya cargado

    //submit formulario de login
    $('#form-login').submit((event) => {

        //recojo los valores del form y las guardo en variables
        var mail =  $('#mail').val();
        var clave = $('#clave').val();

        /* EXPRESIONES REGULARES */
        //variables con las expresiones regulares para validar los datos

        //letras, numeros, . _ -, tiene que tener @ y .
        //1 o más antes y despúes del @
        var mailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,7}$/;

        //al menos 8 caracteres, una mayúscula, una minúscula y un número, de 8 a 12
        //(?=.* ....) me asegura que se cumpla en caulquier parte de la cadena
        var claveRegex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_]).{8,20}$/;

         //validación del MAIL
         if (!mailRegex.test(mail) && mail == '' && mail == ' ') {
            alert('Correo electrónico inválido'); //mensaje de error
            $('#mail').css('border-color', 'red'); //cambiamos el color del borde incicando el error
            event.preventDefault(); //evitamos que se envien datos
            return; //volvemos atras
        } else {
            //cambiamos css del borde y fondo del input por si antes hubo un error
            $('#mail').css('border-color', '#ccc');
            $('#mail').css('background-color', 'white');
        }

        //validación de la CONTRASEÑA
        if (!claveRegex.test(clave) || clave == '' || clave == ' ') {
            alert('Contraseña inválida, debe contener minimo una letra mayúscula, una letra minúscula, un número y un caracter especial y mínimo 8 caracteres'); //mensaje de error
            $('#clave').css('border-color', 'red'); //cambiamos el color del borde incicando el error
            event.preventDefault(); //evitamos que se envien datos
            return; //volvemos atras
        } else {
            //cambiamos css del borde y fondo del input por si antes hubo un error
            $('#clave').css('border-color', '#ccc');
            $('#clave').css('background-color', 'white');
        }

    }); //FIN submit form login
});