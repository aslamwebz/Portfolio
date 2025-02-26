<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Hero from "@/Pages/Components/Hero.vue";
import About from "@/Pages/Components/About.vue";
import Projects from './Components/Projects.vue';
import Services from './Components/Services.vue';
import Skills from './Components/Skills.vue';
import Resume from './Components/Resume.vue';
import Contact from './Components/Contact.vue';
import Footer from './Components/Footer.vue';
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div>
            <!-- Hero section -->
            <Hero />

            <!-- About section -->
            <About />

            <!-- Skills section -->
            <Skills />

            <!-- Projects -->
            <Projects />

            <!-- Services -->
            <Services />

            <!-- Resume -->
            <!-- <Resume /> -->

            <!-- Contact -->
            <Contact />

            <!-- Footer -->
            <Footer />
        </div>
    </AuthenticatedLayout>
</template>

<style scoped></style>
