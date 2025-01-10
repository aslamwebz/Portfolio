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
</script>

<template>
    <div
        class="bg-white p-4 rounded-3xl shadow-2xl transition-all duration-300 hover:scale-[1.02] hover:shadow-blue-500/20 overflow-hidden min-h-[400px]">
        <img :src="project.image" v-if="project.image" :alt="project.title" class="object-cover" />
        <!-- <img src="img/ComingSoon.jpg" v-else :alt="project.title" class="object-cover" /> -->
        <div class="coming-soon h-[400px]">
            <h1>Coming Soon</h1>
        </div>
        <div class="p-8 min-h-[100px]">
            <div class="inline-block px-4 py-2 bg-gray-900/50 rounded-full text-sm text-gray-300 mb-4">
                {{ project.id }}
            </div>
            <h3 class="text-2xl font-bold text-white mb-3">{{ project.title }}</h3>
        </div>
    </div>
</template>

<style scoped>
.coming-soon {
    margin: 0;
    font-family: 'Montserrat', sans-serif;
    font-size: 4em;
    color: #333;
    word-spacing: 16px;
    text-align: center;
    /* Center the text */
    display: flex;
    justify-content: center;
    align-items: center;
    /* Adjust as needed */
}
</style>
