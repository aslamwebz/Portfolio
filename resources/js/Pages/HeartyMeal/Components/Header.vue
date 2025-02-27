<template>
  <nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex items-center">
          <Link href="/hearty-meal" class="text-2xl font-bold text-gray-900">
          HeartyMeal
          </Link>
        </div>
        <div class="flex items-center">
          <CartDropdown />
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import CartDropdown from './CartDropdown.vue';
</script>
