import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction'; // for selectable
import timeGridPlugin from '@fullcalendar/timegrid';
import "../css/calendar.css";

document.addEventListener('DOMContentLoaded', function () {

    const calendarEl = document.querySelector('#calendar');
    console.log(calendarEl)
    if(!calendarEl)
        return;

    let calendar = new Calendar(calendarEl, {
        plugins: [ dayGridPlugin, timeGridPlugin, interactionPlugin],
        selectable: true, 
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'dayGridMonth,timeGridDay',
            center: 'title',
            right: 'prev,next today'
        },

        height: 'auto',
    })

    calendar.render();

})

