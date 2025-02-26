<template>
    <div class="skill-bar">
        <div class="flex justify-between mb-1">
            <span class="text-base font-medium text-white">{{ name }}</span>
            <span class="text-sm font-medium text-gray-400">{{ percentage }}%</span>
        </div>
        <div class="w-full bg-gray-700 rounded-full h-2.5">
            <div class="h-2.5 rounded-full"
                 :class="getColorClass(color)"
                 :style="{ width: `${percentage}%` }"></div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    name: {
        type: String,
        required: true
    },
    percentage: {
        type: Number,
        required: true,
        validator: (value) => value >= 0 && value <= 100
    },
    color: {
        type: String,
        default: 'blue'
    }
});

const getColorClass = (color) => {
    const colorMap = {
        'blue': 'bg-blue-600',
        'green': 'bg-green-600',
        'red': 'bg-red-600',
        'yellow': 'bg-yellow-500',
        'purple': 'bg-purple-600',
        'pink': 'bg-pink-600',
        'indigo': 'bg-indigo-600',
        'cyan': 'bg-cyan-600',
        'orange': 'bg-orange-500',
        'amber': 'bg-amber-500',
        'gray': 'bg-gray-500'
    };

    return colorMap[color] || 'bg-blue-600';
};
</script>
