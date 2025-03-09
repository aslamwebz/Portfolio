<script setup>
import { ref, computed } from 'vue';
import ProjectCard from '@/Pages/Components/Projects/ProjectCard.vue';

const activeFilter = ref('All');

const filters = ['All', 'Vue', 'Laravel', 'Node', 'AI'];

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

const filteredProjects = computed(() => {
    if (activeFilter.value === 'All') {
        return projects.value;
    }
    return projects.value.filter(project => project.category === activeFilter.value);
});
</script>

<template>
    <section id="projects" class="container mx-auto pt-[5rem] max-w-screen-2xl">
        <div class="py-6 bg-gray-800 rounded-md shadow-2xl shadow-black">
            <div class="px-4 py-8 mx-auto text-center">
                <h2 class="mb-4 text-4xl font-bold text-white">My Projects</h2>
                <p class="text-base text-gray-400">
                    Take a look at some highlighted personal projects, showcasing my skills and passion for development.
                </p>
            </div>

            <!-- Filter buttons -->
            <div class="flex flex-wrap justify-center gap-3 mb-8">
                <button v-for="filter in filters" :key="filter" @click="activeFilter = filter"
                    class="px-4 py-2 text-sm transition-colors rounded-full"
                    :class="activeFilter === filter ? 'bg-blue-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600'">
                    {{ filter }}
                </button>
            </div>

            <!-- Adjusted grid for narrower cards with more height -->
            <div class="grid max-w-6xl grid-cols-1 gap-8 p-8 mx-auto md:grid-cols-2">
                <ProjectCard v-for="project in filteredProjects" :key="project.id" :project="project" />
            </div>

            <div class="p-4 mt-8 text-center">
                <a href="#"
                    class="inline-flex items-center px-8 py-4 text-base font-semibold text-white transition-all duration-300 rounded-lg bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800">
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
