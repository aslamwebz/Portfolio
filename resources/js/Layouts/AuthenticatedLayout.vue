<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import Navbar from '@/Pages/Components/Navbar.vue';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <!-- Primary Navigation Menu -->
        <Navbar />

        <div class="main-content mx-[8%] relative">
            <!-- Animated AI Background -->
            <svg class="absolute inset-0 w-full h-full -z-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600">
                <circle cx="400" cy="300" r="200" fill="none" stroke="#00f" stroke-width="5">
                    <animate attributeName="r" from="200" to="250" dur="2s" repeatCount="indefinite" />
                </circle>
                <rect x="150" y="150" width="100" height="100" fill="none" stroke="#0f0" stroke-width="5">
                    <animate attributeName="x" from="150" to="550" dur="4s" repeatCount="indefinite" />
                </rect>
                <polygon points="400,100 450,200 350,200" fill="none" stroke="#f00" stroke-width="5">
                    <animate attributeName="points" from="400,100 450,200 350,200" to="400,200 450,300 350,300" dur="3s" repeatCount="indefinite" />
                </polygon>
            </svg>

            <!-- Page Heading -->
            <header class="bg-white" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

<style scoped>
.main-content {
    position: relative;
    overflow: hidden;
}
</style>
