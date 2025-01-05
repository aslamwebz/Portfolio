<template>
    <div class="p-6 text-center transition-transform transform rounded-lg shadow-lg service-card hover:scale-105">
        <div class="mb-4 text-6xl icon">
            <i :class="icon"></i>
        </div>
        <h3 class="mb-2 text-xl font-bold">{{ title }}</h3>
        <p class="text-gray-600">{{ description }}</p>
    </div>
</template>

<script setup>
const props = defineProps(['icon', 'title', 'description']);

</script>

<style scoped>
.service-card {
    background-color: #fff;
}
</style>
