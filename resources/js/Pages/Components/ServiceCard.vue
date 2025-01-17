<template>
    <div class="p-8 text-center transition-all duration-300 bg-gray-800 rounded-xl hover:shadow-2xl service-card group shadow-black">
        <div class="relative px-4 py-2 mb-6 bg-gray-700 rounded-lg">
            <div class="absolute flex space-x-2 left-4">
                <div class="w-2 h-2 mt-2 bg-red-500 rounded-full"></div>
                <div class="w-2 h-2 mt-2 bg-yellow-500 rounded-full"></div>
                <div class="w-2 h-2 mt-2 bg-green-500 rounded-full"></div>
            </div>
            <div class="flex items-center justify-center w-12 h-12 mx-auto text-2xl text-white transition-all duration-300 rounded-lg icon-wrapper group-hover:-translate-y-1"
                :style="{ backgroundColor: iconBgColor }">
                <i :class="icon"></i>
            </div>
        </div>
        <h3 class="mb-4 text-xl font-bold text-white">{{ title }}</h3>
        <p class="text-gray-400 leading-relaxed">{{ description }}</p>
    </div>
</template>

<script setup>
defineProps({
    icon: {
        type: String,
        required: true
    },
    title: {
        type: String,
        required: true
    },
    description: {
        type: String,
        required: true
    },
    iconBgColor: {
        type: String,
        default: '#3B82F6'
    }
});
</script>

<style scoped>
.service-card {
    border: 1px solid rgb(55, 65, 81);
}

.icon-wrapper {
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
}
</style>
