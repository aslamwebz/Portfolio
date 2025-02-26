<template>
    <div class="p-6 bg-white rounded-lg shadow">
        <div class="mb-6">
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Upload an image or describe a theme
                </label>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <textarea
                            v-model="prompt"
                            rows="3"
                            class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            placeholder="Describe a theme (e.g., 'sunset at the beach', 'modern minimalist office')"
                            :disabled="isGenerating || imageFile"
                        ></textarea>
                    </div>
                    <div class="w-32">
                        <div
                            class="relative flex flex-col items-center justify-center h-full p-2 border-2 border-dashed rounded-lg border-gray-300 hover:border-indigo-500"
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
                                <img :src="imagePreview" alt="Preview" class="object-cover w-full h-full rounded" />
                            </div>
                            <div v-else class="flex flex-col items-center justify-center text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="mt-1 text-xs text-gray-500">Upload</span>
                            </div>
                        </div>
                        <button
                            v-if="imageFile"
                            @click="clearImage"
                            class="w-full px-2 py-1 mt-2 text-xs text-white bg-red-500 rounded hover:bg-red-600"
                            :disabled="isGenerating"
                        >
                            Clear
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex gap-4">
                <select
                    v-model="paletteSize"
                    class="px-4 py-2 border rounded-lg"
                    :disabled="isGenerating"
                >
                    <option value="3">3 Colors</option>
                    <option value="5">5 Colors</option>
                    <option value="7">7 Colors</option>
                </select>
                <button
                    @click="generatePalette"
                    class="px-6 py-2 text-white bg-indigo-500 rounded-lg hover:bg-indigo-600 disabled:bg-indigo-300"
                    :disabled="isGenerating || (!prompt.trim() && !imageFile)"
                >
                    <span v-if="!isGenerating">Generate Palette</span>
                    <span v-else>Generating...</span>
                </button>
            </div>
        </div>

        <!-- Results Section -->
        <div v-if="isGenerating" class="flex justify-center py-8">
            <div class="w-12 h-12 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
        </div>

        <div v-else-if="palette.length > 0" class="mt-6">
            <h3 class="mb-4 text-lg font-medium">Generated Color Palette</h3>
            <div class="mb-6">
                <div class="flex overflow-hidden rounded-lg shadow-md h-28">
                    <div
                        v-for="(color, index) in palette"
                        :key="index"
                        :style="{ backgroundColor: color.hex, flex: 1 }"
                        class="relative group"
                    >
                        <div class="absolute inset-x-0 bottom-0 p-2 text-xs font-mono text-center transition-opacity bg-black bg-opacity-50 text-white opacity-0 group-hover:opacity-100">
                            {{ color.hex }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4">
                <div
                    v-for="(color, index) in palette"
                    :key="index"
                    class="p-4 border rounded-lg"
                >
                    <div
                        :style="{ backgroundColor: color.hex }"
                        class="w-full h-24 mb-2 rounded"
                    ></div>
                    <div class="flex flex-col">
                        <span class="font-medium">{{ color.name }}</span>
                        <span class="font-mono text-sm text-gray-600">{{ color.hex }}</span>
                        <span class="font-mono text-sm text-gray-600">RGB: {{ color.rgb }}</span>
                        <button
                            @click="copyToClipboard(color.hex)"
                            class="px-2 py-1 mt-2 text-xs text-white bg-indigo-500 rounded hover:bg-indigo-600"
                        >
                            Copy HEX
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <button
                    @click="downloadPalette"
                    class="px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600"
                >
                    Download Palette
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const prompt = ref('');
const paletteSize = ref('5');
const isGenerating = ref(false);
const palette = ref([]);
const imageFile = ref(null);
const imagePreview = ref('');
const isDragging = ref(false);
const fileInput = ref(null);

const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
        imageFile.value = file;
        prompt.value = '';
        createImagePreview(file);
    }
};

const handleDrop = (event) => {
    isDragging.value = false;
    const file = event.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        imageFile.value = file;
        prompt.value = '';
        createImagePreview(file);
    }
};

const createImagePreview = (file) => {
    const reader = new FileReader();
    reader.onload = (e) => {
        imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
};

const clearImage = () => {
    imageFile.value = null;
    imagePreview.value = '';
    if (fileInput.value) {
        fileInput.value.value = '';
    }
};

const generatePalette = async () => {
    if ((!prompt.value.trim() && !imageFile.value) || isGenerating.value) return;

    isGenerating.value = true;
    palette.value = [];

    try {
        const formData = new FormData();
        formData.append('paletteSize', paletteSize.value);

        if (imageFile.value) {
            formData.append('image', imageFile.value);
        } else {
            formData.append('prompt', prompt.value);
        }

        const response = await axios.post('/ai/color-palette', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });

        if (response.data.success) {
            palette.value = response.data.palette;
        } else {
            alert('Sorry, there was an error generating the color palette.');
        }
    } catch (error) {
        console.error('Failed to generate color palette:', error);
        alert('Sorry, I encountered an error. Please try again.');
    } finally {
        isGenerating.value = false;
    }
};

const copyToClipboard = (text) => {
    navigator.clipboard.writeText(text)
        .then(() => {
            // You could add a toast notification here
            console.log('Copied to clipboard');
        })
        .catch(err => {
            console.error('Failed to copy: ', err);
        });
};

const downloadPalette = () => {
    // Create a text representation of the palette
    let content = 'Color Palette\n\n';
    palette.value.forEach((color, index) => {
        content += `${index + 1}. ${color.name}\n`;
        content += `   HEX: ${color.hex}\n`;
        content += `   RGB: ${color.rgb}\n\n`;
    });

    // Create a download link
    const blob = new Blob([content], { type: 'text/plain' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = 'color-palette.txt';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
};
</script>
