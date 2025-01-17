<template>
  <div>
    <Header />
    <div class="min-h-screen py-8 bg-gray-100">
      <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
          <!-- Map Section -->
          <div class="p-6 bg-white rounded-lg shadow">
            <div class="relative">
              <img src="/img/HeartyMeal/map-background.png" alt="Map" class="w-full h-[400px] rounded-lg object-cover">

              <!-- Animated delivery marker -->
              <div
                class="absolute w-8 h-8 transition-all duration-1000 ease-in-out"
                :style="markerStyle"
              >
                <div class="p-1 bg-white rounded-full shadow-lg animate-bounce">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                  </svg>
                </div>
              </div>
            </div>
          </div>

          <!-- Delivery Status Section -->
          <div class="p-6 bg-white rounded-lg shadow">
            <h2 class="mb-6 text-2xl font-semibold">Delivery Status</h2>

            <div class="relative">
              <!-- Progress Line -->
              <div class="absolute left-8 h-full w-0.5 bg-gray-200"></div>

              <!-- Status Steps -->
              <div class="space-y-8">
                <div v-for="(step, index) in deliverySteps" :key="index" class="relative flex items-center">
                  <div
                    :class="[
                      'w-4 h-4 rounded-full border-4 z-10',
                      step.completed ? 'border-green-500 bg-white' : 'border-gray-300 bg-white'
                    ]"
                  ></div>
                  <div class="ml-6">
                    <h3
                      :class="[
                        'font-medium',
                        step.completed ? 'text-green-500' : 'text-gray-500'
                      ]"
                    >
                      {{ step.title }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">{{ step.description }}</p>
                    <p v-if="step.completed" class="mt-1 text-sm text-green-500">
                      {{ step.time }}
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Delivery Info -->
            <div class="p-4 mt-8 border rounded-lg bg-gray-50">
              <div class="flex items-center gap-4">
                <img src="/img/HeartyMeal/driver-avatar.png" alt="Driver" class="w-12 h-12 rounded-full">
                <div>
                  <h4 class="font-medium">{{ driverName }}</h4>
                  <p class="text-sm text-gray-500">Your Delivery Partner</p>
                </div>
              </div>
              <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                  <p class="text-sm text-gray-500">Estimated Time</p>
                  <p class="font-medium">{{ estimatedTime }} mins</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Distance</p>
                  <p class="font-medium">{{ distance }} km away</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import Header from './Header.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  orderId: {
    type: [String, Number],
    required: true
  }
});

// Mock delivery data
const driverName = ref('John Smith');
const estimatedTime = ref(15);
const distance = ref(1.8);

// Get order details from localStorage
const order = ref(null);
onMounted(() => {
  const orders = JSON.parse(localStorage.getItem('orders') || '[]');
  order.value = orders.find(o => o.id === Number(props.orderId));
  if (!order.value) {
    // Handle invalid order ID - redirect to orders page
    router.visit('/hearty-meal/orders');
    return;
  }

  // Start delivery simulation
  simulateDelivery();
});

// Delivery steps
const deliverySteps = ref([
  {
    title: 'Order Confirmed',
    description: 'Restaurant has received your order',
    time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
    completed: true
  },
  {
    title: 'Preparing Your Food',
    description: 'Your food is being prepared',
    time: '',
    completed: false
  },
  {
    title: 'On the Way',
    description: 'Driver is heading to your location',
    time: '',
    completed: false
  },
  {
    title: 'Delivered',
    description: 'Enjoy your meal!',
    time: '',
    completed: false
  }
]);

// Marker animation
const markerPosition = ref({ x: 20, y: 50 }); // percentage values
const markerStyle = computed(() => ({
  left: `${markerPosition.value.x}%`,
  top: `${markerPosition.value.y}%`
}));

// Simulate delivery progress
const simulateDelivery = async () => {
  // Step 2: Preparing
  await new Promise(resolve => setTimeout(resolve, 3000));
  deliverySteps.value[1].completed = true;
  deliverySteps.value[1].time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

  // Step 3: On the Way
  await new Promise(resolve => setTimeout(resolve, 3000));
  deliverySteps.value[2].completed = true;
  deliverySteps.value[2].time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

  // Animate marker
  const positions = [
    { x: 30, y: 40 },
    { x: 45, y: 35 },
    { x: 60, y: 45 },
    { x: 75, y: 60 }
  ];

  for (const position of positions) {
    await new Promise(resolve => setTimeout(resolve, 2000));
    markerPosition.value = position;
    distance.value = Math.max(0.1, distance.value - 0.4).toFixed(1);
    estimatedTime.value = Math.max(1, estimatedTime.value - 3);
  }

  // Step 4: Delivered
  await new Promise(resolve => setTimeout(resolve, 2000));
  deliverySteps.value[3].completed = true;
  deliverySteps.value[3].time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
};
</script>

<style scoped>
.animate-bounce {
  animation: bounce 1s infinite;
}

@keyframes bounce {
  0%, 100% {
    transform: translateY(-25%);
    animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
  }
  50% {
    transform: translateY(0);
    animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
  }
}
</style>
