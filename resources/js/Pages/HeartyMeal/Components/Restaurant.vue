<template>
    <LoadingSpinner v-if="isLoading" />
    <div v-else class="container px-4 mx-auto my-8">
        <!-- Restaurant Header -->
        <div class="relative h-64 mb-12 overflow-hidden rounded-lg shadow-lg">
            <img :src="`/img/HeartyMeal/Restaurants/${restaurant?.image}`" alt="" class="object-cover w-full h-full">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                <h1 class="text-3xl font-bold">{{ restaurant?.name }}</h1>
                <div class="flex items-center gap-4 mt-2">
                    <span class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        {{ restaurant?.rating }}
                    </span>
                    <span>•</span>
                    <span>{{ restaurant?.cuisine.join(', ') }}</span>
                    <span>•</span>
                    <span>{{ restaurant?.deliveryTime }} mins</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-12 lg:grid-cols-3">
            <!-- Menu Section -->
            <div class="space-y-10 lg:col-span-2">
                <div v-for="category in menuCategories" :key="category.id" class="mb-8">
                    <h2 class="mb-4 text-2xl font-bold">{{ category.name }}</h2>
                    <div class="grid gap-4">
                        <div v-for="item in category?.items" :key="item.id"
                            class="flex gap-6 p-5 transition-all duration-300 bg-white border group rounded-xl hover:shadow-lg hover:border-orange-500">
                            <div class="relative w-32 h-32 overflow-hidden rounded-lg">
                                <img :src="`/img/HeartyMeal/Foods/${item.image}`" :alt="item.name"
                                    class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                            </div>
                            <div class="flex-1">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-lg font-bold transition-colors group-hover:text-orange-500">{{
                                            item.name }}</h3>
                                        <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ item.description }}</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg font-bold text-orange-500">${{ item.price }}</div>
                                        <button @click="addToCart(item)"
                                            class="px-6 py-2 mt-3 text-sm font-medium text-white transition-all duration-300 bg-orange-500 rounded-full hover:bg-orange-600 hover:shadow-lg transform hover:-translate-y-0.5">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart Section -->
            <div class="lg:col-span-1">
                <div class="sticky p-8 border rounded-lg shadow-lg top-4">
                    <h2 class="mb-4 text-xl font-bold">Your Cart</h2>
                    <div v-if="cart.items?.length === 0" class="py-4 text-center text-gray-500">
                        Your cart is empty
                    </div>
                    <div v-else>
                        <TransitionGroup name="list" tag="div">
                            <div v-for="item in cart.items" :key="item.id"
                                class="flex items-center gap-4 py-4 border-b animate-fadeIn">
                                <div class="flex-1">
                                    <h3 class="font-medium">{{ item?.name }}</h3>
                                    <div class="flex items-center gap-2 mt-1">
                                        <button @click="decreaseQuantity(item)"
                                            class="p-1 text-orange-500 border border-orange-500 rounded-md hover:bg-orange-50">
                                            -
                                        </button>
                                        <span>{{ item?.quantity }}</span>
                                        <button @click="increaseQuantity(item)"
                                            class="p-1 text-orange-500 border border-orange-500 rounded-md hover:bg-orange-50">
                                            +
                                        </button>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="font-medium">${{ item?.price * item?.quantity }}</div>
                                    <button @click="removeFromCart(item)"
                                        class="text-sm text-red-500 hover:text-red-600">Remove</button>
                                </div>
                            </div>
                        </TransitionGroup>
                        <div class="pt-4 mt-4 border-t">
                            <div class="flex justify-between mb-2">
                                <span>Subtotal</span>
                                <span>${{ subtotal }}</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span>Delivery Fee</span>
                                <span>${{ deliveryFee }}</span>
                            </div>
                            <div class="flex justify-between mb-4 text-lg font-bold">
                                <span>Total</span>
                                <span>${{ total }}</span>
                            </div>
                            <button @click="goToCheckout"
                                class="w-full py-3 text-white transition-colors bg-orange-500 rounded-lg hover:bg-orange-600">
                                Checkout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button v-show="showScrollTop" @click="scrollToTop"
            class="fixed p-3 text-white transition-all duration-300 transform bg-orange-500 rounded-full shadow-lg bottom-8 right-8 hover:bg-orange-600 hover:-translate-y-1">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import { useCartStore } from '@/stores/cartStore';
import LoadingSpinner from '@/Components/LoadingSpinner.vue';
import axios from 'axios';

const props = defineProps({
    restaurantId: {
        type: [String, Number],
        required: true
    }
});

const fetchRestaurantData = async (id) => {
    try {
        const response = await axios.get(`/api/restaurants/${id}`);
        return response.data;
    } catch (error) {
        console.error('Error fetching restaurant data:', error);
        return null;
    }
};

const restaurant = ref(null);
const menuCategories = ref([]);

const isLoading = ref(true);
const cartStore = useCartStore();
const cart = computed(() => ({
    items: cartStore.cart.value || []
}));
const subtotal = computed(() => {
    return cart.value.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
});
const deliveryFee = computed(() => subtotal.value > 0 ? 3.99 : 0);
const total = computed(() => subtotal.value + deliveryFee.value);

const showScrollTop = ref(false);

onMounted(async () => {
    try {
        const data = await fetchRestaurantData(props.restaurantId);
        if (data) {
            restaurant.value = data.restaurant;
            menuCategories.value = data.menuCategories;
        }
    } finally {
        isLoading.value = false;
    }

    window.addEventListener('scroll', () => {
        showScrollTop.value = window.pageYOffset > 500;
    });
});

// Update cart methods
const addToCart = (item) => {
    cartStore.addToCart(item);
};

const removeFromCart = (item) => {
    cartStore.removeFromCart(item.id);
};

const increaseQuantity = (item) => {
    cartStore.updateQuantity(item.id, item.quantity + 1);
};

const decreaseQuantity = (item) => {
    if (item.quantity > 1) {
        cartStore.updateQuantity(item.id, item.quantity - 1);
    } else {
        removeFromCart(item);
    }
};

const scrollToTop = () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
};

// Add checkout function
const goToCheckout = () => {
    router.visit('/hearty-meal/checkout');
};
</script>
<style scoped>
.list-enter-active,
.list-leave-active {
    transition: all 0.3s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateX(30px);
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeIn {
    animation: fadeIn 0.3s ease-out;
}
</style>
