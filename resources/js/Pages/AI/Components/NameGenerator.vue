<template>
    <div class="p-6 bg-white rounded-lg shadow">
        <div class="mb-6">
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    What are you naming?
                </label>
                <select v-model="nameType"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    :disabled="isGenerating">
                    <option value="business">Business</option>
                    <option value="app">Mobile App</option>
                    <option value="website">Website</option>
                    <option value="product">Product</option>
                    <option value="project">Project</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Describe it (industry, purpose, features, etc.)
                </label>
                <textarea v-model="description" rows="3"
                    class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="E.g., 'A fitness app that helps users track their workouts and nutrition'"
                    :disabled="isGenerating"></textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Any specific words to include or themes to consider?
                </label>
                <input v-model="keywords" type="text"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="E.g., 'tech, future, innovative' (optional)" :disabled="isGenerating" />
            </div>

            <div class="flex gap-4">
                <select v-model="nameCount" class="px-4 py-2 border rounded-lg" :disabled="isGenerating">
                    <option value="5">5 Names</option>
                    <option value="10">10 Names</option>
                    <option value="15">15 Names</option>
                </select>
                <button @click="generateNames"
                    class="px-6 py-2 text-white bg-indigo-500 rounded-lg hover:bg-indigo-600 disabled:bg-indigo-300"
                    :disabled="isGenerating || !description.trim()">
                    <span v-if="!isGenerating">Generate Names</span>
                    <span v-else>Generating...</span>
                </button>
            </div>
        </div>

        <!-- Results Section -->
        <div v-if="isGenerating" class="flex justify-center py-8">
            <div class="w-12 h-12 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
        </div>

        <div v-else-if="names.length > 0" class="mt-6">
            <h3 class="mb-4 text-lg font-medium">Generated Names</h3>
            <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3">
                <div v-for="(name, index) in names" :key="index"
                    class="relative p-4 border rounded-lg group hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-medium">{{ name.name }}</h4>
                        <button @click="copyToClipboard(name.name)" class="p-1 text-gray-500 hover:text-indigo-600"
                            title="Copy to clipboard">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                            </svg>
                        </button>
                    </div>
                    <p class="mt-2 text-sm text-gray-600">{{ name.description }}</p>
                    <div class="mt-2">
                        <span v-if="name.available !== undefined" :class="[
                            'px-2 py-1 text-xs rounded',
                            name.available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                        ]">
                            {{ name.available ? 'Domain Available' : 'Domain Taken' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <button @click="checkDomainAvailability"
                    class="px-4 py-2 mr-3 text-white bg-blue-500 rounded-lg hover:bg-blue-600"
                    :disabled="isCheckingDomains">
                    <span v-if="!isCheckingDomains">Check Domain Availability</span>
                    <span v-else>Checking...</span>
                </button>
                <button @click="downloadNames" class="px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600">
                    Download List
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const nameType = ref('business');
const description = ref('');
const keywords = ref('');
const nameCount = ref('10');
const isGenerating = ref(false);
const isCheckingDomains = ref(false);
const names = ref([]);

const generateNames = async () => {
    if (!description.value.trim() || isGenerating.value) return;

    isGenerating.value = true;
    names.value = [];

    try {
        const response = await axios.post('/ai/name-generator', {
            type: nameType.value,
            description: description.value,
            keywords: keywords.value,
            count: nameCount.value
        });

        if (response.data.success) {
            names.value = response.data.names;
        } else {
            alert('Sorry, there was an error generating names.');
        }
    } catch (error) {
        console.error('Failed to generate names:', error);
        alert('Sorry, I encountered an error. Please try again.');
    } finally {
        isGenerating.value = false;
    }
};

const checkDomainAvailability = async () => {
    if (isCheckingDomains.value || names.value.length === 0) return;

    isCheckingDomains.value = true;

    try {
        const namesList = names.value.map(n => n.name);
        const response = await axios.post('/ai/check-domains', {
            names: namesList
        });

        if (response.data.success) {
            // Update the names array with domain availability info
            names.value = names.value.map((name, index) => {
                return {
                    ...name,
                    available: response.data.availability[index]
                };
            });
        } else {
            alert('Sorry, there was an error checking domain availability.');
        }
    } catch (error) {
        console.error('Failed to check domains:', error);
        alert('Sorry, I encountered an error checking domains.');
    } finally {
        isCheckingDomains.value = false;
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

const downloadNames = () => {
    // Create a text representation of the names
    let content = `Generated ${nameType.value.toUpperCase()} Names\n\n`;
    content += `Description: ${description.value}\n`;
    if (keywords.value) content += `Keywords: ${keywords.value}\n`;
    content += '\n';

    names.value.forEach((name, index) => {
        content += `${index + 1}. ${name.name}\n`;
        content += `   ${name.description}\n`;
        if (name.available !== undefined) {
            content += `   Domain: ${name.available ? 'Available' : 'Taken'}\n`;
        }
        content += '\n';
    });

    // Create a download link
    const blob = new Blob([content], { type: 'text/plain' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = `${nameType.value}-names.txt`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
};
</script>
