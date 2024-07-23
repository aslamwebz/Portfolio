<template>
    <div class="services py-12">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">My Services</h2>
            <p class="text-gray-600">There are many variations of passages of Lorem Ipsum available but the majority
                have suffered alteration in some form.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <ServiceCard v-for="service in services" :key="service.title" :icon="service.icon" :title="service.title"
                :description="service.description" />
        </div>
    </div>
</template>

<script setup>
import ServiceCard from './ServiceCard.vue';

const services = [
    {
        icon: 'fas fa-user',
        title: 'User Research',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ligula vel in.',
    },
    {
        icon: 'fas fa-pencil-ruler',
        title: 'Visual Design',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ligula vel in.',
    },
    {
        icon: 'fas fa-users',
        title: 'User Testing',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ligula vel in.',
    },
    {
        icon: 'fas fa-project-diagram',
        title: 'Prototype',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ligula vel in.',
    },
];


</script>

<style scoped>
.services {
    background-color: #f9f9f9;
}
</style>
