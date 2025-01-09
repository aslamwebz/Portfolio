<script setup lang="ts">
import { ref, onMounted } from 'vue';

const lines = [
  { prefix: '$role = ', content: "'Backend / Full Stack Developer';" },
  { prefix: '$techStack = ', content: "'LAMP - LEMP - PHP/Laravel';" },
  { prefix: '$status = ', content: "'PHP Developer @DigitallEgg';" },
];

const visibleLines = ref<number[]>([]);
const typingStates = ref<{ [key: number]: boolean }>({});

onMounted(() => {
  lines.forEach((_, index) => {
    setTimeout(() => {
      visibleLines.value.push(index);
      setTimeout(() => {
        typingStates.value[index] = true;
      }, 50);
    }, index * 1500);
  });
});
</script>

<template>
  <div class="flex items-center justify-center my-6">
    <!-- Terminal Window -->
    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-black shadow-2xl ">
      <!-- Terminal Header -->
      <div class="bg-gray-700 px-4 py-2 relative">
        <div class="flex space-x-2 absolute left-4">
          <div class="w-3 h-3 p-2 mt-2 bg-red-500 rounded-full"></div>
          <div class="w-3 h-3 p-2 mt-2 bg-yellow-500 rounded-full"></div>
          <div class="w-3 h-3 p-2 mt-2 bg-green-500 rounded-full"></div>
        </div>
        <div class="text-gray-400 text-[20px] text-center">aboutMe.php</div>
      </div>
      <!-- Terminal Content -->
      <div class="p-4 font-mono text-[20px]">
        <div v-for="(line, index) in lines" :key="index" class="min-h-[1.5em]">
          <div v-if="visibleLines.includes(index)"
               :class="['line-content', { 'typewriter-effect': typingStates[index] }]">
            <span class="text-purple-400">{{ line.prefix }}</span>
            <span class="text-green-400">{{ line.content }}</span>
          </div>
        </div>
        <div class="mt-2 text-green-400 animate-pulse">▊</div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.line-content {
  white-space: nowrap;
  visibility: hidden;
}

.typewriter-effect {
  visibility: visible;
  overflow: hidden;
  white-space: nowrap;
  animation: typing 1s steps(50, end);
}

@keyframes typing {
  from { width: 0 }
  to { width: 100% }
}
</style>
