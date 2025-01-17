<template>
    <div>
        <Header />
        <RestaurantComponent :restaurantId="id" />
    </div>
</template>

<script setup>
import Header from './Components/Header.vue';
import RestaurantComponent from './Components/Restaurant.vue';

defineProps({
    id: {
        type: [String, Number],
        required: true
    }
});
</script>
