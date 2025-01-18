<template>
    <div class="p-6 bg-white rounded-lg shadow">
        <div class="mb-6">
            <textarea
                rows="6"
                class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Enter the text you want to convert to speech..."
            ></textarea>
        </div>
        <div class="flex gap-4">
            <select class="px-4 py-2 border rounded-lg">
                <option>English (US)</option>
                <option>English (UK)</option>
                <option>Spanish</option>
                <option>French</option>
            </select>
            <button class="px-6 py-2 text-white bg-indigo-500 rounded-lg hover:bg-indigo-600">
                Convert to Speech
            </button>
        </div>
    </div>
</template>
