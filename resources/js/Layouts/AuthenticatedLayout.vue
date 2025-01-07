<script setup>
import { ref } from "vue";
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

        <div class="main-content relative mx-[6%]">

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
