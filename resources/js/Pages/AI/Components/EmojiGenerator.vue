<template>
    <div class="p-6 bg-white rounded-lg shadow">
        <div class="mb-6">
            <textarea v-model="prompt" rows="4"
                class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Describe the emoji you want to generate (e.g., 'happy cat with sunglasses')..."
                :disabled="isGenerating"></textarea>
        </div>

        <div class="flex gap-4 mb-6">
            <select v-model="style" class="px-4 py-2 border rounded-lg" :disabled="isGenerating">
                <option value="flat">Flat</option>
                <option value="3d">3D</option>
                <option value="cartoon">Cartoon</option>
                <option value="pixel">Pixel Art</option>
                <option value="hand-drawn">Hand Drawn</option>
            </select>
            <button @click="generateEmoji"
                class="px-6 py-2 text-white bg-indigo-500 rounded-lg hover:bg-indigo-600 disabled:bg-indigo-300"
                :disabled="isGenerating || !prompt.trim()">
                <span v-if="!isGenerating">Generate Emoji</span>
                <span v-else>Generating...</span>
            </button>
        </div>

        <!-- Results Section -->
        <div v-if="isGenerating" class="flex justify-center py-8">
            <div class="w-12 h-12 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
        </div>

        <div v-else-if="emojis.length > 0" class="mt-6">
            <h3 class="mb-4 text-lg font-medium">Generated Emojis</h3>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4">
                <div v-for="(emoji, index) in emojis" :key="index"
                    class="relative p-4 border rounded-lg group hover:shadow-md">
                    <img :src="emoji.url" alt="Generated emoji" class="w-full h-auto rounded" />
                    <div
                        class="absolute inset-0 flex-col items-center justify-center hidden transition-opacity bg-black bg-opacity-50 rounded-lg group-hover:flex">
                        <button @click="downloadEmoji(emoji.url, index)"
                            class="px-3 py-1 mb-2 text-sm text-white bg-indigo-500 rounded hover:bg-indigo-600">
                            Download
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const prompt = ref('');
const style = ref('flat');
const isGenerating = ref(false);
const emojis = ref([]);

const generateEmoji = async () => {
    if (!prompt.value.trim() || isGenerating.value) return;

    isGenerating.value = true;

    try {
        const response = await axios.post('/ai/emoji-generator', {
            prompt: prompt.value,
            style: style.value
        });

        if (response.data.success) {
            // For demonstration, we'll simulate multiple emojis
            // In a real implementation, this would come from the API
            emojis.value = response.data.emojis || [];
        } else {
            alert('Sorry, there was an error generating the emoji.');
        }
    } catch (error) {
        console.error('Failed to generate emoji:', error);
        alert('Sorry, I encountered an error. Please try again.');
    } finally {
        isGenerating.value = false;
    }
};

const downloadEmoji = (url, index) => {
    const link = document.createElement('a');
    link.href = url;
    link.download = `emoji-${index + 1}.png`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
};
</script>
