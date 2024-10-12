<template>
    <Modal :show="show" @closeModal="closeModal">
        <template #title>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">   
                Ajouter un événement
            </h3>
        </template>

        <template #body>
            <form autocomplete="on" @submit.prevent="handleForm" ref="form" class="p-4 md:p-5">
                <Error name="vehicule" :errors="errors" />
                <input type="hidden" name="date_reservation" :value="date?.day">
                <Error name="date_reservation" :errors="errors" />
                <div class="grid gap-4 mb-6 grid-cols-2">
                    <div class="col-span-2">
                        <label for="candidat"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Candidats</label>
                        <select name="candidat_id" id="candidat" @change="handleCandidatChange"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-logo-orange-500 focus:border-logo-orange-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-logo-orange-500 dark:focus:border-logo-orange-500">
                            <option label="Select candidat" selected></option>
                            <option class="hover:bg-logo-orange-500" v-for="candidat in candidats" :key="'candidat-' + candidat.id" :value="candidat.id"
                                :title="candidat.email">
                                {{ candidat.prenom }} {{ candidat.nom }} - {{ candidat.age }}
                            </option>
                        </select>
                        <Error name="candidat_id" :errors="errors" />
                    </div>
                    <Conditionnal class="col-span-2" :condition="isSelectedCandidate()">
                        <label for="type_heure" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type
                            d'heure</label>
                        <select name="type_heure" id="type_heure" @change="handleTypeHeureChange"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-logo-orange-500 focus:border-logo-orange-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-logo-orange-500 dark:focus:border-logo-orange-500">
                            <option label="Select Type heure" selected></option>
                            <option value="conduite" v-if="hasConduite(candidatSelected)">Heure de conduite</option>
                            <option value="accompagnement" v-if="hasAcc(candidatSelected)">Heure d'accompagnement</option>
                        </select>
                        <Error name="type_heure" :errors="errors" />
                    </Conditionnal>
                    <Conditionnal class="col-span-2" :condition="isConduite()">
                        <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type d'heure de conduite
                            utilisée</p>
                        <div class="grid gap-6 md:grid-cols-2">
                            <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                                <input v-model="typeHeureConduiteSelected"
                                    :disabled="!hasFormulesOrHeureSupplementaire(candidatSelected, 'formules_conduite')"
                                    id="heure-radio-1" type="radio" value="formule" name="type_heure_conduite"
                                    class="w-4 h-4 text-logo-orange-600 bg-gray-100 border-gray-300 focus:ring-logo-orange-500 dark:focus:ring-logo-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="heure-radio-1"
                                    class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Formule</label>
                            </div>
                            <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                                <input v-model="typeHeureConduiteSelected"
                                    :disabled="!hasFormulesOrHeureSupplementaire(candidatSelected, 'stock_heures_supplementaire')"
                                    id="heure-radio-2" type="radio" value="supplementaire" name="type_heure_conduite"
                                    class="w-4 h-4 text-logo-orange-600 bg-gray-100 border-gray-300 focus:ring-logo-orange-500 dark:focus:ring-logo-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="heure-radio-2"
                                    class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Supplémentaire</label>
                            </div>
                        </div>
                        <Error name="type_heure_conduite" :errors="errors" />
                    </Conditionnal>
                    <Conditionnal class="col-span-2" :condition="(isFormule() && isConduite()) || isAccompagnement()">
                        <label for="formule_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Formule
                            choisie</label>
                        <select name="formule_id" id="formule_id" @change="handleTypeFormule"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-logo-orange-500 focus:border-logo-orange-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-logo-orange-500 dark:focus:border-logo-orange-500">
                            <option label="Select Type formules" selected></option>
                            <template v-if="isFormule() && isConduite()">
                                <option v-for="formule in getCandidatFormules(candidatSelected)"
                                    :key="'conduite-' + formule.id" :value="formule.id">
                                    {{ formule.libelle }}
                                </option>
                            </template>
                            <template v-if="isAccompagnement()">
                                <option v-for="formule in getCandidatFormuleAcc(candidatSelected)"
                                    :key="'accompagnement-' + formule.id" :value="formule.id">
                                    {{ formule.libelle }}
                                </option>
                            </template>
                        </select>
                        <Error name="formule_id" :errors="errors" />
                    </Conditionnal>
                    <Conditionnal class="col-span-2" :condition="isConduite() && isSupplementaire()">
                        <label for="type_permis_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type de permis
                            choisie</label>
                        <select name="type_permis_id" id="type_permis_id" @change="handleTypePermis"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-logo-orange-500 focus:border-logo-orange-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-logo-orange-500 dark:focus:border-logo-orange-500">
                            <option label="Select Type permis"></option>
                            <option v-for="typePermis in getCandidatTypePermis(candidatSelected)" :key="typePermis.id"
                                :value="typePermis.id">
                                {{ typePermis.libelle }}
                            </option>
                        </select>
                        <Error name="type_permis_id" :errors="errors" />
                    </Conditionnal>

                    <Conditionnal class="col-span-2"
                        :condition="(isSelectedTypeHeure() && ((((isFormule() || isAccompagnement()) && isSelectedTypeFormule())) || ((isSupplementaire() && isSelectedTypePermis()))))">
                        <label for="formateur"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Formateurs</label>
                        <select name="formateur_id" id="formateur"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-logo-orange-500 focus:border-logo-orange-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-logo-orange-500 dark:focus:border-logo-orange-500">
                            <option label="Select formateur" selected></option>
                            <option v-for="formateur in getFormateurs()" :key="formateur.id"
                                :value="formateur.id">
                                {{ formateur.prenom }} {{ formateur.nom }}
                            </option>
                        </select>
                        <Error name="formateur_id" :errors="errors" />
                    </Conditionnal>
                    <div class="col-span-1">
                        <label for="start" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Heure de
                            début</label>
                        <input type="text" name="start" id="start"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-logo-orange-600 focus:border-logo-orange-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-logo-orange-500 dark:focus:border-logo-orange-500"
                            required="" readonly :value="date?.start">

                        <Error name="start" :errors="errors" />
                    </div>
                    <div class="col-span-1">
                        <label for="end" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Heure de
                            fin</label>
                        <input type="text" name="end" id="end"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-logo-orange-600 focus:border-logo-orange-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-logo-orange-500 dark:focus:border-logo-orange-500"
                            required="" readonly :value="date?.end">
                        <Error name="end" :errors="errors" />
                    </div>
                </div>

                <button type="submit"
                    class="text-white inline-flex items-center bg-logo-orange-700 hover:bg-logo-orange-800 focus:ring-4 focus:outline-none focus:ring-logo-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-logo-orange-600 dark:hover:bg-logo-orange-700 dark:focus:ring-logo-orange-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Ajouter l'heure
                </button>
            </form>
        </template>
    </Modal>
</template>

<script setup>
import { onUpdated, ref } from 'vue';
import API from '../utils/api.js';
import Modal from './Components/Modal.vue';
import Conditionnal from './Components/Conditionnal.vue';
import Error from './Components/Error.vue';

const props = defineProps({
    show: Boolean,
    date: JSON,
    candidats: JSON,
    formateurs: JSON,
    formules: JSON,
    typePermis: JSON
})

const emit = defineEmits(['closeModal', 'refetchEvents'])

const form = ref(null)
const errors = ref([])
const candidatSelected = ref(null)
const typeHeureSelected = ref(null)
const typeHeureConduiteSelected = ref(null)
const typePermisSelected = ref(null)
const typeFormuleSelected = ref(null)
const formateurSelected = ref(null)

const toggleModal = () => {
    emit('closeModal')
}

const closeModal = () => {
    toggleModal()
    clearValues()
    form.value.reset()
    errors.value = []
}

const clearValues = () => {
    candidatSelected.value = null
    typeHeureSelected.value = null
    typeHeureConduiteSelected.value = null
    typePermisSelected.value = null
    typeFormuleSelected.value = null
}

const clearErrors = () => {
    errors.value = []
}

const handleForm = async (e) => {
    const formData = new FormData(form.value)
    try {
        let response = await API.postEvent(formData);
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
    }
}

//C'est les meme fonctions mais c'est pas grave
const handleCandidatChange = (e) => { clearValues(); handleSelectionChange(candidatSelected, e, isSelectedTypeHeure, props.candidats); }

const handleTypeHeureChange = (e) => { handleSelectionChange(typeHeureSelected, e, isSelectedTypeHeure, null); }

const handleTypePermis = (e) => { handleSelectionChange(typePermisSelected, e, isSelectedTypePermis, null); }

const handleTypeFormule = (e) => { handleSelectionChange(typeFormuleSelected, e, null, null); }

const handleSelectionChange = (selectedValue, event, checkFunction, options) => {
    clearErrors();
    selectedValue.value = options ? options.find(item => item.id == event.target.value) : event.target.value;
};

const hasAcc = (candidat) => { return candidat.formules_conduite.data.filter(formule => formule.nb_heures_pedagogique).map(formule => formule.formule_id).length > 0; }

const hasConduite = (candidat) => { return (candidat.stock_heures_formule.data.filter(stock => stock.quantite_conduite_restante).length > 0 || candidat.stock_heures_supplementaire.data.filter(stock => stock.quantite_restante).length > 0) }

const isSelectedCandidate = () => !!candidatSelected.value;

const isSelectedTypeFormule = () => !!typeFormuleSelected.value;

const isSelectedTypePermis = () => !!typePermisSelected.value;

const isSelectedTypeHeure = () => !!typeHeureSelected.value;

const isSelectedTypeFormuleConduite = () => !!typeHeureConduiteSelected.value;

const isConduite = () => typeHeureSelected.value == 'conduite' && isSelectedTypeHeure();

const isAccompagnement = () => typeHeureSelected.value == 'accompagnement' && isSelectedTypeHeure();

const isFormule = () => typeHeureConduiteSelected.value == 'formule' && isSelectedTypeFormuleConduite();

const isSupplementaire = () => typeHeureConduiteSelected.value == 'supplementaire' && isSelectedTypeFormuleConduite();

const getCandidatFormules = (candidat) => {
    let candidatFormuleId = candidat.formules_conduite.data.map(formule => formule.formule_id);
    return props.formules.filter(formule => candidatFormuleId.includes(formule.id));
}

const getCandidatFormuleAcc = (candidat) => {
    let candidatFormuleId = candidat.formules_conduite.data.filter(formule => formule.nb_heures_pedagogique).map(formule => formule.formule_id);
    return props.formules.filter(formule => candidatFormuleId.includes(formule.id))
}

const getCandidatTypePermis = (candidat) => {
    let candidatTypePermisId = candidat.stock_heures_supplementaire.data.map(permis => permis.type_permis_id);
    return props.typePermis.filter(permis => candidatTypePermisId.includes(permis.id))
}

const getFormateurs = () => {
    let typePermisIdFormateur = typePermisSelected.value ? typePermisSelected.value : props.formules.find(formule => formule.id == typeFormuleSelected.value).type_permis.id;
    return props.formateurs.filter(formateur => formateur.type_permis.some(permis => permis.id == typePermisIdFormateur))
}

const hasFormulesOrHeureSupplementaire = (candidat, dataKey) => {
    return candidat[dataKey].data.length > 0
}

onUpdated(() => {

})

</script>