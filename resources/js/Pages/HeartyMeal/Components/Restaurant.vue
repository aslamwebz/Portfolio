<template>
    <LoadingSpinner v-if="isLoading" />
    <div v-else class="container px-4 mx-auto my-6">
        <!-- Restaurant Header -->
        <div class="relative h-48 mb-8 overflow-hidden rounded-lg shadow-md">
            <img :src="`/img/HeartyMeal/Restaurants/${restaurant?.image}`" alt="" class="object-cover w-full h-full">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                <h1 class="text-2xl font-bold">{{ restaurant?.name }}</h1>
                <div class="flex items-center gap-3 mt-1 text-sm">
                    <span class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
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

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <!-- Menu Section -->
            <div class="space-y-8 lg:col-span-2">
                <div v-for="category in menuCategories" :key="category.id" class="mb-6">
                    <h2 class="mb-3 text-xl font-bold">{{ category.name }}</h2>
                    <div class="grid gap-3 sm:grid-cols-2">
                        <div v-for="item in category?.items" :key="item.id"
                            class="flex gap-4 p-3 transition-all duration-300 bg-white border group rounded-xl hover:shadow-md hover:border-orange-500">
                            <div class="relative flex-shrink-0 w-20 h-20 overflow-hidden rounded-lg">
                                <img :src="`/img/HeartyMeal/Foods/${item.image}`" :alt="item.name"
                                    class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between">
                                    <div class="min-w-0">
                                        <h3
                                            class="text-sm font-bold truncate transition-colors group-hover:text-orange-500">
                                            {{
                                                item.name }}</h3>
                                        <p class="mt-1 text-xs text-gray-600 line-clamp-2">{{ item.description }}</p>
                                    </div>
                                    <div class="flex-shrink-0 ml-2 text-right">
                                        <div class="text-sm font-bold text-orange-500">${{ item.price }}</div>
                                        <button @click="addToCart(item)"
                                            class="px-3 py-1 mt-2 text-xs font-medium text-white transition-all duration-300 bg-orange-500 rounded-full hover:bg-orange-600 hover:shadow-sm transform hover:-translate-y-0.5">
                                            Add
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
                <div class="sticky p-4 border rounded-lg shadow-md top-4">
                    <h2 class="mb-3 text-lg font-bold">Your Cart</h2>
                    <div v-if="cart.items?.length === 0" class="py-4 text-sm text-center text-gray-500">
                        Your cart is empty
                    </div>
                    <div v-else>
                        <TransitionGroup name="list" tag="div">
                            <div v-for="item in cart.items" :key="item.id"
                                class="flex items-center gap-3 py-3 border-b animate-fadeIn">
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-medium truncate">{{ item?.name }}</h3>
                                    <div class="flex items-center gap-1 mt-1">
                                        <button @click="decreaseQuantity(item)"
                                            class="p-0.5 text-orange-500 border border-orange-500 rounded-md hover:bg-orange-50 text-xs">
                                            -
                                        </button>
                                        <span class="text-xs">{{ item?.quantity }}</span>
                                        <button @click="increaseQuantity(item)"
                                            class="p-0.5 text-orange-500 border border-orange-500 rounded-md hover:bg-orange-50 text-xs">
                                            +
                                        </button>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm font-medium">${{ (item?.price * item?.quantity).toFixed(2) }}
                                    </div>
                                    <button @click="removeFromCart(item)"
                                        class="text-xs text-red-500 hover:text-red-600">Remove</button>
                                </div>
                            </div>
                        </TransitionGroup>
                        <div class="pt-3 mt-3 border-t">
                            <div class="flex justify-between mb-1 text-sm">
                                <span>Subtotal</span>
                                <span>${{ subtotal.toFixed(2) }}</span>
                            </div>
                            <div class="flex justify-between mb-1 text-sm">
                                <span>Delivery Fee</span>
                                <span>${{ deliveryFee.toFixed(2) }}</span>
                            </div>
                            <div class="flex justify-between mb-3 text-base font-bold">
                                <span>Total</span>
                                <span>${{ total.toFixed(2) }}</span>
                            </div>
                            <button @click="goToCheckout"
                                class="w-full py-2 text-sm text-white transition-colors bg-orange-500 rounded-lg hover:bg-orange-600">
                                Checkout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button v-show="showScrollTop" @click="scrollToTop"
            class="fixed p-2 text-white transition-all duration-300 transform bg-orange-500 rounded-full shadow-lg bottom-6 right-6 hover:bg-orange-600 hover:-translate-y-1">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
    id: {
        type: [String, Number],
        required: true
    },
    restaurant: {
        type: Object,
        default: null
    },
    products: {
        type: Array,
        default: () => []
    }
});

const restaurant = ref(props.restaurant || null);
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
        if (!restaurant.value) {
            // If restaurant data wasn't passed as a prop, fetch it
            const response = await axios.get(`/api/restaurants/${props.id}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'  // Mark as AJAX request
                }
            });
            restaurant.value = response.data.restaurant;
            menuCategories.value = response.data.menuCategories;
        } else {
            // If we have restaurant data but need to organize products
            if (props.products && props.products.length > 0) {
                // Group products by category
                const groupedProducts = {};
                props.products.forEach(product => {
                    const category = product.category || 'Other';
                    if (!groupedProducts[category]) {
                        groupedProducts[category] = [];
                    }
                    groupedProducts[category].push(product);
                });

                // Convert to array format for the template
                menuCategories.value = Object.keys(groupedProducts).map(category => ({
                    name: category,
                    items: groupedProducts[category]
                }));
            }
        }
    } catch (error) {
        console.error('Error fetching restaurant data:', error);
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
