<template>
    <div id="modal" aria-hidden="true"  @click.self="handleCancel" class="bg-gray-900 bg-opacity-50 dark:bg-opacity-80 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 max-h-full">
        <div id="alert-additional-content-2"
            class="relative max-w-lg w-full p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
            role="alert">
            <div class="text-center text-gray-300">
                <h1 class="text-3xl font-bold">
                    {{ title }}
                </h1>

                <template v-for="(value, key) in errors">
                    <Error :name="key" :errors="errors" />
                </template>
                <p class="mt-2 text-xl text-gray-200">
                    <slot></slot>
                </p>
                <div class="flex justify-between mt-4">

                    Date départ : {{ dateDepart }}

                    <svg class="w-10 h-10 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 14 3-3m-3 3 3 3m-3-3h16v-3m2-7-3 3m3-3-3-3m3 3H3v3"/>
                    </svg>
                    
                    Date arrivée : {{ dateArrive }}
                </div>
                <div class="my-5">
                    <button @click="handleConfirm" class="mx-1 py-2 px-4 rounded bg-gray-500 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-500 dark:hover:text-white text-gray-700 dark:text-gray-200">
                        Valider
                    </button>
                    <button @click="handleCancel" class="mx-1 py-2 px-4 rounded bg-red-500 dark:bg-red-700 hover:bg-red-300 dark:hover:bg-red-500 dark:hover:text-white text-red-700 dark:text-gray-200">
                        Refuser
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onBeforeUpdate, ref } from 'vue';
import API from '../../utils/api';
import Error from './Error.vue';

const props = defineProps(['title', 'onConfirm', 'onCancel', 'oldEvent', 'newEvent']);
const errors = ref([]);
let dateDepart = null;
let dateArrive = null;

const generateBody = (oldEvent, newEvent) => {
    let body = {
        id : oldEvent.id,
        date_arrive: newEvent.start.toLocaleDateString('fr-CA'),
        start: newEvent.start.toLocaleTimeString('fr-FR') , 
        end: newEvent.end.toLocaleTimeString('fr-FR')
    }

    return body;
}

const handleConfirm = async () => {
    try {
        let body = generateBody(props.oldEvent, props.newEvent);
        let response = await API.updateEvent(props.oldEvent.id, body);
        if (response.ok && props.onConfirm) {
            props.onConfirm();
        }
        else {
            let json = await response.json();
            errors.value = json.errors;
        }
    } catch (error) {
        console.error(error);
        errors.value = json.errors;
    }
};

const handleCancel = () => {
    if (props.onCancel) {
        props.onCancel();
        errors.value = [];
    }
};

onBeforeUpdate(() => {
    if (props.oldEvent && props.newEvent) {
        dateDepart = props.oldEvent.start.toLocaleDateString('fr-FR');
        dateArrive = props.newEvent.start.toLocaleDateString('fr-FR');
    }

});

</script>
