<template>
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="p-6 bg-white rounded-xl shadow-2xl transform animate-slideIn">
            <div class="relative">
                <div class="w-20 h-20 border-4 border-orange-500/30 rounded-full animate-spin">
                    <div class="absolute inset-0 border-4 border-orange-500 border-t-transparent rounded-full"></div>
                </div>
            </div>
            <p class="mt-4 text-lg font-medium text-gray-700 text-center">Loading...</p>
        </div>
    </div>
</template>

<style scoped>
@keyframes slideIn {
    0% { opacity: 0; transform: scale(0.9); }
    100% { opacity: 1; transform: scale(1); }
}

.animate-slideIn {
    animation: slideIn 0.3s ease-out;
}
</style>
