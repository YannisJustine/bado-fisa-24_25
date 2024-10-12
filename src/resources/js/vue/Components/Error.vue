<template>
<Conditionnal :condition="hasError(name)" class="mt-2">
    <p v-for="error in errors[name]" class="text-red-500 text-sm italic">
        {{ error }}    
    </p>
</Conditionnal>
</template>

<script setup>
import Conditionnal from './Conditionnal.vue'

const props = defineProps({
    'name': String,
    'errors': Object,
})

const hasError = (key) => {
    return props.errors && props.errors[key] !== undefined
}
</script>