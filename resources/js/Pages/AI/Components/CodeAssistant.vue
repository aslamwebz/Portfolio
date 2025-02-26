<template>
    <div class="p-6 bg-white rounded-lg shadow">
        <div class="mb-6">
            <textarea v-model="codeInput" rows="8"
                class="w-full p-4 font-mono border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Enter your code or describe what you want to achieve..."
                :disabled="isProcessing"></textarea>
        </div>

        <div class="flex gap-4 mb-4">
            <select v-model="selectedLanguage" class="px-4 py-2 border rounded-lg" :disabled="isProcessing">
                <option value="javascript">JavaScript</option>
                <option value="python">Python</option>
                <option value="php">PHP</option>
                <option value="java">Java</option>
                <option value="html">HTML</option>
                <option value="css">CSS</option>
            </select>
            <button @click="processCode"
                class="px-6 py-2 text-white transition-colors bg-indigo-500 rounded-lg hover:bg-indigo-600 disabled:bg-indigo-300"
                :disabled="isProcessing || !codeInput.trim()">
                <span v-if="!isProcessing">Get Help</span>
                <span v-else>Processing...</span>
            </button>
        </div>

        <!-- Results Section -->
        <div v-if="result" class="mt-6 overflow-hidden border rounded-lg">
            <div class="px-4 py-2 bg-gray-100 border-b">
                <h3 class="font-medium">AI Suggestion</h3>
            </div>
            <div class="p-4">
                <div class="prose-sm prose max-w-none" v-html="formatResult(result)"></div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { marked } from 'marked';

const codeInput = ref('');
const selectedLanguage = ref('javascript');
const isProcessing = ref(false);
const result = ref('');

const processCode = async () => {
    if (!codeInput.value.trim() || isProcessing.value) return;

    isProcessing.value = true;

    try {
        const response = await axios.post('/ai/code-assist', {
            code: codeInput.value,
            language: selectedLanguage.value
        });

        if (response.data.success) {
            result.value = response.data.result;
        } else {
            result.value = 'Sorry, there was an error processing your code.';
        }
    } catch (error) {
        console.error('Failed to process code:', error);
        result.value = 'Sorry, I encountered an error. Please try again.';
    } finally {
        isProcessing.value = false;
    }
};

const formatResult = (content) => {
    if (!content) return '';
    try {
        return marked(content);
    } catch (error) {
        console.error('Markdown parsing error:', error);
        return content;
    }
};
</script>

<style>
.prose pre {
    background-color: #f3f4f6;
    padding: 1rem;
    border-radius: 0.5rem;
    overflow-x: auto;
}

.prose code {
    background-color: #f3f4f6;
    padding: 0.2rem 0.4rem;
    border-radius: 0.25rem;
}
</style>
