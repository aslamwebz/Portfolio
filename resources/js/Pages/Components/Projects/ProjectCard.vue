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
    <div class="relative bg-gray-800 rounded-xl shadow-lg transition-transform duration-300 hover:scale-[1.02]">
        <!-- Card Content -->

        <div class="flex flex-col h-full">
            <div class="relative h-[300px]">
                <img :src="project.image" :alt="project.title"
                    class="absolute inset-0 h-[95%] object-fit rounded-t-xl" />
            </div>

            <div class="flex flex-col flex-1 p-6">
                <h3 class="mb-2 text-lg font-bold text-white">{{ project.title }}</h3>
                <p class="mb-4 text-sm text-gray-300">{{ truncatedDescription }}</p>

                <!-- Technologies -->
                <div class="flex flex-wrap gap-2 mb-4">
                    <span v-for="tech in project.technologies" :key="tech"
                        class="px-2 py-1 text-xs font-medium text-blue-300 rounded-full bg-blue-900/30">
                        {{ tech }}
                    </span>
                </div>

                <!-- Actions -->
                <div class="flex gap-3 mt-auto">
                    <a :href="project.link ? project.link : '#'" v-if="project.link !== '' "
                        class="inline-flex items-center px-4 py-2 text-xs font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                        Learn More →
                    </a>
                    <a v-if="project.github" :href="project.github" target="_blank"
                        class="inline-flex items-center px-4 py-2 text-xs font-medium text-white transition-colors bg-gray-700 rounded-lg hover:bg-gray-600">
                        <i class="mr-2 fab fa-github"></i> GitHub
                    </a>
                </div>
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
