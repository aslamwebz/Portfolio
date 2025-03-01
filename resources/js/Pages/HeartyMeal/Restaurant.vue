<template>
    <div>
        <Header />
        <RestaurantComponent :id="id" :restaurant="restaurant" :products="products" />
        <Footer />
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import Header from './Components/Header.vue';
import RestaurantComponent from './Components/Restaurant.vue';
import Footer from './Components/Footer.vue';

defineProps({
    id: {
        type: [String, Number],
        required: true
    },
    restaurant: {
        type: Object,
        default: null
    },
    products: {
        type: Array,
        default: () => []
    }
});
</script>
