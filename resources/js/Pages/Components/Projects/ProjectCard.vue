<script setup>
defineProps({
    project: {
        type: Object,
        required: true,
        validator: (value) => {
            return ['id', 'title', 'description', 'image'].every(key => key in value);
        }
    }
});

const isComingSoon = (project) => {
    return !project.title || !project.description;
};
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
            <a :href="project.id === 'hearty-meal' ? '/hearty-meal' : '#'"
                class="absolute flex flex-col justify-center p-8 transition-all duration-300 opacity-0 inset-6 bg-gradient-to-b from-blue-600/90 to-black/90 group-hover:opacity-100 rounded-2xl">
                <h3 class="mb-4 text-2xl font-bold text-white">{{ project.title }}</h3>
                <p class="text-lg text-gray-200">{{ project.description }}</p>
                <div class="mt-6">
                    <span class="px-4 py-2 text-sm text-white transition-colors border rounded-full border-white/30 hover:bg-white/10">
                        Learn More →
                    </span>
                </div>
            </a>

            <!-- Bottom Info Bar -->
            <div class="flex flex-col justify-end flex-1">
                <div class="flex items-center justify-between">
                    <div class="inline-block px-4 py-2 text-sm text-blue-300 rounded-full bg-blue-900/30 backdrop-blur-sm">
                        {{ project.id }}
                    </div>
                    <div class="flex space-x-2">
                        <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                        <span class="w-2 h-2 delay-75 bg-green-500 rounded-full animate-pulse"></span>
                        <span class="w-2 h-2 delay-150 bg-purple-500 rounded-full animate-pulse"></span>
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
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
</template>

<style scoped>
.delay-75 {
    animation-delay: 75ms;
}
.delay-150 {
    animation-delay: 150ms;
}
</style>
