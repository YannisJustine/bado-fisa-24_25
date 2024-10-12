<template>
<div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
    <input v-model="model" :disabled="!hasFormulesOrHeureSupplementaire(candidatSelected, 'formules_conduite')" id="heure-radio-1" type="radio" value="formule" name="type_heure_conduite"  class="w-4 h-4 text-logo-orange-600 bg-gray-100 border-gray-300 focus:ring-logo-orange-500 dark:focus:ring-logo-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
    <label for="heure-radio-1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Formule</label>
</div>
</template>

<script setup>

</script>