<template>
  <div class="min-h-screen py-8 bg-gray-100">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
        <!-- Order Summary -->
        <div class="p-6 bg-white rounded-lg shadow">
          <h2 class="mb-4 text-2xl font-semibold">Order Summary</h2>
          <div class="space-y-4">
            <div v-for="item in cart" :key="item.id" class="flex justify-between">
              <span>{{ item.name }} x {{ item.quantity }}</span>
              <span>${{ (item.price * item.quantity) }}</span>
            </div>
            <div class="pt-4 border-t">
              <div class="flex justify-between font-semibold">
                <span>Total</span>
                <span>${{ total }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Payment Form -->
        <div class="p-6 bg-white rounded-lg shadow">
          <h2 class="mb-4 text-2xl font-semibold">Payment Details</h2>
          <form @submit.prevent="handlePayment">
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Card Information</label>
                <div id="card-element" class="p-3 mt-1 border rounded-md"></div>
                <div id="card-errors" class="mt-2 text-sm text-red-600"></div>
              </div>

              <button type="submit" class="w-full px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700"
                :disabled="processing">
                {{ processing ? 'Processing...' : 'Pay Now' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { loadStripe } from '@stripe/stripe-js';
import { useCartStore } from '@/stores/cartStore';
import { router } from '@inertiajs/vue3';

const stripe = ref(null);
const elements = ref(null);
const processing = ref(false);

const { cart, total, clearCart } = useCartStore();

onMounted(async () => {
  // Initialize Stripe with publishable key from env
  stripe.value = await loadStripe(import.meta.env.VITE_STRIPE_PUBLISHABLE_KEY);
  elements.value = stripe.value.elements();

  const cardElement = elements.value.create('card');
  cardElement.mount('#card-element');
});

const handlePayment = async () => {
  processing.value = true;

  try {
    // In a real app, you would create a payment intent on your backend
    // For demo, we'll simulate a successful payment
    await new Promise(resolve => setTimeout(resolve, 2000));

    // Save order to local storage
    const orders = JSON.parse(localStorage.getItem('orders') || '[]');
    const newOrder = {
      id: Date.now(),
      items: cart.value,
      total: total.value,
      date: new Date().toISOString(),
      status: 'completed'
    };
    orders.push(newOrder);
    localStorage.setItem('orders', JSON.stringify(orders));

    // Clear cart and redirect to delivery tracking
    clearCart();
    const orderId = newOrder.id;
    router.visit(`/hearty-meal/delivery/${orderId}`);
  } catch (error) {
    console.error('Payment failed:', error);
  } finally {
    processing.value = false;
  }
};
</script>
