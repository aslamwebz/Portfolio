<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Resume from './Components/Resume.vue';
import Services from './Components/Services.vue';
import Footer from './Components/Footer.vue';
import Contact from './Components/Contact.vue'
import Hero from "@/Pages/Components/Hero.vue";
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="py-6">
            <!-- hero section -->
            <Hero></Hero>

            <!-- Services -->
            <Services></Services>

            <!-- Resume Experience Section -->
            <Resume></Resume>

            <!-- Resume Experience Section -->
            <Contact></Contact>
            <!-- Footer -->
            <Footer></Footer>
        </div>

    </AuthenticatedLayout>
</template>

<style scoped>

</style>
