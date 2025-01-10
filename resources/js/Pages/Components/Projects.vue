<script setup>
import { ref } from 'vue';
import ProjectCard from '@/Pages/Components/Projects/ProjectCard.vue';

const projects = ref([
    {
        id: 'trippz',
        title: 'Trippz - Travel Platform',
        description: 'A modern travel planning platform for creating personalized journey experiences.',
        image: '/images/trippz.jpg'
    },
    {
        id: 'Future project 1',
        title: '',
        description: '',
        image: ''
    },
    {
        id: 'Future project 2',
        title: '',
        description: '',
        image: ''
    },
    {
        id: 'Future project 3',
        title: '',
        description: '',
        image: ''
    }
]);
</script>

<template>
    <section class="container mx-auto pt-[5rem] max-w-screen-2xl">
        <div class="bg-gray-800 rounded-md shadow-black shadow-2xl py-6">
            <div class="px-4 py-8 mx-auto text-center">
                <h2 class="text-5xl font-bold text-white mb-4">My Projects</h2>
                <p class="text-gray-400 text-lg">
                    Take a look at some highlighted personal projects, showcasing my skills and passion for development.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-7xl mx-auto">
                <div class="space-y-8">
                    <ProjectCard :project="projects[0]" />
                    <ProjectCard :project="projects[2]" />
                </div>
                <div class="space-y-8">
                    <ProjectCard :project="projects[1]" />
                    <ProjectCard :project="projects[3]" />
                </div>
            </div>

            <div class="text-center mt-16 p-4">
                <a href="#"
                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-600 hover:to-blue-800 transition-all duration-300">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
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
