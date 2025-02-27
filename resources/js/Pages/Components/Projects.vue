<script setup>
import { ref, computed } from 'vue';
import ProjectCard from '@/Pages/Components/Projects/ProjectCard.vue';

const activeFilter = ref('All');

const filters = ['All', 'Vue', 'Laravel', 'Node', 'AI'];

const projects = ref([
    {
        id: 'hearty-meal',
        title: 'Hearty Meal',
        description: 'An innovative food ordering platform that connects local restaurants with hungry customers. Features include real-time order tracking, customizable menus, and a seamless checkout process.',
        image: '/img/hearty-meal.jpg',
        github: 'https://github.com/yourusername/hearty-meal',
        technologies: ['vue', 'laravel', 'tailwind', 'mysql'],
        category: 'Vue'
    },
    {
        id: 'portfolio-site',
        title: 'Developer Portfolio',
        description: 'My personal portfolio website built with modern technologies to showcase my projects and skills in an interactive way.',
        image: '/img/portfolio.jpg',
        github: 'https://github.com/yourusername/portfolio',
        technologies: ['vue', 'laravel', 'tailwind'],
        category: 'Vue'
    },
    {
        id: 'chat-app',
        title: 'Real-time Chat Application',
        description: 'A real-time messaging platform with features like user authentication, message encryption, and file sharing capabilities.',
        image: '/img/chat-app.jpg',
        github: 'https://github.com/yourusername/chat-app',
        technologies: ['vue', 'node', 'socket.io'],
        category: 'Node'
    },
    {
        id: 'ai-assistant',
        title: 'AI Coding Assistant',
        description: 'An intelligent coding assistant that helps developers write better code faster. Leverages machine learning to provide context-aware suggestions and automate repetitive tasks.',
        image: '/img/ai-assistant.jpg',
        github: 'https://github.com/yourusername/ai-assistant',
        technologies: ['python', 'tensorflow', 'flask', 'vue'],
        category: 'AI'
    }
]);

const filteredProjects = computed(() => {
    if (activeFilter.value === 'All') {
        return projects.value;
    }
    return projects.value.filter(project => project.category === activeFilter.value);
});
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

            <!-- Filter buttons -->
            <div class="flex flex-wrap justify-center gap-3 mb-8">
                <button v-for="filter in filters" :key="filter" @click="activeFilter = filter"
                    class="px-4 py-2 transition-colors rounded-full"
                    :class="activeFilter === filter ? 'bg-blue-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600'">
                    {{ filter }}
                </button>
            </div>

            <div class="grid grid-cols-1 gap-8 p-8 mx-auto md:grid-cols-2 max-w-7xl">
                <ProjectCard v-for="project in filteredProjects" :key="project.id" :project="project" />
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
