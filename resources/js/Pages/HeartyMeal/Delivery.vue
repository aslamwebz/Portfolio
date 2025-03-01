<template>
    <div class="min-h-screen bg-gray-50">
        <Header />
        <DeliveryTracking :orderId="id" />
    </div>
</template>

<script setup>
import Header from './Components/Header.vue';
import DeliveryTracking from './Components/DeliveryTracking.vue';

defineProps({
    id: {
        type: [String, Number],
        required: true
    }
});
</script>
