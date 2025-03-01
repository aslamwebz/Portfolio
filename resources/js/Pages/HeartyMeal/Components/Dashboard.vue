<template>
    <div>
        <LoadingSpinner v-if="isLoading" />
        <div v-else class="container px-4 mx-auto my-6">
            <!-- Categories Scroll Section -->
            <div class="flex justify-center gap-4 mb-8">
                <button @click="scrollLeft"
                    class="p-1.5 my-auto text-white bg-orange-500 rounded-full hover:bg-orange-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <div class="flex gap-3 overflow-auto scroll-container" ref="scrollContainer">
                    <button v-for="category in categories" :key="category.id"
                        @click="filterRestaurantsByCategory(category.slug)" :class="['flex flex-col items-center gap-1 border p-2 rounded-lg min-w-20 hover:border-orange-500 hover:bg-orange-50 cursor-pointer group overflow-hidden',
                            selectedCategory === category.slug ? 'border-orange-500 bg-orange-50' : '']">
                        <img :src="category.icon" class="w-10 h-10 transition-all duration-200 group-hover:scale-110"
                            :alt="category.name">
                        <h1 class="text-xs font-medium group-hover:text-orange-500">{{ category.name }}</h1>
                    </button>
                </div>
                <button @click="scrollRight"
                    class="p-1.5 my-auto text-white bg-orange-500 rounded-full hover:bg-orange-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <!-- Restaurants Grid -->
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                <Link :href="`/hearty-meal/restaurant/${restaurant.id}`" v-for="restaurant in paginatedRestaurants"
                    :key="restaurant.id"
                    class="overflow-hidden bg-white border group rounded-xl hover:shadow-md hover:border-orange-500 will-change-transform">
                <div class="relative overflow-hidden">
                    <img :src="`img/HeartyMeal/Restaurants/${restaurant.image}`" :alt="restaurant.name"
                        @error="handleImageError"
                        class="object-cover w-full h-32 transition-transform duration-200 transform-gpu group-hover:scale-105">
                    <div
                        class="absolute px-2 py-1 text-xs font-semibold rounded-lg shadow top-2 right-2 bg-white/90 backdrop-blur-sm">
                        {{ restaurant.deliveryTime }} mins
                    </div>
                    <div class="absolute inset-x-0 bottom-0 h-12 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>
                <div class="p-3">
                    <div class="flex items-start justify-between mb-1">
                        <div>
                            <h2 class="text-sm font-bold transition-colors group-hover:text-orange-500">
                                {{ restaurant.name }}
                            </h2>
                            <p class="text-xs text-gray-600 truncate">{{ restaurant.cuisine.join(', ') }}</p>
                        </div>
                        <div class="flex items-center gap-0.5 px-1.5 py-0.5 bg-green-100 rounded-md">
                            <span class="text-xs font-bold text-green-700">{{ restaurant.rating }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-green-700" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 mt-2 text-xs text-gray-600">
                        <span class="flex items-center gap-1">
                            <svg class="w-3 h-3 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            ${{ restaurant.minOrder }}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-3 h-3 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ restaurant.distance }} km
                        </span>
                    </div>
                </div>
                </Link>
            </div>

            <!-- Pagination Controls -->
            <div class="flex items-center justify-between px-4 py-6 mt-8 border-t">
                <div class="flex items-center gap-2">
                    <span class="text-xs text-gray-700">
                        Showing {{ startIndex + 1 }} to {{ endIndex }} of {{ totalRestaurants }} restaurants
                    </span>
                </div>
                <div class="flex items-center gap-1">
                    <button @click="previousPage" :disabled="currentPage === 1" :class="['px-3 py-1 text-xs font-medium rounded-md',
                        currentPage === 1
                            ? 'text-gray-400 bg-gray-100 cursor-not-allowed'
                            : 'text-gray-700 bg-white hover:bg-gray-50']">
                        Previous
                    </button>
                    <div class="flex items-center gap-1">
                        <button v-for="page in displayedPages" :key="page" @click="goToPage(page)" :class="['px-3 py-1 text-xs font-medium rounded-md',
                            currentPage === page
                                ? 'text-white bg-orange-500'
                                : 'text-gray-700 bg-white hover:bg-gray-50']">
                            {{ page }}
                        </button>
                    </div>
                    <button @click="nextPage" :disabled="currentPage === totalPages" :class="['px-3 py-1 text-xs font-medium rounded-md',
                        currentPage === totalPages
                            ? 'text-gray-400 bg-gray-100 cursor-not-allowed'
                            : 'text-gray-700 bg-white hover:bg-gray-50']">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import LoadingSpinner from '@/Components/LoadingSpinner.vue';

const props = defineProps({
    initialCategories: {
        type: Array,
        required: true
    },
    initialRestaurants: {
        type: Array,
        required: true
    }
});

const page = usePage();
const isLoading = ref(true);
const restaurants = ref([]);
const categories = ref([]);
const selectedCategory = ref('all');
const scrollContainer = ref(null);

// Initialize data from props
onMounted(async () => {
    // Set data from props
    restaurants.value = props.initialRestaurants || [];
    categories.value = props.initialCategories || [];

    // Check if there's a category in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const categoryParam = urlParams.get('category');

    if (categoryParam) {
        selectedCategory.value = categoryParam;
    }

    // Simulate loading time (can be removed in production)
    await new Promise(resolve => setTimeout(resolve, 500));
    isLoading.value = false;
});

// Watch for changes in props
watch(() => props.initialRestaurants, (newVal) => {
    if (newVal) {
        restaurants.value = newVal;
    }
}, { immediate: true });

watch(() => props.initialCategories, (newVal) => {
    if (newVal) {
        categories.value = newVal;
    }
}, { immediate: true });

// Watch for URL changes to update selected category
watch(() => page.url.search, (newVal) => {
    const urlParams = new URLSearchParams(newVal);
    const categoryParam = urlParams.get('category');

    if (categoryParam) {
        selectedCategory.value = categoryParam;
    } else {
        selectedCategory.value = 'all';
    }
});

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

// Update URL when category changes
const filterRestaurantsByCategory = (slug) => {
    selectedCategory.value = slug;
    currentPage.value = 1; // Reset to first page

    // Update URL without full page reload
    const url = slug === 'all'
        ? '/hearty-meal'
        : `/hearty-meal?category=${slug}`;

    window.history.pushState({}, '', url);
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

const handleImageError = (e) => {
    console.error('Image failed to load:', e.target.src);
    // Optionally set a fallback image
    e.target.src = '/img/placeholder.png';
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
