/**
 * Archivo que muestra por pantalla el clima y la distancia entre nuestra ubicacion y la de la empresa
 */
$(document).ready(function () { //comprovamos que el documento esté cargado antes de hacer cualquier cosa

    //usamos el objeto navigator para obtener la ubi del dispositivo
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => { //recogemos la posicion actual

            //variables con nuestra longitud y nuestra latitud
            const latitud = position.coords.latitude;
            const longitud = position.coords.longitude;

            //API key necesaria para la URL
            const apikey = 'b32efd6d1baafc7e6c941e69c393722c';

            //URL de openweathermap, que nos proporciona los datos meteorológicos de nuestra ubicacion
            const url = `https://api.openweathermap.org/data/2.5/weather?lat=${latitud}&lon=${longitud}&appid=${apikey}`;

            //usamos fetch
            fetch(url)
                //recogemos los datos devueltos
                .then(response => { return response.json() })
                .then(data => {

                    //distancia calculada mediante la funcion 'calcularDistancia'
                    let distancia = calcularDistancia(latitud, longitud);

                    //temperatura pasada a grados celsius
                    let temperatura = Math.round(data.main.temp);
                    temperatura -= 273;

                    //tiempo climatico y velocidad del viento
                    let tiempo = data.weather[0].description;
                    let viento = Math.round(data.wind.speed);

                    //insertamos los datos en los campos
                    $('#dist').text(`Usted se encuantra a  ${distancia.toFixed(2)} km de nuestra tienda.`);
                    $('#temp').text(`Temperatura: ${temperatura} ºC`);
                    $('#tiempo').text(`Tiempo: ${tiempo}`);
                    $('#vel').text(`Viento: ${viento} km/h`);
                })
                //en caso de error, salta un mensaje de error
                .catch(function (err) {
                    alert('No se ha podido conectar al servidor del tiempo' + err.message);
                });//FIN fetch
        });//FIN 'getCurrentPosition'
    }//FIN 'navigator.geolocalizacion'

    //funcion que nos calcula la distancia entre nuestro punto hasta donde se localiza la empresa
    //recoge los valores de nuestra ubicacion actual
    function calcularDistancia(latitud, longitud) {

        //variables longitud y latitud de donde se "localiza Bakeries"
        const latitudBakeries = 38.126321728229556;
        const longitudBakeries = -0.800921454588233;

        //objeto math para pasar de grados a radianes
        const radianes = Math.PI / 180;

        //pasamos las coods a radianes
        const lat1Rad = latitudBakeries * radianes; //latitud Bakeries
        const long1Rad = longitudBakeries * radianes; //longitud Bakeries
        const lat2Rad = latitud * radianes; //latitud actual
        const long2Rad = longitud * radianes; //longitud actual

        //diferencia entre latitudes y longitudes
        const difLat = lat2Rad - lat1Rad;
        const difLong = long2Rad - long1Rad;

        // Fórmula de Haversine //
        const a = Math.sin(difLat / 2) * Math.sin(difLat / 2) +
            Math.cos(lat1Rad) * Math.cos(lat2Rad) *
            Math.sin(difLong / 2) * Math.sin(difLong / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        //radio de la Tierra en kilómetros
        const R = 6371;

        //calculamos la distancia en kilómetros
        const distancia = R * c;

        //devolvemos el valor de distancia
        return distancia;
    }
});