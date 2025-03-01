<template>
  <div class="relative">
    <!-- Cart Button -->
    <button @click="isOpen = !isOpen" class="flex items-center space-x-1 text-gray-700 hover:text-gray-900">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
      </svg>
      <span class="px-2 py-1 text-xs text-white bg-red-500 rounded-full" v-if="itemCount">
        {{ itemCount }}
      </span>
    </button>

    <!-- Dropdown -->
    <div v-if="isOpen" class="absolute right-0 z-50 mt-2 bg-white rounded-lg shadow-lg w-80">
      <div class="p-4">
        <h3 class="mb-4 text-lg font-semibold">Shopping Cart</h3>

        <div v-if="cart?.length === 0" class="py-4 text-center text-gray-500">
          Your cart is empty
        </div>

        <div v-else>
          <div v-for="item in cart" :key="item.id" class="flex items-center justify-between mb-4">
            <div>
              <h4 class="font-medium">{{ item.name }}</h4>
              <div class="flex items-center space-x-2">
                <button @click="updateQuantity(item.id, item.quantity - 1)"
                  class="text-gray-500 hover:text-gray-700">-</button>
                <span>{{ item.quantity }}</span>
                <button @click="updateQuantity(item.id, item.quantity + 1)"
                  class="text-gray-500 hover:text-gray-700">+</button>
              </div>
            </div>
            <div class="text-right">
              <div>${{ (item.price * item.quantity).toFixed(2) }}</div>
              <button @click="removeFromCart(item.id)" class="text-sm text-red-500 hover:text-red-700">
                Remove
              </button>
            </div>
          </div>

          <div class="pt-4 mt-4 border-t">
            <div class="flex justify-between mb-4 font-semibold">
              <span>Total:</span>
              <span>${{ total.toFixed(2) }}</span>
            </div>
            <div class="space-y-2">
              <button @click="goToCheckout"
                class="w-full px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                Checkout
              </button>
              <Link href="/hearty-meal/orders"
                class="block w-full px-4 py-2 text-center text-indigo-600 bg-white border border-indigo-600 rounded-md hover:bg-indigo-50"
                @click="isOpen = false">
              View Orders
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useCartStore } from '@/stores/cartStore';
import { router } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const isOpen = ref(false);
const cartStore = useCartStore();

// Create computed properties from cartStore
const cart = computed(() => cartStore.cart.value);
const total = computed(() => cartStore.total.value);
const itemCount = computed(() => cartStore.itemCount.value);
const { removeFromCart, updateQuantity } = cartStore;

const goToCheckout = () => {
  router.visit('/hearty-meal/checkout');
  isOpen.value = false;
};
</script>
