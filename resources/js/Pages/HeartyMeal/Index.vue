<template>
    <div class="min-h-screen bg-gray-50">
        <Header />
        <Dashboard :initialCategories="categories" :initialRestaurants="restaurants" />
    </div>
</template>

<script setup>
import Header from './Components/Header.vue';
import Dashboard from './Components/Dashboard.vue';

defineProps({
    categories: {
        type: Array,
        default: () => []
    },
    restaurants: {
        type: Array,
        default: () => []
    }
});
</script>

<style lang="scss" scoped></style>
