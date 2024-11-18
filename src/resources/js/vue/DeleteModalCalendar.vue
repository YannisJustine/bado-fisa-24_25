<template>
    <Modal :show="show" @closeModal="closeModal">
        <template #title> 
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white me-4">    
                {{ event.title }}
            </h3>
            <span class="text-sm font-medium px-2.5 py-0.5 rounded " 
                :class="StatutInfo[event.extendedProps.statut_id]['bg-color'] ">
                {{ StatutInfo[event.extendedProps.statut_id].text  }}
            </span>
        </template>

        <template #body>
         
            <div class="p-4 md:p-5 dark:text-gray-200">
                <template v-for="(value, key) in errors">
                    <Error :name="key" :errors="errors" />
                </template>
                <div class="bg-gray-600 p-4 rounded-md shadow-md">
                    <p class="text-xl font-semibold mb-2">Candidat : {{  `${candidat.prenom} ${candidat.nom}` }}</p>
                    <p class="text-lg mb-2">Formateur : {{  `${formateur.prenom} ${formateur.nom}` }}</p>
                    <p class="text-lg mb-2">Jour : {{ start }}</p>
                    <p class="text-lg mb-2">Durée : {{ duration }}</p>
                </div>
                <div class="flex justify-end mt-5">
                    <button @click="deleteEvent" data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                        Supprimer
                    </button>
                    <button @click="closeModal" class="mx-1 py-2 px-4 rounded bg-gray-500 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-500 dark:hover:text-white text-gray-700 dark:text-gray-200">
                        Quitter
                    </button>
                </div>
            </div>
        </template>
    </Modal>
</template>

<script setup>
import { ref, onBeforeUpdate, inject} from 'vue';
import API from '../utils/api.js';
import Modal from './Components/Modal.vue';
import Error from './Components/Error.vue';

const StatutInfo = inject('StatutInfo');

const props = defineProps({
    show: Boolean,
    event: JSON,
    candidats: Array,
    formateurs: Array
})

let start
let duration;
let candidat;
let formateur;
const errors = ref([]);


const emit = defineEmits(['closeModal', 'refetchEvents']);

const closeModal = () => {
    errors.value = [];
    emit('closeModal');
}

const deleteEvent = async () => {
    try {
        let response = await API.deleteEvent(props.event.id);
        if (response.ok) {
            emit('refetchEvents');
            closeModal();
        }
        else {
            let json = await response.json();
            errors.value = json.errors;
        }
    } catch (error) {
        console.error(error);
        errors.value = error;
    }
}




onBeforeUpdate(() => {
    start = props.event.start.toLocaleDateString("fr-FR");
    duration = `${props.event.start.toLocaleTimeString("fr-Fr")} - ${props.event.end.toLocaleTimeString("fr-Fr")}`;
    candidat = props.candidats.find(candidat => candidat.id === props.event.extendedProps.candidat_id);
    formateur = props.formateurs.find(formateur => formateur.id === props.event.extendedProps.formateur_id);
})

</script>