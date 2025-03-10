<script setup>
import { ref } from 'vue';
import ProjectCard from '@/Pages/Components/Projects/ProjectCard.vue';

const currentIndex = ref(0);
const projects = ref([
    {
        id: 'hearty-meal',
        link: '/hearty-meal',
        title: 'Hearty Meal',
        description: 'An innovative food ordering platform that connects local restaurants with hungry customers. Features include real-time order tracking, customizable menus, and a seamless checkout process.',
        image: '/img/hm-main.png',
        github: 'https://github.com/aslamwebz/Portfolio/tree/main/resources/js/Pages/HeartyMeal',
        technologies: ['php', 'laravel', 'vue', 'tailwind'],
        category: 'Vue'
    },
    {
        id: 'portfolio-site',
        link: '/',
        title: 'Developer Portfolio',
        description: 'My personal portfolio website built with modern technologies to showcase my projects and skills in an interactive way.',
        image: '/img/portfolio-main.png',
        github: 'https://github.com/aslamwebz/portfolio',
        technologies: ['php', 'laravel', 'vue', 'tailwind'],
        category: 'Vue'
    },
    {
        id: 'ai-projects',
        link: '',
        title: 'AI Projects',
        description: 'A collection of AI projects using Python and Crew AI that use AI to enhance functionality and user experiences.',
        image: '/img/ai-main.png',
        github: 'https://github.com/aslamwebz/ai',
        technologies: ['python', 'crewai', 'Ollama', 'openai', 'streamlit'],
        category: 'AI'
    },
    {
        id: 'laravel-ai',
        link: '/ai',
        title: 'AI Laravel Projects',
        description: "A collection of Laravel projects that use AI to enhance functionality and user experiences.",
        image: '/img/ai-main.png',
        github: 'https://github.com/aslamwebz/Portfolio/blob/dev/app/Http/Controllers/AIController.php',
        technologies: ['laravel', 'vue', 'openai', 'tailwind'],
        category: 'AI'
    },
]);

const nextProject = () => {
    currentIndex.value = (currentIndex.value + 1) % projects.value.length;
};

const previousProject = () => {
    currentIndex.value = currentIndex.value === 0
        ? projects.value.length - 1
        : currentIndex.value - 1;
};

const setProject = (index) => {
    currentIndex.value = index;
};

const handleImageError = (event) => {
    event.target.src = '/img/placeholder.png';
};
</script>

<template>
    <section id="projects" class="container px-4 py-8 mx-auto max-w-7xl">
        <div class="p-6 rounded-xl">
            <div class="p-8 mx-auto my-10 text-center bg-gray-800 rounded-md shadow-2xl shadow-black">
                <h2 class="text-xl font-bold text-white sm:text-2xl">My Projects</h2>
            </div>
            <div class="relative space-y-4">
                <!-- Main Project Image Container -->
                <div class="relative w-full p-8 overflow-hidden bg-gray-900 aspect-video rounded-xl ring-1 ring-gray-700">
                    <img :src="projects[currentIndex].image" :alt="projects[currentIndex].title"
                        class="object-cover w-full h-full bg-gray-800" loading="eager" @error="handleImageError">
                </div>

                <!-- Project Thumbnails Carousel -->
                <div class="relative px-4 py-2 bg-gray-900 rounded-xl">
                    <!-- Navigation Arrows -->
                    <button @click="previousProject"
                        class="absolute z-10 p-2 -translate-y-1/2 rounded-full left-2 top-1/2 bg-black/50">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button @click="nextProject"
                        class="absolute z-10 p-2 -translate-y-1/2 rounded-full right-2 top-1/2 bg-black/50">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Thumbnails -->
                    <div class="flex justify-center gap-2 px-8 py-2">
                        <button v-for="(project, index) in projects" :key="project.id" @click="setProject(index)"
                            class="relative w-24 h-16 overflow-hidden transition-all duration-200 rounded-lg ring-1"
                            :class="[
                                currentIndex === index
                                    ? 'ring-blue-500 ring-2 scale-105'
                                    : 'ring-gray-700 hover:ring-gray-600'
                            ]">
                            <img :src="project.image" :alt="project.title" class="object-cover w-full h-full"
                                loading="eager" @error="handleImageError">
                            <div class="absolute inset-0" :class="[
                                currentIndex === index
                                    ? 'bg-black/30'
                                    : 'bg-black/50'
                            ]">
                                <div
                                    class="absolute bottom-0 w-full p-1 text-[10px] text-center text-white bg-black/70">
                                    {{ project.title }}
                                </div>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Project Details -->
                <div class="p-6 bg-gray-900 rounded-xl">
                    <ProjectCard :project="projects[currentIndex]" />
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped></style>
