<template>
    <div class="flex justify-center mb-8">
        <!-- Timeline entry container with improved spacing -->
        <div class="w-5/12 px-4 py-3 tooltip" :class="[isLeftAligned ? 'text-gray-400 opacity-30' : 'text-right']">
            <h3 class="text-xl font-bold" :class="[isLeftAligned ? 'text-gray-500' : 'text-white']">{{ title }}</h3>
            <p class="">{{ company }} | {{ location }}</p>
            <span class="inline-block text-white text-sm px-2 py-1 rounded mt-2"
                :class="[isLeftAligned ? 'bg-gray-600' : 'bg-blue-500']">{{ period }}</span>
            <p class="mt-4 tooltiptext">{{ description }}</p>
        </div>

        <!-- Timeline center line with improved styling -->
        <div class="relative w-8 flex justify-center items-center">
            <div class="w-1 bg-blue-400 absolute inset-y-0 left-1/2 transform -translate-x-1/2"></div>
            <div class="border-4 bg-gray-900 border-blue-500 w-5 h-5 rounded-full z-20 shadow-lg shadow-blue-500/50"></div>
        </div>

        <!-- Right side content with improved visibility -->
        <div class="w-5/12 px-4 py-3 tooltip" :class="[isLeftAligned ? 'text-left' : 'text-gray-400 opacity-30']">
            <h3 class="text-xl font-bold" :class="[isLeftAligned ? 'text-white' : 'text-gray-500']">{{ title }}</h3>
            <p class="">{{ company }} | {{ location }}</p>
            <span class="inline-block text-white text-sm px-2 py-1 rounded mt-2"
                :class="[isLeftAligned ? 'bg-blue-500' : 'bg-gray-600']">{{ period }}</span>
            <p class="mt-4 tooltiptext">{{ description }}</p>
        </div>
    </div>
</template>

<script setup>
const props = defineProps(['title', 'company', 'location', 'period', 'description', 'isLeftAligned']);
</script>

<style scoped>
.tooltip {
  position: relative;
  display: inline-block;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 300px;
  background-color: rgba(15, 23, 42, 0.95);
  color: #fff;
  text-align: center;
  padding: 15px;
  border-radius: 6px;
  border: 1px solid rgba(59, 130, 246, 0.3);
  box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);

  position: absolute;
  z-index: 30;
  top: 100%;
  left: 50%;
  transform: translateX(-50%);
  margin-top: 10px;

  /* Animation */
  opacity: 0;
  transition: opacity 0.3s, visibility 0.3s;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}

/* Add a tooltip arrow */
.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  bottom: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: transparent transparent rgba(15, 23, 42, 0.95) transparent;
}
</style>
