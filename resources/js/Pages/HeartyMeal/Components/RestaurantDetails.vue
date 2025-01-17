<template>
    <div class="container px-4 mx-auto">
        <!-- Previous Restaurant.vue template content -->
        <button
            @click="addToCart({
                id: menuItem.id,
                name: menuItem.name,
                price: menuItem.price
            })"
            class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700"
        >
            Add to Cart
        </button>
    </div>
</template>

<script setup>
import { useCartStore } from '@/stores/cartStore';

const { addToCart } = useCartStore();
</script>
