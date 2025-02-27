<template>
    <div class="p-6 bg-white rounded-lg shadow">
        <div class="mb-6">
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Upload an image to convert to code
                </label>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <div
                            class="relative flex flex-col items-center justify-center h-48 p-2 border-2 border-dashed rounded-lg border-gray-300 hover:border-indigo-500"
                            :class="{ 'border-indigo-500': isDragging }"
                            @dragover.prevent="isDragging = true"
                            @dragleave.prevent="isDragging = false"
                            @drop.prevent="handleDrop"
                        >
                            <input
                                type="file"
                                ref="fileInput"
                                class="absolute inset-0 z-50 w-full h-full opacity-0 cursor-pointer"
                                accept="image/*"
                                @change="handleFileChange"
                                :disabled="isGenerating"
                            />
                            <div v-if="imagePreview" class="w-full h-full">
                                <img :src="imagePreview" alt="Preview" class="object-contain w-full h-full rounded" />
                            </div>
                            <div v-else class="flex flex-col items-center justify-center text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-600">Drag and drop an image here or click to upload</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-4">
                <select
                    v-model="framework"
                    class="px-4 py-2 border rounded-lg"
                    :disabled="isGenerating"
                >
                    <option value="tailwind">Tailwind CSS</option>
                    <option value="css">Plain CSS</option>
                </select>
                <button
                    @click="generateCode"
                    class="px-6 py-2 text-white bg-indigo-500 rounded-lg hover:bg-indigo-600 disabled:bg-indigo-300"
                    :disabled="isGenerating || !imageFile"
                >
                    <span v-if="!isGenerating">Generate Code</span>
                    <span v-else>Generating...</span>
                </button>
            </div>
        </div>

        <!-- Results Section -->
        <div v-if="isGenerating" class="flex justify-center py-8">
            <div class="w-12 h-12 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
        </div>

        <div v-else-if="generatedCode" class="mt-6">
            <div class="flex justify-between mb-4">
                <h3 class="text-lg font-medium">Generated Code</h3>
                <button
                    @click="copyToClipboard(generatedCode)"
                    class="px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600"
                >
                    Copy Code
                </button>
            </div>
            <div class="p-4 overflow-auto bg-gray-900 rounded-lg">
                <pre class="text-sm text-white whitespace-pre-wrap">{{ generatedCode }}</pre>
            </div>

            <!-- Preview Section -->
            <div v-if="generatedCode" class="mt-6">
                <h3 class="mb-4 text-lg font-medium">Live Preview</h3>
                <div class="p-4 border rounded-lg">
                    <div v-html="generatedCode"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const fileInput = ref(null);
const imageFile = ref(null);
const imagePreview = ref('');
const isDragging = ref(false);
const isGenerating = ref(false);
const framework = ref('tailwind');
const generatedCode = ref('');

const handleDrop = (e) => {
    isDragging.value = false;
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        handleFile(file);
    }
};

const handleFileChange = (e) => {
    const file = e.target.files[0];
    if (file) {
        handleFile(file);
    }
};

const handleFile = (file) => {
    imageFile.value = file;
    createImagePreview(file);
};

const createImagePreview = (file) => {
    const reader = new FileReader();
    reader.onload = (e) => {
        imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
};

const generateCode = async () => {
    if (!imageFile.value || isGenerating.value) return;

    isGenerating.value = true;
    generatedCode.value = '';

    try {
        const formData = new FormData();
        formData.append('image', imageFile.value);
        formData.append('framework', framework.value);

        const response = await axios.post('/ai/image-to-code', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });

        if (response.data.success) {
            generatedCode.value = response.data.code;
        } else {
            alert('Sorry, there was an error generating the code.');
        }
    } catch (error) {
        console.error('Failed to generate code:', error);
        alert('Sorry, I encountered an error. Please try again.');
    } finally {
        isGenerating.value = false;
    }
};

const copyToClipboard = (text) => {
    navigator.clipboard.writeText(text)
        .then(() => {
            console.log('Copied to clipboard');
        })
        .catch(err => {
            console.error('Failed to copy:', err);
        });
};
</script>
