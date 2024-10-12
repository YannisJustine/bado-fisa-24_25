<template>
    <Transition mode="out-in">   
        <div v-if="condition">
            <slot></slot> 
        </div>
    </Transition>
</template>

<script setup>

const props = defineProps({
    condition: Boolean
})

</script>


