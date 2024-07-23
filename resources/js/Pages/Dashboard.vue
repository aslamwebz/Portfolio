<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Resume from './Components/Resume.vue';
import Services from './Components/Services.vue';
import Footer from './Components/Footer.vue';
import Contact from './Components/Contact.vue'
import Hero from "@/Pages/Components/Hero.vue";
import Skills from "@/Pages/Components/Skills.vue";
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div>
            <!-- hero section -->
            <Hero />

            <!-- Services -->
            <Services />

            <!-- Services -->
            <Skills />

            <!-- Resume Experience Section -->
            <Resume />

            <!-- Resume Experience Section -->
            <Contact />

            <!-- Footer -->
            <Footer  />
        </div>

    </AuthenticatedLayout>
</template>

<style scoped>

</style>
