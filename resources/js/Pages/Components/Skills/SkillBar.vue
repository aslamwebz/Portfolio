<template>
    <div class="mb-4">
        <div class="flex justify-between mb-1">
            <span class="text-sm font-medium text-white">{{ name }}</span>
            <span class="text-sm font-medium text-white">{{ percentage }}%</span>
        </div>
        <div class="w-full bg-gray-700 rounded-full h-2.5">
            <div class="h-2.5 rounded-full skill-progress"
                 :class="colorClass"
                 :style="{ width: isVisible ? `${percentage}%` : '0%' }"></div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';

const props = defineProps({
    name: {
        type: String,
        required: true
    },
    percentage: {
        type: Number,
        required: true
    },
    color: {
        type: String,
        default: 'blue'
    }
});

const isVisible = ref(false);

const colorClass = computed(() => {
    const colors = {
        blue: 'bg-blue-600',
        green: 'bg-green-600',
        red: 'bg-red-600',
        yellow: 'bg-yellow-600',
        purple: 'bg-purple-600',
        indigo: 'bg-indigo-600',
        cyan: 'bg-cyan-600',
        orange: 'bg-orange-600',
        gray: 'bg-gray-600'
    };

    return colors[props.color] || 'bg-blue-600';
});

onMounted(() => {
    setTimeout(() => {
        isVisible.value = true;
    }, 300);
});
</script>

<style scoped>
.skill-progress {
    transition: width 1s ease-in-out;
}
</style>
