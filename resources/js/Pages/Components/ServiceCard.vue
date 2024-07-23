<template>
    <div class="service-card p-6 rounded-lg shadow-lg text-center transition-transform transform hover:scale-105">
        <div class="icon text-6xl mb-4">
            <i :class="icon"></i>
        </div>
        <h3 class="text-xl font-bold mb-2">{{ title }}</h3>
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
