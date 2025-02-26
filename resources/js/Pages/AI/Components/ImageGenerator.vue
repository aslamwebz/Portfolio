<template>
    <div class="p-6 bg-white rounded-lg shadow-lg">
        <div class="mb-6">
            <textarea v-model="prompt" rows="4"
                class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Describe the image you want to generate..." :disabled="isGenerating"></textarea>
            <button
                class="px-6 py-2 mt-4 text-white bg-indigo-500 rounded-lg hover:bg-indigo-600 disabled:bg-indigo-300"
                @click="generateImage" :disabled="isGenerating || !prompt.trim()">
                <span v-if="isGenerating">Generating...</span>
                <span v-else>Generate Image</span>
            </button>
        </div>
        <div v-if="isGenerating" class="grid place-items-center h-64">
            <div class="text-center">
                <div class="w-16 h-16 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
                <p class="mt-4 text-gray-600">Generating your image...</p>
            </div>
        </div>
        <div v-else-if="generatedImage" class="overflow-hidden rounded-lg">
            <img :src="generatedImage" alt="Generated image" class="w-full h-auto">
            <button @click="downloadImage" class="px-4 py-2 mt-4 text-white bg-green-500 rounded-lg hover:bg-green-600">
                Download Image
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const prompt = ref('');
const isGenerating = ref(false);
const generatedImage = ref(null);

const generateImage = async () => {
    if (!prompt.value.trim() || isGenerating.value) return;

    isGenerating.value = true;
    generatedImage.value = null;

    try {
        const response = await axios.post('/ai/generate-image', {
            prompt: prompt.value
        });

        if (response.data.success) {
            generatedImage.value = response.data.image;
        }
    } catch (error) {
        console.error('Failed to generate image:', error);
    } finally {
        isGenerating.value = false;
    }
};

const downloadImage = () => {
    if (!generatedImage.value) return;

    const link = document.createElement('a');
    link.href = generatedImage.value;
    link.download = 'generated-image.jpg';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
};
</script>
