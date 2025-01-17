<template>
    <div>
        <LoadingSpinner v-if="isLoading" />
        <div v-else class="container px-4 mx-auto my-8">
            <!-- Categories Scroll Section -->
            <div class="flex justify-center gap-6 mb-12">
                <button @click="scrollLeft" class="p-2 my-auto text-white bg-orange-500 rounded-full hover:bg-orange-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <div class="flex gap-4 overflow-auto scroll-container" ref="scrollContainer">
                    <button v-for="category in categories" :key="category.id"
                        @click="filterRestaurantsByCategory(category.slug)"
                        :class="['flex flex-col items-center gap-2 border p-3 rounded-lg min-w-28 hover:border-primary hover:bg-orange-100 cursor-pointer group overflow-hidden',
                            selectedCategory === category.slug ? 'border-orange-500 bg-orange-100' : '']">
                        <img :src="category.icon" class="transition-all duration-200 group-hover:scale-125" alt=""
                            height="100" width="100">
                        <h1 class="font-medium text-md group-hover:text-orange-500">{{ category.name }}</h1>
                    </button>
                </div>
                <button @click="scrollRight" class="p-2 my-auto text-white bg-orange-500 rounded-full hover:bg-orange-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <!-- Restaurants Grid -->
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <Link
                    :href="`/hearty-meal/restaurant/${restaurant.id}`"
                    v-for="restaurant in paginatedRestaurants"
                    :key="restaurant.id"
                    class="overflow-hidden bg-white border group rounded-xl hover:shadow-lg hover:border-orange-500 will-change-transform">
                    <div class="relative overflow-hidden">
                        <img :src="`/img/HeartyMeal/Restaurents/${restaurant.image}`" :alt="restaurant.name"
                            class="object-cover w-full h-48 transition-transform duration-200 transform-gpu group-hover:scale-105">
                        <div class="absolute top-4 right-4 px-3 py-1.5 text-sm font-semibold bg-white/90 backdrop-blur-sm rounded-lg shadow">
                            {{ restaurant.deliveryTime }} mins
                        </div>
                        <div class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-black/60 to-transparent"></div>
                    </div>
                    <div class="p-5">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h2 class="text-xl font-bold transition-colors group-hover:text-orange-500">
                                    {{ restaurant.name }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">{{ restaurant.cuisine.join(', ') }}</p>
                            </div>
                            <div class="flex items-center gap-1 px-2.5 py-1.5 bg-green-100 rounded-lg">
                                <span class="font-bold text-green-700">{{ restaurant.rating }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-700" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex items-center gap-6 mt-4 text-sm text-gray-600">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Min ${{ restaurant.minOrder }}
                            </span>
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ restaurant.distance }} km
                            </span>
                        </div>
                    </div>
                </Link>
            </div>

            <!-- Pagination Controls -->
            <div class="flex items-center justify-between px-6 py-10 mt-12 border-t">
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-700">
                        Showing {{ startIndex + 1 }} to {{ endIndex }} of {{ totalRestaurants }} restaurants
                    </span>
                </div>
                <div class="flex items-center gap-2">
                    <button
                        @click="previousPage"
                        :disabled="currentPage === 1"
                        :class="['px-4 py-2 text-sm font-medium rounded-md',
                            currentPage === 1
                                ? 'text-gray-400 bg-gray-100 cursor-not-allowed'
                                : 'text-gray-700 bg-white hover:bg-gray-50']"
                    >
                        Previous
                    </button>
                    <div class="flex items-center gap-2">
                        <button
                            v-for="page in displayedPages"
                            :key="page"
                            @click="goToPage(page)"
                            :class="['px-4 py-2 text-sm font-medium rounded-md',
                                currentPage === page
                                    ? 'text-white bg-orange-500'
                                    : 'text-gray-700 bg-white hover:bg-gray-50']"
                        >
                            {{ page }}
                        </button>
                    </div>
                    <button
                        @click="nextPage"
                        :disabled="currentPage === totalPages"
                        :class="['px-4 py-2 text-sm font-medium rounded-md',
                            currentPage === totalPages
                                ? 'text-gray-400 bg-gray-100 cursor-not-allowed'
                                : 'text-gray-700 bg-white hover:bg-gray-50']"
                    >
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import restaurantData from './restaurants.json';
import LoadingSpinner from '@/Components/LoadingSpinner.vue';
import Header from './Header.vue';

const isLoading = ref(true);

// Use restaurants from JSON file
const restaurants = ref(restaurantData.restaurants);

const toggleCartPreview = () => {
    showCartPreview.value = !showCartPreview.value;
};

onMounted(async () => {
    // Simulate loading time
    await new Promise(resolve => setTimeout(resolve, 1000));
    isLoading.value = false;
});

const selectedCategory = ref('all');
const scrollContainer = ref(null);

// Static categories data
const categories = ref([
    {
        id: 1,
        name: 'All',
        slug: 'all',
        icon: 'https://img.icons8.com/color/96/000000/restaurant.png'
    },
    {
        id: 2,
        name: 'Pizza',
        slug: 'pizza',
        icon: 'https://img.icons8.com/color/96/000000/pizza.png'
    },
    {
        id: 3,
        name: 'Burgers',
        slug: 'burgers',
        icon: 'https://img.icons8.com/color/96/000000/hamburger.png'
    },
    {
        id: 4,
        name: 'Asian',
        slug: 'asian',
        icon: 'https://img.icons8.com/color/96/000000/sushi.png'
    },
    {
        id: 5,
        name: 'Indian',
        slug: 'indian',
        icon: 'https://img.icons8.com/color/96/000000/curry.png'
    },
    {
        id: 6,
        name: 'Mexican',
        slug: 'mexican',
        icon: 'https://img.icons8.com/color/96/000000/taco.png'
    },
    {
        id: 7,
        name: 'Italian',
        slug: 'italian',
        icon: 'https://img.icons8.com/color/96/000000/spaghetti.png'
    },
    {
        id: 8,
        name: 'Healthy',
        slug: 'healthy',
        icon: 'https://img.icons8.com/color/96/000000/salad.png'
    },
    {
        id: 9,
        name: 'Desserts',
        slug: 'desserts',
        icon: 'https://img.icons8.com/color/96/000000/cake.png'
    }
]);

// Filter restaurants based on selected category
const filteredRestaurants = computed(() => {
    if (selectedCategory.value === 'all') {
        return restaurants.value;
    }
    return restaurants.value.filter(restaurant =>
        restaurant.categories.includes(selectedCategory.value)
    );
});

// Pagination
const currentPage = ref(1);
const itemsPerPage = 10;

// Computed properties for pagination
const totalRestaurants = computed(() => filteredRestaurants.value.length);
const totalPages = computed(() => Math.ceil(totalRestaurants.value / itemsPerPage));
const startIndex = computed(() => (currentPage.value - 1) * itemsPerPage);
const endIndex = computed(() => Math.min(startIndex.value + itemsPerPage, totalRestaurants.value));

// Get displayed pages (show 5 page numbers at a time)
const displayedPages = computed(() => {
    const pages = [];
    let start = Math.max(1, currentPage.value - 2);
    let end = Math.min(totalPages.value, start + 4);

    // Adjust start if we're near the end
    if (end === totalPages.value) {
        start = Math.max(1, end - 4);
    }

    for (let i = start; i <= end; i++) {
        pages.push(i);
    }
    return pages;
});

// Get paginated restaurants
const paginatedRestaurants = computed(() => {
    return filteredRestaurants.value.slice(startIndex.value, endIndex.value);
});

// Pagination methods
const goToPage = (page) => {
    currentPage.value = page;
};

const nextPage = () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
    }
};

const previousPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--;
    }
};

// Reset to first page when category changes
const filterRestaurantsByCategory = (slug) => {
    selectedCategory.value = slug;
    currentPage.value = 1; // Reset to first page
};

const scrollLeft = () => {
    if (scrollContainer.value) {
        scrollContainer.value.scrollBy({
            left: -200,
            behavior: 'smooth'
        });
    }
};

const scrollRight = () => {
    if (scrollContainer.value) {
        scrollContainer.value.scrollBy({
            left: 200,
            behavior: 'smooth'
        });
    }
};
</script>

<style scoped>
/* Add these styles for cart animations */
.cart-enter-active,
.cart-leave-active {
    transition: all 0.3s ease;
}

.cart-enter-from,
.cart-leave-to {
    opacity: 0;
    transform: translateY(30px);
}

/* Your existing styles */
.scroll-container {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.scroll-container::-webkit-scrollbar {
    display: none;
}
</style>
