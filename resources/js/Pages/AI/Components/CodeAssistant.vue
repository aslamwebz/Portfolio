<template>
    <div class="p-6 bg-white rounded-lg shadow">
        <div class="mb-6">
            <textarea
                rows="8"
                class="w-full p-4 font-mono border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Enter your code or describe what you want to achieve..."
            ></textarea>
        </div>
        <div class="flex gap-4">
            <select class="px-4 py-2 border rounded-lg">
                <option>JavaScript</option>
                <option>Python</option>
                <option>PHP</option>
                <option>Java</option>
            </select>
            <button class="px-6 py-2 text-white bg-indigo-500 rounded-lg hover:bg-indigo-600">
                Get Help
            </button>
        </div>
    </div>
</template>
