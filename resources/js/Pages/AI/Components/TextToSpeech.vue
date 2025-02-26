<template>
    <div class="p-6 bg-white rounded-lg shadow">
        <div class="mb-6">
            <textarea
                v-model="textInput"
                rows="6"
                class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Enter the text you want to convert to speech..."
                :disabled="isGenerating"
            ></textarea>
        </div>
        <div class="flex gap-4">
            <select
                v-model="selectedVoice"
                class="px-4 py-2 border rounded-lg"
                :disabled="isGenerating"
            >
                <option value="en-US">English (US)</option>
                <option value="en-GB">English (UK)</option>
                <option value="es-ES">Spanish</option>
                <option value="fr-FR">French</option>
            </select>
            <button
                @click="generateSpeech"
                class="px-6 py-2 text-white bg-indigo-500 rounded-lg hover:bg-indigo-600 disabled:bg-indigo-300"
                :disabled="isGenerating || !textInput.trim()"
            >
                <span v-if="!isGenerating">Convert to Speech</span>
                <span v-else>Generating...</span>
            </button>
        </div>

        <!-- Audio Player -->
        <div v-if="audioUrl" class="mt-6 p-4 bg-gray-50 rounded-lg">
            <audio controls class="w-full" :src="audioUrl"></audio>
            <button
                @click="downloadAudio"
                class="mt-4 px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600"
            >
                Download Audio
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const textInput = ref('');
const selectedVoice = ref('en-US');
const isGenerating = ref(false);
const audioUrl = ref('');

const generateSpeech = async () => {
    if (!textInput.value.trim() || isGenerating.value) return;

    isGenerating.value = true;
    audioUrl.value = '';

    try {
        const response = await axios.post('/ai/text-to-speech', {
            text: textInput.value,
            voice: selectedVoice.value
        }, {
            responseType: 'blob'
        });

        // Create a URL for the audio blob
        const blob = new Blob([response.data], { type: 'audio/mpeg' });
        audioUrl.value = URL.createObjectURL(blob);
    } catch (error) {
        console.error('Failed to generate speech:', error);
        alert('Sorry, there was an error generating the speech. Please try again.');
    } finally {
        isGenerating.value = false;
    }
};

const downloadAudio = () => {
    if (!audioUrl.value) return;

    const link = document.createElement('a');
    link.href = audioUrl.value;
    link.download = 'speech.mp3';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
};
</script>
