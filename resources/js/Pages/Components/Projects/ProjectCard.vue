<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    project: {
        type: Object,
        required: true,
        validator: (value) => {
            return ['id', 'title', 'description', 'image'].every(key => key in value);
        }
    }
});

const expanded = ref(false);
const showDetails = ref(false);

const truncatedDescription = computed(() => {
    return props.project.description.length > 100
        ? props.project.description.substring(0, 100) + '...'
        : props.project.description;
});

const isComingSoon = (project) => {
    return !project.title || !project.description;
};

// These would ideally come from the project object, but for demo purposes:
const projectFeatures = [
    'Responsive design for all device sizes',
    'User authentication and authorization',
    'Real-time data updates',
    'Optimized performance with lazy loading',
    'Comprehensive error handling'
];

const projectChallenges = 'One of the main challenges was implementing real-time updates while maintaining performance. This was solved by using a combination of WebSockets for critical updates and polling for less time-sensitive data.';
</script>

<template>
    <div
        class="relative group bg-gradient-to-br from-gray-900 to-gray-800 p-6 rounded-3xl shadow-2xl transition-all duration-300 hover:scale-[1.02] hover:shadow-blue-500/20 overflow-hidden h-[500px]">
        <!-- Card Content -->
        <div v-if="!isComingSoon(project)" class="flex flex-col h-full">
            <div class="relative h-[300px] mb-4">
                <img :src="project.image" :alt="project.title"
                    class="absolute inset-0 object-cover w-full h-full shadow-lg rounded-2xl" />
            </div>

            <!-- Project Info Overlay (shows on hover) -->
            <div
                class="absolute flex flex-col justify-center p-8 transition-all duration-300 opacity-0 inset-6 bg-gradient-to-b from-blue-600/90 to-black/90 group-hover:opacity-100 rounded-2xl">
                <h3 class="mb-4 text-2xl font-bold text-white">{{ project.title }}</h3>
                <p class="text-lg text-gray-200">{{ truncatedDescription }}</p>
                <div class="mt-6 flex space-x-4">
                    <a :href="project.id === 'hearty-meal' ? '/hearty-meal' : '#'"
                        class="px-4 py-2 text-sm text-white transition-colors border rounded-full border-white/30 hover:bg-white/10">
                        Learn More →
                    </a>
                    <a v-if="project.github" :href="project.github" target="_blank"
                        class="px-4 py-2 text-sm text-white transition-colors border rounded-full border-white/30 hover:bg-white/10 flex items-center">
                        <i class="fab fa-github mr-2"></i> GitHub
                    </a>
                </div>
            </div>

            <!-- Bottom Info Bar -->
            <div class="flex flex-col justify-end flex-1">
                <div class="flex items-center justify-between">
                    <div
                        class="inline-block px-4 py-2 text-sm text-blue-300 rounded-full bg-blue-900/30 backdrop-blur-sm">
                        {{ project.id }}
                    </div>
                    <div class="flex space-x-2">
                        <span v-for="(tech, index) in project.technologies || []" :key="index"
                            class="w-2 h-2 rounded-full animate-pulse" :class="getTechColor(tech)"></span>
                        <span v-if="!project.technologies || project.technologies.length === 0"
                            class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                        <span v-if="!project.technologies || project.technologies.length === 0"
                            class="w-2 h-2 delay-75 bg-green-500 rounded-full animate-pulse"></span>
                        <span v-if="!project.technologies || project.technologies.length === 0"
                            class="w-2 h-2 delay-150 bg-purple-500 rounded-full animate-pulse"></span>
                    </div>
                </div>
                <h3 class="mt-3 text-xl font-bold text-white">{{ project.title }}</h3>
            </div>
        </div>

        <!-- Coming Soon Display -->
        <div v-else class="flex flex-col items-center justify-center h-full px-4 space-y-6 text-center">
            <div class="relative w-24 h-24 mx-auto">
                <div class="absolute inset-0 rounded-full bg-blue-500/20 animate-ping"></div>
                <div class="relative flex items-center justify-center w-24 h-24 bg-blue-600 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
            </div>
            <div>
                <h3 class="mb-2 text-3xl font-bold tracking-wider text-white">Coming Soon</h3>
                <p class="text-blue-300">Exciting new project in development</p>
            </div>
            <div class="flex justify-center mt-4 space-x-2">
                <div class="w-2 h-2 bg-blue-400 rounded-full animate-bounce"></div>
                <div class="w-2 h-2 delay-100 bg-blue-400 rounded-full animate-bounce"></div>
                <div class="w-2 h-2 delay-200 bg-blue-400 rounded-full animate-bounce"></div>
            </div>
        </div>
    </div>

    <!-- Project Details Modal -->
    <div v-if="showDetails" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="absolute inset-0 bg-black/70" @click="showDetails = false"></div>
        <div class="bg-gray-800 rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto relative z-10 m-4">
            <button @click="showDetails = false" class="absolute top-4 right-4 text-gray-400 hover:text-white">
                <i class="fas fa-times text-xl"></i>
            </button>

            <div class="p-8">
                <div class="flex flex-col md:flex-row gap-8">
                    <div class="md:w-1/2">
                        <img :src="project.image" :alt="project.title" class="w-full h-auto rounded-lg">

                        <div class="mt-6">
                            <h4 class="text-lg font-bold text-white mb-2">Technologies Used</h4>
                            <div class="flex flex-wrap gap-2">
                                <span v-for="(tech, index) in project.technologies" :key="index"
                                    class="px-3 py-1 text-sm bg-blue-900/70 text-blue-300 rounded-full">
                                    {{ tech }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="md:w-1/2">
                        <h2 class="text-3xl font-bold text-white mb-4">{{ project.title }}</h2>
                        <p class="text-gray-300 mb-6">{{ project.description }}</p>

                        <div class="mb-6">
                            <h4 class="text-lg font-bold text-white mb-2">Key Features</h4>
                            <ul class="list-disc pl-5 text-gray-300 space-y-2">
                                <li v-for="(feature, index) in projectFeatures" :key="index">
                                    {{ feature }}
                                </li>
                            </ul>
                        </div>

                        <div class="mb-6">
                            <h4 class="text-lg font-bold text-white mb-2">Challenges & Solutions</h4>
                            <p class="text-gray-300">
                                {{ projectChallenges }}
                            </p>
                        </div>

                        <div class="flex gap-4">
                            <a :href="project.github" target="_blank"
                                class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600 transition-colors flex items-center">
                                <i class="fab fa-github mr-2"></i> View Code
                            </a>
                            <a href="#" target="_blank"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors flex items-center">
                                <i class="fas fa-external-link-alt mr-2"></i> Live Demo
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        getTechColor(tech) {
            const techColors = {
                'vue': 'bg-green-500',
                'react': 'bg-blue-400',
                'laravel': 'bg-red-500',
                'php': 'bg-purple-500',
                'javascript': 'bg-yellow-400',
                'tailwind': 'bg-cyan-400',
                'node': 'bg-green-600',
                'mysql': 'bg-blue-600',
                'default': 'bg-gray-400'
            };

            return techColors[tech.toLowerCase()] || techColors.default;
        }
    }
}
</script>

<style scoped>
.delay-75 {
    animation-delay: 75ms;
}

.delay-150 {
    animation-delay: 150ms;
}
</style>
