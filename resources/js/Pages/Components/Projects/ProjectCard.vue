<script setup>
import { ref } from 'vue';

const props = defineProps({
    project: {
        type: Object,
        required: true,
        validator: (value) => {
            return ['id', 'title', 'description', 'image'].every(key => key in value);
        }
    }
});

const truncatedDescription = props.project.description.length > 100
    ? props.project.description.substring(0, 100) + '...'
    : props.project.description;
</script>

<template>
    <div class="space-y-4">
        <div class="flex items-center gap-2">
            <div class="p-2 rounded-lg bg-blue-500/10">
                <svg class="w-5 h-5 text-blue-500" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-white">{{ project.title }}</h2>
        </div>

        <p class="text-sm text-gray-400">{{ project.description }}</p>

        <!-- Technologies -->
        <div class="flex flex-wrap gap-2">
            <span v-for="tech in project.technologies" :key="tech"
                class="px-2 py-1 text-xs font-medium text-blue-300 rounded-full bg-blue-900/30">
                {{ tech }}
            </span>
        </div>

        <div class="flex gap-3">
            <a v-if="project.link" :href="project.link" class="px-4 py-1.5 text-sm text-white bg-blue-600 rounded-lg">
                Live Demo
            </a>
            <a :href="project.github" class="px-4 py-1.5 text-sm text-white bg-gray-700 rounded-lg">
                <i class="mr-1 fab fa-github"></i> GitHub
            </a>
        </div>

        <div class="flex gap-6">
            <div>
                <span class="text-lg font-bold text-white">{{ project.technologies.length }}</span>
                <span class="ml-2 text-sm text-gray-400">Technologies</span>
            </div>
            <div>
                <span class="text-lg font-bold text-white">{{ project.category }}</span>
                <span class="ml-2 text-sm text-gray-400">Category</span>
            </div>
        </div>
    </div>
</template>

<style scoped>
.project-card {
    display: flex;
    flex-direction: column;
    height: 480px;
    /* Increased height */
    max-width: 400px;
    /* Decreased width */
    margin: 0 auto;
}

.project-image {
    height: 240px;
    /* Adjust image height */
    object-fit: cover;
}

/* ... other styles ... */
</style>
