<template>
    <div>
        <div class="container py-8 mx-auto max-w-7xl">
            <section class="py-20 services">
                <div class="px-4 ">
                    <div class="p-10 mx-auto mb-12 text-center bg-gray-800 rounded-md shadow-2xl sm:col-span-3 shadow-black">
                        <h2 class="mb-4 text-3xl font-bold text-white sm:text-4xl">Services I Offer</h2>
                        <p class="text-gray-400">Specialized in creating modern, responsive, and user-friendly digital solutions
                            that help businesses grow and succeed.</p>
                    </div>
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                        <ServiceCard v-for="service in services"
                            :key="service.title"
                            :icon="service.icon"
                            :title="service.title"
                            :description="service.description"
                            :icon-bg-color="service.iconBgColor" />
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script setup>
import ServiceCard from './ServiceCard.vue';

const services = [
    {
        icon: 'fas fa-code',
        title: 'Web Development',
        description: 'Building modern, responsive websites and web applications using the latest technologies and best practices.',
        iconBgColor: '#3B82F6'
    },
    {
        icon: 'fas fa-database',
        title: 'Backend Development',
        description: 'Designing and implementing robust, scalable backend solutions and APIs for your applications.',
        iconBgColor: '#10B981'
    },
    {
        icon: 'fas fa-cloud',
        title: 'Cloud Solutions',
        description: 'Implementing and managing cloud infrastructure to ensure scalability and reliability.',
        iconBgColor: '#06B6D4'
    },
];
</script>

<style scoped>

</style>
