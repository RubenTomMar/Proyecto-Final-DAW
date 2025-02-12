/**
 * Archivo donde se valida el formulario de modificar datos (cuenta_usuario.php)
 */
$(document).ready(function () { //caundo la págica haya cargado

    //al pulsar el boton cerra sesion se recarga la pagina
    $('#btn-cerrar-sesion').click(() =>{
        window.location.reload(true);
    });

    //al pulsar el boton cancelar se oculta el form modificar usuario
    $('#cancelar-modif-usu').click(() => {
        $('#form-modif-usu').hide();
    });

    //submit formulario de registro
    $('#modif-usu').click((event) => {
        
        //recojo en variables los valores del formulario
        var nombreUsuario = $('#nombre-usuario').val();
        var nombre = $('#nombre').val();
        var apellidos = $('#apellidos').val();
        var mail = $('#mail').val();
        var direccion = $('#direccion').val();
        var telefono = $('#telefono').val();

        /* EXPRESIONES REGULARES */
        //variables con las expresiones regulares para validar los datos

        //letras, números, punto, guión bajo, guión, de 5 a 15
        //letras 1 o más, numeros y caracteres 0 o más
        var nombreUsuRegex = /^[a-zA-Z0-9._-]{5,15}$/;

        //letras con signos de puntiación, ñ y Ñ, espacios, de 3 a 18
        //letras 1 o más veces, espacios en blanco 0 o más
        var nombreRegex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]{3,15}$/;

        //letras con signos de puntiación, ñ y Ñ, espacios, de 3 a 50
        var apellidosRegex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]{3,50}$/;

        //letras, numeros, . _ -, tiene que tener @ y .
        //1 o más antes y despúes del @
        var mailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,7}$/;

        //se permiten letras, signos de puntuacion, numeros, espacios y los caracteres º ª / , . _ -
        var direccionRegex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1ºª/,._-]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*(\d)*[a-zA-ZÀ-ÿ\u00f1\u00d1]{1,50}$/;

        //solo digitos sin espacios
        var telefonoRegex = /^\d{9}$/;

        //validación del NOMBRE de USUARIO
        if (!nombreUsuRegex.test(nombreUsuario) || nombreUsuario == '' || nombreUsuario == ' ') {
            alert('Nombre de usuario inválido'); //mensaje de error
            $('#nombre-usuario').css('border-color', 'red'); //cambiamos el color del borde incicando el error
            event.preventDefault(); //evitamos que se envien datos
            return; //volvemos atras
        } else {
            //cambiamos css del borde y fondo del input por si antes hubo un error
            $('#nombre-usuario').css('border-color', '#ccc');
            $('#nombre-usuario').css('background-color', 'white');
        }

        //validación del NOMBRE
        if (!nombreRegex.test(nombre) || nombre == '' || nombre == ' ') {
            alert('Nombre inválido'); //mensaje de error
            $('#nombre').css('border-color', 'red'); //cambiamos el color del borde incicando el error
            event.preventDefault(); //evitamos que se envien datos
            return; //volvemos atras
        } else {
            //cambiamos css del borde y fondo del input por si antes hubo un error
            $('#nombre').css('border-color', '#ccc');
            $('#nombre').css('background-color', 'white');
        }

        //validación del APELLIDOS
        if (!apellidosRegex.test(apellidos) || apellidos == '' || apellidos == ' ') {
            alert('Apellidos inválido'); //mensaje de error
            $('#apellidos').css('border-color', 'red'); //cambiamos el color del borde incicando el error
            event.preventDefault(); //evitamos que se envien datos
            return; //volvemos atras
        } else {
            //cambiamos css del borde y fondo del input por si antes hubo un error
            $('#apellidos').css('border-color', '#ccc');
            $('#apellidos').css('background-color', 'white');
        }

        //validación del MAIL
        if (!mailRegex.test(mail) || mail == '' || mail == ' ') {
            alert('Correo electrónico inválido'); //mensaje de error
            $('#mail').css('border-color', 'red'); //cambiamos el color del borde incicando el error
            event.preventDefault(); //evitamos que se envien datos
            return; //volvemos atras
        } else {
            //cambiamos css del borde y fondo del input por si antes hubo un error
            $('#mail').css('border-color', '#ccc');
            $('#mail').css('background-color', 'white');
        }

        //validación de la DIRECCION
        if (!direccionRegex.test(direccion) || direccion == '' || direccion == ' ') {
            alert('Dirección inválida'); //mensaje de error
            $('#direccion').css('border-color', 'red'); //cambiamos el color del borde incicando el error
            event.preventDefault(); //evitamos que se envien datos
            return; //volvemos atras
        } else {
            //cambiamos css del borde y fondo del input por si antes hubo un error
            $('#direccion').css('border-color', '#ccc');
            $('#direccion').css('background-color', 'white');
        }

        //validación de la TELEFONO
        if (!telefonoRegex.test(telefono) || telefono == '' || telefono == ' ') {
            alert('Telefono inválido'); //mensaje de error
            $('#télefono').css('border-color', 'red'); //cambiamos el color del borde incicando el error
            event.preventDefault(); //evitamos que se envien datos
            return; //volvemos atras
        } else {
            //cambiamos css del borde y fondo del input por si antes hubo un error
            $('#telefono').css('border-color', '#ccc');
            $('#telefono').css('background-color', 'white');
        }

    });//FIN submit 'form-modif-usu'
});