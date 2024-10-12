<template>
    <div class="max-w-4xl mx-auto dark:text-gray-300">
        <FullCalendar ref='fullCalendar' :options="calendarOptions" />
    </div>

    <CreateModal @closeModal="closeCreateModal" @refetchEvents="refetchEvents" :show="createModal" :date="date" :candidats="candidats" :formateurs="availablesFormateurs" :formules="formules" :typePermis="typePermis"/>
    <DeleteModal @closeModal="closeDeleteModal" @refetchEvents="refetchEvents" :show="deleteModal" :candidats="candidats" :formateurs="formateurs" :event="eventClicked" />
    <Alert v-show="alertShow" :onConfirm="confirmCallback" :onCancel="cancelCallback" title="Confirmation" :oldEvent="oldEvent" :newEvent="newEvent"> 
        Voulez vous modifier cette date.
    </Alert>
</template>

<script setup>
import { ref, inject, computed } from 'vue'
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import frLocale  from '@fullcalendar/core/locales/fr';
   
import CreateModal from './CreateModalCalendar.vue'
import DeleteModal from './DeleteModalCalendar.vue'

import Alert from './Components/Alert.vue'
import "../../css/calendar.css";
import API from '../utils/api.js'
import { generateContinuousIntervals, isAvailable, intersect } from '../utils/hours.js'

const StatutEnum = inject('StatutEnum');

const DAY_BEFORE = 4;

const fullCalendar = ref(null);
const createModal = ref(false)
const deleteModal = ref(false)
const alertShow = ref(false)
const confirmCallback = ref(null)
const cancelCallback = ref(null)
const formateurs = ref();
const availablesFormateurs = ref(null);
const date = ref(null);
const candidats = ref(null);
const formules = ref();
const typePermis = ref();
const eventClicked = ref(null);

let oldEvent = null;
let newEvent = null;
let hours = null;
var events = null;

try {
    const response = (await API.getCandidats()).data;
    candidats.value = response
    formateurs.value = (await API.getFormateurs()).data
    hours = generateContinuousIntervals((await API.getCreneaux()).data)
    formules.value = (await API.getFormules()).data
    typePermis.value = (await API.getTypePermis()).data
} catch (error) {
    console.error(error);
}

const openCreateModal = () => {
    createModal.value = true
}

const closeCreateModal = () => {
    createModal.value = false
}

const closeDeleteModal = () => {
    deleteModal.value = false
}

const handleDateSelect = (selectInfo) => {
    const calendar = fullCalendar.value.getApi()

    const durationInMilliseconds = selectInfo.end - selectInfo.start;

    const durationInHours = durationInMilliseconds / (60 * 60 * 1000);
    const minDate = new Date();
    minDate.setDate(minDate.getDate() + DAY_BEFORE);

    if (calendar.view.type !== 'timeGridDay' && calendar.view.type !== 'timeGridWeek' || durationInHours > 2 || selectInfo.start.toLocaleDateString('fr-CA') <= minDate.toLocaleDateString('fr-CA')) {
        calendar.unselect()
        return;
    }

    const eventsInSlot = calendar.getEvents().filter(event => (
        event.start < selectInfo.end && event.end > selectInfo.start
    ));

    const start = selectInfo.start.toLocaleTimeString("fr-FR");
    const end = selectInfo.end.toLocaleTimeString("fr-FR");

    date.value = {
        day : selectInfo.start.toISOString().slice(0, 10),
        start: start,
        end: end,
    };

    const selectedDate = selectInfo.start.getDay();
    let formateurList = formateurs.value.filter(formateur => isAvailable(formateur, selectedDate, start, end));
    formateurList = formateurList.filter(formateur => {
        return !events.some(event => {
            let event_start = new Date(event.start).toLocaleTimeString("fr-FR");
            let event_end = new Date(event.end).toLocaleTimeString("fr-FR");
            return event.formateur_id === formateur.id
                    && event.date_reservation === selectInfo.start.toLocaleDateString('fr-CA')
                    && intersect(event_start, event_end, start, end)
                    && event.statut_id === StatutEnum.PLANIFIE;
        });
    });

    availablesFormateurs.value = formateurList;

    openCreateModal()

    calendar.unselect()
}

const handleEventClick = (clickInfo) => {
    if (clickInfo.event.display === 'background') {
        return;
    }
    eventClicked.value = clickInfo.event;
    deleteModal.value = true;
}

const handleDropEvent = (info) => {
    if(info.event.extendedProps.statut_id !== StatutEnum.ATTENTE || info.event.start < new Date()) {
        info.revert();
        return;
    }

    alertShow.value = true;
    oldEvent = info.oldEvent;
    newEvent = info.event;

    cancelCallback.value = () => {
        info.revert();
        alertShow.value = false;
    };

    confirmCallback.value = () => {
        alertShow.value = false;
    };

}

const handleDateClick = (info) => {
    const calendar = fullCalendar.value.getApi()
  
    if (info.view.type === 'dayGridMonth' || info.view.type === 'dayGridWeek') {
        calendar.changeView('timeGridDay', info.dateStr);
    }
}

const refetchEvents = (event) => {
    fullCalendar.value.getApi().refetchEvents();
}

const calendarOptions = {

    locales: frLocale,
    plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin],
    initialView: 'dayGridMonth',
    selectable: true,
    navLinks: true,
    dayMaxEventRows: true,
    eventStartEditable: true,
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
    businessHours: hours,
    selectConstraint: 'businessHours',

    slotMinTime: '06:00',  // Heure minimum pour les créneaux
    slotMaxTime: '22:00',  // Heure maximum pour les créneaux
    slotDuration: '01:00', // Durée d'un créneau

    displayEventTime: false,
    allDaySlot: false,
    expandRows: true,
    
    // Events
    events: async function(event) {
        events = (await API.getEvents(`start=${event.start.toLocaleDateString("fr-CA")}&end=${event.end.toLocaleDateString("fr-CA")}`)).data;
        return events;
    },
    eventConstraint: 'businessHours',

    // Callbacks
    select: handleDateSelect,
    eventClick: handleEventClick,
    dateClick: handleDateClick,
    eventDrop: handleDropEvent,

    // Langue
    locale: 'fr',
};


</script>
