/**
 * Archivo dende se crea un foro en sobre_nosotros.php
 */
window.addEventListener('load', () => { //evento que se activa la cargar la pagina

    //recojo el formulario 'foro' y div 'foro'
    const form = document.getElementById('form-foro');
    const foro = document.getElementById('foro');

    //funcion para crear el foro
    function crearForo(titulo, mensaje) {

        //creo un elemento div
        var postDiv = document.createElement('div');
        //le doy la clase 'post'
        postDiv.classList.add('post');

        //creo un elemento h3
        var postTitulo = document.createElement('h3');
        //guardo el titulo en el h3
        postTitulo.textContent = titulo;
        //añado el h3 al postDiv
        postDiv.appendChild(postTitulo);

        // Crear elemeto p
        var postMsj = document.createElement('p');
        //guardo el valor del textarea
        postMsj.textContent = mensaje;
        //añado el p al postDiv
        postDiv.appendChild(postMsj);

        //añado el postDiv al div 'foro'
        foro.appendChild(postDiv);
    }//FIN funcion crearForo

    //manejamos el evento submit del form
    form.addEventListener('submit', function (event) {
        event.preventDefault(); //evitamos que se envie el form

        //variables con los datos del form 'foro'
        var titulo = document.getElementById('titulo').value;
        var mensaje = document.getElementById('msj').value;

        //llamada a la funcion crearForo
        crearForo(titulo, mensaje);

        //limpiamos el form
        form.reset();
    }); //FIN evento 'submit'
}); //FIN evento 'load'