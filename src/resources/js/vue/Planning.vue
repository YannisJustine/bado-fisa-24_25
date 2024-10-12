<template>
    <div class="max-w-5xl mx-auto dark:text-gray-300 grow">
        <FullCalendar ref="fullCalendar" :options="calendarOptions" />
    </div>
</template>

<script setup>
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import frLocale from '@fullcalendar/core/locales/fr';

import API from '../utils/api.js'
import { generateContinuousIntervals } from '../utils/hours.js'

import "../../css/calendar.css";
import { ref, onMounted } from 'vue';

const fullCalendar = ref(null);

const props = defineProps({
    user: Number,
});

onMounted(() => {
    document.getElementById('planning-tab').addEventListener('click', (event) => {
        if (fullCalendar.value) {
            let api = fullCalendar.value.getApi();
            api.refetchEvents();
            api.render();
        }
    })
});

const handleDateClick = (info) => {
    const calendar = fullCalendar.value.getApi()

    if (info.view.type === 'dayGridMonth' || info.view.type === 'dayGridWeek') {
        calendar.changeView('timeGridDay', info.dateStr);
    }
}

const calendarOptions = {

    locales: frLocale,
    plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin],
    initialView: 'timeGridWeek',
    dayMaxEventRows: true,
    selectable: true,
    navLinks: true,
    nowIndicator: true,

    // Barre de menu
    headerToolbar: {
        left: 'prev,today,next',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },

    // Contrainte vues
    views: {
        dayGridMonth: { // name of view
            titleFormat: { year: 'numeric', month: '2-digit', day: '2-digit' },
        },
    },

    // Contrainte horaires
    businessHours: generateContinuousIntervals((await API.getUserCreneaux(props.user)).data),

    eventConstraint: 'businessHours',
    selectConstraint: 'businessHours',

    slotMinTime: '06:00',  // Heure minimum pour les créneaux
    slotMaxTime: '22:00',  // Heure maximum pour les créneaux
    slotDuration: '01:00', // Durée d'un créneau

    displayEventTime: false,
    allDaySlot: false,
    expandRows: true,

    // Events
    events: async function (event) {
        return (await API.getUserEvents(props.user, `start=${event.start.toLocaleDateString("fr-CA")}&end=${event.end.toLocaleDateString("fr-CA")}`)).data;
    },
    dateClick: handleDateClick,

    // Langue
    locale: 'fr',
};

</script>



