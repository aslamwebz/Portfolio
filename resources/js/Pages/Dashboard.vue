<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Services from './Components/Services.vue';
import Footer from './Components/Footer.vue';
import Hero from "@/Pages/Components/Hero.vue";
import About from "@/Pages/Components/About.vue";

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div>
            <!-- hero section -->
            <Hero />

            <!-- about section -->
            <About />

            <!-- Services -->
            <Services />



            <!-- Footer -->
            <Footer />
        </div>

    </AuthenticatedLayout>
</template>

<style scoped></style>
