<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Main Layout -->
        <div class="flex">
            <!-- Sidebar -->
            <div class="relative z-30 w-64 min-h-screen transition-all duration-300 bg-gray-900 border-r"
                :class="{ 'w-20': !isSidebarOpen }">
                <div class="flex items-center justify-between h-16 px-4 bg-gray-800">
                    <h1 class="text-xl font-bold text-white" :class="{ 'hidden': !isSidebarOpen }">AI Hub</h1>
                    <button @click="toggleSidebar"
                        class="p-2 text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                :d="isSidebarOpen ? 'M11 19l-7-7 7-7M4 12h14' : 'M13 5l7 7-7 7M4 12h14'" />
                        </svg>
                    </button>
                </div>
                <nav class="p-4 space-y-2">
                    <button v-for="app in aiApps" :key="app.id" @click="selectApp(app)" :class="[
                        'w-full px-4 py-3 text-left rounded-lg transition-colors flex items-center gap-3',
                        selectedApp?.id === app.id
                            ? 'bg-indigo-600 text-white'
                            : 'text-gray-300 hover:bg-gray-800'
                    ]">
                        <component :is="app.icon" class="w-5 h-5" />
                        <span :class="{ 'hidden': !isSidebarOpen }">{{ app.name }}</span>
                    </button>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="flex-1 transition-all duration-300">
                <div class="p-8 mx-auto max-w-7xl">
                    <div v-if="selectedApp" class="max-w-4xl mx-auto">
                        <h2 class="mb-6 text-2xl font-bold text-gray-800">{{ selectedApp.name }}</h2>
                        <component :is="selectedApp.component" />
                    </div>
                    <div v-else class="text-center">
                        <div class="p-8 bg-white rounded-lg shadow-lg">
                            <h3 class="mb-4 text-xl font-semibold text-gray-700">Welcome to AI Hub</h3>
                            <p class="text-gray-600">Select an AI application from the sidebar to get started.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overlay -->
        <div v-if="isSidebarOpen" @click="toggleSidebar" class="fixed inset-0 z-20 bg-black/20 lg:hidden"></div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import ChatBot from './Components/ChatBot.vue';
import ImageGenerator from './Components/ImageGenerator.vue';
import TextToSpeech from './Components/TextToSpeech.vue';
import CodeAssistant from './Components/CodeAssistant.vue';
import EmojiGenerator from './Components/EmojiGenerator.vue';
import ColorPaletteGenerator from './Components/ColorPaletteGenerator.vue';
import NameGenerator from './Components/NameGenerator.vue';

const isSidebarOpen = ref(true);
const selectedApp = ref(null);

const aiApps = [
    {
        id: 1,
        name: 'AI Chat Bot',
        component: ChatBot,
        icon: {
            template: `
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
            `
        }
    },
    {
        id: 2,
        name: 'Image Generator',
        component: ImageGenerator,
        icon: {
            template: `
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            `
        }
    },
    {
        id: 3,
        name: 'Text to Speech',
        component: TextToSpeech,
        icon: {
            template: `
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                </svg>
            `
        }
    },
    {
        id: 4,
        name: 'Code Assistant',
        component: CodeAssistant,
        icon: {
            template: `
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                </svg>
            `
        }
    },
    {
        id: 5,
        name: 'Emoji Generator',
        component: EmojiGenerator,
        icon: {
            template: `
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            `
        }
    },
    {
        id: 6,
        name: 'Color Palette Generator',
        component: ColorPaletteGenerator,
        icon: {
            template: `
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                </svg>
            `
        }
    },
    {
        id: 7,
        name: 'Name Generator',
        component: NameGenerator,
        icon: {
            template: `
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                </svg>
            `
        }
    }
];

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};

const selectApp = (app) => {
    selectedApp.value = app;
    if (window.innerWidth < 1024) {
        isSidebarOpen.value = false;
    }
};
</script>
