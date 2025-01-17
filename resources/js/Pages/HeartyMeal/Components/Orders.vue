<template>
  <div>
    <Header />
    <div class="min-h-screen bg-gray-100 py-8">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-semibold mb-8">Your Orders</h1>

        <div class="space-y-6">
          <div v-if="orders.length === 0" class="text-center py-8 bg-white rounded-lg shadow">
            <div class="text-gray-500">No orders yet</div>
            <Link
              href="/hearty-meal"
              class="mt-4 inline-block px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
            >
              Browse Restaurants
            </Link>
          </div>

          <div v-for="order in orders" :key="order.id" class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start mb-4">
              <div>
                <h2 class="text-xl font-semibold">Order #{{ order.id }}</h2>
                <p class="text-gray-500">{{ formatDate(order.date) }}</p>
              </div>
              <span
                class="px-3 py-1 rounded-full text-sm capitalize"
                :class="getStatusClass(order.status)"
              >
                {{ order.status }}
              </span>
            </div>

            <div class="space-y-3">
              <div v-for="item in order.items" :key="item.id" class="flex justify-between items-center py-2 border-b">
                <div>
                  <h4 class="font-medium">{{ item.name }}</h4>
                  <p class="text-sm text-gray-600">Quantity: {{ item.quantity }}</p>
                </div>
                <div class="text-right">
                  <div>${{ (item.price * item.quantity).toFixed(2) }}</div>
                </div>
              </div>
            </div>

            <div class="mt-4 pt-4 border-t">
              <div class="flex justify-between font-semibold">
                <span>Total</span>
                <span>${{ order.total.toFixed(2) }}</span>
              </div>
            </div>

            <div class="mt-6 flex justify-end space-x-4">
              <button
                @click="reorder(order)"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
              >
                Order Again
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import { useCartStore } from '@/stores/cartStore';
import Header from './Header.vue';

const orders = ref([]);
const cartStore = useCartStore();

onMounted(() => {
  // Load orders from localStorage
  orders.value = JSON.parse(localStorage.getItem('orders') || '[]').sort((a, b) => {
    return new Date(b.date) - new Date(a.date);
  });
});

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  });
};

const getStatusClass = (status) => {
  const classes = {
    completed: 'bg-green-100 text-green-800',
    pending: 'bg-yellow-100 text-yellow-800',
    cancelled: 'bg-red-100 text-red-800'
  };
  return classes[status] || classes.pending;
};

const reorder = (order) => {
  // Clear existing cart
  cartStore.clearCart();

  // Add all items from the order to the cart
  order.items.forEach(item => {
    cartStore.addToCart({
      id: item.id,
      name: item.name,
      price: item.price,
      quantity: item.quantity
    });
  });

  // Navigate to checkout
  router.visit('/hearty-meal/checkout');
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
