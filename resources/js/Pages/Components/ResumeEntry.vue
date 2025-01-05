<template>
    <div class="flex justify-center">
        <div class="px-2 py-4" :class="[isLeftAligned ? 'text-white' : 'text-right']">
            <h3 class="text-xl font-bold">{{ title }}</h3>
            <p class="">{{ company }} | {{ location }}</p>
            <span class="inline-block  text-white text-sm px-2 py-1 rounded mt-2"
                :class="[isLeftAligned ? '' : 'bg-blue-500']">{{ period }}</span>
            <p class=" mt-4">{{ description }}</p>
        </div>
        <div class="relative w-8 flex justify-center items-center">
            <div class="w-1 bg-sky-300 absolute inset-y-0 left-1/2 transform -translate-x-1/2"></div>
            <div class="border-4 bg-white border-blue-500 w-4 h-4 rounded-full z-10"></div>
        </div>
        <div class="px-2 py-4" :class="[isLeftAligned ? 'text-left' : 'text-white']">
            <h3 class="text-xl font-bold">{{ title }}</h3>
            <p class="">{{ company }} | {{ location }}</p>
            <span class="inline-block text-white text-sm px-2 py-1 rounded mt-2"
                :class="[isLeftAligned ? 'bg-blue-500' : '']">{{ period }}</span>
            <p class=" mt-4">{{ description }}</p>
        </div>
    </div>
</template>

<script setup>
const props = defineProps(['title', 'company', 'location', 'period', 'description', 'isLeftAligned'])
</script>

<style scoped></style>
