<script setup>
import { ref } from 'vue';
import ProjectCard from '@/Pages/Components/Projects/ProjectCard.vue';

const projects = ref([
    {
        id: 'hearty-meal',
        title: 'Hearty Meal',
        description: 'An innovative food ordering platform that connects local restaurants with hungry customers. Features include real-time order tracking, customizable menus, and a seamless checkout process.',
        image: '/img/hearty-meal.jpg'
    },
    {
        id: 'project-2',
        title: '',
        description: '',
        image: ''
    },
    {
        id: 'project-3',
        title: '',
        description: '',
        image: ''
    },
    {
        id: 'project-4',
        title: '',
        description: '',
        image: ''
    }
]);
</script>

<template>
    <section class="container mx-auto pt-[5rem] max-w-screen-2xl">
        <div class="py-6 bg-gray-800 rounded-md shadow-2xl shadow-black">
            <div class="px-4 py-8 mx-auto text-center">
                <h2 class="mb-4 text-5xl font-bold text-white">My Projects</h2>
                <p class="text-lg text-gray-400">
                    Take a look at some highlighted personal projects, showcasing my skills and passion for development.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 p-8 mx-auto md:grid-cols-2 max-w-7xl">
                <ProjectCard :project="projects[0]" />
                <ProjectCard :project="projects[1]" />
                <ProjectCard :project="projects[2]" />
                <ProjectCard :project="projects[3]" />
            </div>

            <div class="p-4 mt-8 text-center">
                <a href="#"
                    class="inline-flex items-center px-8 py-4 font-semibold text-white transition-all duration-300 rounded-lg bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
</template>
