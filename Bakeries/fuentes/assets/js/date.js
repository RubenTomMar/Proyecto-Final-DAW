/**
 * Archivo en el que sacamos la hora y la mostramos en la web
 */
$(document).ready(function () { //nos aseguramos que la pagina haya cargado

    //funcion sacar fecha y hora
    function getDateHour() {

        //obj fecha
        let date = new Date();

        //sacamos los valores dis, mes, año y dia de la semana (en número)
        let day = date.getDate();
        let month = date.getMonth() + 1;
        let year = date.getFullYear();
        let weekDay = date.getDay();

        day = ('0' + day).slice(-2);
        day = ('0' + day).slice(-2);

        //array para poner el duia de la semana que es
        let weekDays = ['DOMINGO', 'LUNES', 'MARTES', 'MIÉRCOLES', 'JUEVES', 'VIERNES', 'SÁBADO'];
        
        //variable con el dia de la semana (en letra)
        let getWeek = (weekDays[weekDay]);
        $('.fecha').text(`${getWeek} ${day}-${month}-${year}`);

        //variable con la hora
        let timeString = date.toLocaleTimeString();
        $('.hora').text(timeString);
    }

    //hacemos que se actualice cada segundo la función
    setInterval(() => {
        getDateHour();
    }, 1000);
});