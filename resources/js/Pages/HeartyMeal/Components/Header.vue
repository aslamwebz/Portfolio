<template>
    <nav class="sticky top-0 z-50 bg-white shadow-md">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo and Navigation -->
                <div class="flex items-center">
                    <Link href="/hearty-meal" class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-orange-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.325 14.37a1 1 0 001.214-.32l2.414-3.415a1.96 1.96 0 00.361-1.147 1.95 1.95 0 00-.572-1.4 1.932 1.932 0 00-2.733.147l-2.414 3.414a1 1 0 00.33 1.721zM3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="text-xl font-bold text-gray-900">HeartyMeal</span>
                    </Link>

                    <div class="hidden md:ml-6 md:flex md:space-x-4">
                        <Link href="/hearty-meal"
                            class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-orange-500">Home</Link>
                        <Link href="/hearty-meal/orders"
                            class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-orange-500">My Orders</Link>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="items-center flex-1 hidden max-w-xl mx-4 md:flex">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text"
                            class="block w-full py-2 pl-10 pr-3 border border-gray-300 rounded-full bg-gray-50 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                            placeholder="Search for restaurants or dishes..." v-model="searchQuery"
                            @input="handleSearch">

                        <!-- Search Results Dropdown -->
                        <div v-if="showSearchResults && filteredRestaurants.length > 0"
                            class="absolute z-10 w-full mt-2 overflow-y-auto bg-white rounded-md shadow-lg max-h-96">
                            <div class="py-2">
                                <h3 class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase">Restaurants</h3>
                                <div v-for="restaurant in filteredRestaurants" :key="restaurant.id"
                                    class="px-4 py-2 hover:bg-gray-100">
                                    <Link :href="`/hearty-meal/restaurant/${restaurant.id}`" class="flex items-center"
                                        @click="clearSearch">
                                    <div class="flex-shrink-0 w-10 h-10 mr-3 overflow-hidden rounded-md">
                                        <img :src="`/img/HeartyMeal/Restaurants/${restaurant.image}`"
                                            :alt="restaurant.name" class="object-cover w-full h-full"
                                            @error="handleImageError">
                                    </div>
                                    <div>
                                        <div class="font-medium">{{ restaurant.name }}</div>
                                        <div class="text-xs text-gray-500">
                                            {{ restaurant.cuisine.join(', ') }} • {{ restaurant.deliveryTime }} mins
                                        </div>
                                    </div>
                                    </Link>
                                </div>
                            </div>

                            <div v-if="filteredCategories.length > 0" class="py-2 border-t border-gray-100">
                                <h3 class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase">Categories</h3>
                                <div v-for="category in filteredCategories" :key="category.id"
                                    class="px-4 py-2 hover:bg-gray-100">
                                    <Link :href="`/hearty-meal?category=${category.slug}`" class="flex items-center"
                                        @click="clearSearch">
                                    <div class="flex-shrink-0 w-8 h-8 mr-3 overflow-hidden rounded-md">
                                        <img :src="category.icon" :alt="category.name"
                                            class="object-cover w-full h-full">
                                    </div>
                                    <div class="font-medium">{{ category.name }}</div>
                                    </Link>
                                </div>
                            </div>
                        </div>

                        <!-- No Results Message -->
                        <div v-if="showSearchResults && searchQuery && filteredRestaurants.length === 0 && filteredCategories.length === 0"
                            class="absolute z-10 w-full mt-2 bg-white rounded-md shadow-lg">
                            <div class="px-4 py-6 text-center text-gray-500">
                                <p>No results found for "{{ searchQuery }}"</p>
                                <p class="mt-1 text-sm">Try a different search term</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right side - Cart and Profile -->
                <div class="flex items-center space-x-4">
                    <CartDropdown />

                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <button @click="isProfileOpen = !isProfileOpen"
                            class="flex items-center text-gray-700 hover:text-gray-900 focus:outline-none">
                            <div
                                class="flex items-center justify-center w-8 h-8 text-orange-500 bg-orange-100 rounded-full">
                                <span class="text-sm font-medium">{{ userInitials }}</span>
                            </div>
                        </button>

                        <transition name="fade">
                            <div v-if="isProfileOpen"
                                class="absolute right-0 z-50 w-48 py-1 mt-2 bg-white rounded-md shadow-lg">
                                <Link href="/hearty-meal/profile"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</Link>
                                <Link href="/hearty-meal/orders"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Orders</Link>
                                <Link href="/hearty-meal/favorites"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Saved Restaurants
                                </Link>
                                <div class="border-t border-gray-100"></div>
                                <button
                                    class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">Sign
                                    out</button>
                            </div>
                        </transition>
                    </div>
                </div>
            </div>

            <!-- Mobile Search (visible only on small screens) -->
            <div class="py-2 md:hidden">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text"
                        class="block w-full py-2 pl-10 pr-3 border border-gray-300 rounded-full bg-gray-50 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                        placeholder="Search for restaurants or dishes..." v-model="searchQuery" @input="handleSearch">

                    <!-- Mobile Search Results -->
                    <div v-if="showSearchResults && searchQuery && (filteredRestaurants.length > 0 || filteredCategories.length > 0)"
                        class="absolute z-10 w-full mt-2 overflow-y-auto bg-white rounded-md shadow-lg max-h-96">
                        <!-- Same content as desktop dropdown -->
                        <div v-if="filteredRestaurants.length > 0" class="py-2">
                            <h3 class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase">Restaurants</h3>
                            <div v-for="restaurant in filteredRestaurants" :key="restaurant.id"
                                class="px-4 py-2 hover:bg-gray-100">
                                <Link :href="`/hearty-meal/restaurant/${restaurant.id}`" class="flex items-center"
                                    @click="clearSearch">
                                <div class="flex-shrink-0 w-10 h-10 mr-3 overflow-hidden rounded-md">
                                    <img :src="`/img/HeartyMeal/Restaurants/${restaurant.image}`" :alt="restaurant.name"
                                        class="object-cover w-full h-full" @error="handleImageError">
                                </div>
                                <div>
                                    <div class="font-medium">{{ restaurant.name }}</div>
                                    <div class="text-xs text-gray-500">
                                        {{ restaurant.cuisine.join(', ') }} • {{ restaurant.deliveryTime }} mins
                                    </div>
                                </div>
                                </Link>
                            </div>
                        </div>

                        <div v-if="filteredCategories.length > 0" class="py-2 border-t border-gray-100">
                            <h3 class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase">Categories</h3>
                            <div v-for="category in filteredCategories" :key="category.id"
                                class="px-4 py-2 hover:bg-gray-100">
                                <Link :href="`/hearty-meal?category=${category.slug}`" class="flex items-center"
                                    @click="clearSearch">
                                <div class="flex-shrink-0 w-8 h-8 mr-3 overflow-hidden rounded-md">
                                    <img :src="category.icon" :alt="category.name" class="object-cover w-full h-full">
                                </div>
                                <div class="font-medium">{{ category.name }}</div>
                                </Link>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile No Results Message -->
                    <div v-if="showSearchResults && searchQuery && filteredRestaurants.length === 0 && filteredCategories.length === 0"
                        class="absolute z-10 w-full mt-2 bg-white rounded-md shadow-lg">
                        <div class="px-4 py-6 text-center text-gray-500">
                            <p>No results found for "{{ searchQuery }}"</p>
                            <p class="mt-1 text-sm">Try a different search term</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overlay to close profile dropdown when clicking outside -->
        <div v-if="isProfileOpen" @click="isProfileOpen = false" class="fixed inset-0 z-40"></div>

        <!-- Overlay to close search results when clicking outside -->
        <div v-if="showSearchResults && (filteredRestaurants.length > 0 || filteredCategories.length > 0)"
            @click="showSearchResults = false" class="fixed inset-0 z-30"></div>
    </nav>
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import CartDropdown from './CartDropdown.vue';
import { debounce } from 'lodash';

const isProfileOpen = ref(false);
const searchQuery = ref('');
const showSearchResults = ref(false);

// Get restaurants and categories from props
const page = usePage();
const allRestaurants = ref([]);
const allCategories = ref([]);

// Initialize data
onMounted(() => {
    // Get data from page props
    if (page.props.restaurants) {
        allRestaurants.value = page.props.restaurants;
    }

    if (page.props.categories) {
        allCategories.value = page.props.categories;
    }
});

// Filter restaurants based on search query
const filteredRestaurants = computed(() => {
    if (!searchQuery.value) return [];

    const query = searchQuery.value.toLowerCase();
    return allRestaurants.value.filter(restaurant => {
        // Search by name
        if (restaurant.name && restaurant.name.toLowerCase().includes(query)) return true;

        // Search by cuisine
        if (restaurant.cuisine && Array.isArray(restaurant.cuisine) &&
            restaurant.cuisine.some(c => c && c.toLowerCase().includes(query))) return true;

        // Search by menu items (if available)
        if (restaurant.menu && Array.isArray(restaurant.menu) &&
            restaurant.menu.some(item =>
                (item.name && item.name.toLowerCase().includes(query)) ||
                (item.description && item.description.toLowerCase().includes(query))
            )) return true;

        return false;
    }).slice(0, 5); // Limit to 5 results
});

// Filter categories based on search query
const filteredCategories = computed(() => {
    if (!searchQuery.value) return [];

    const query = searchQuery.value.toLowerCase();
    return allCategories.value.filter(category =>
        category && category.name && category.name.toLowerCase().includes(query)
    ).slice(0, 3); // Limit to 3 results
});

// Mock user data - in a real app, this would come from auth
const user = {
    name: 'Guest User'
};

const userInitials = computed(() => {
    if (!user.name) return 'G';
    return user.name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
});

// Debounced search handler
const handleSearch = debounce(() => {
    if (searchQuery.value.length > 1) {
        showSearchResults.value = true;
    } else {
        showSearchResults.value = false;
    }
}, 300);

// Clear search when navigating
const clearSearch = () => {
    searchQuery.value = '';
    showSearchResults.value = false;
};

// Handle image loading errors
const handleImageError = (e) => {
    e.target.src = '/img/placeholder.png';
};

// Close search results when clicking outside
watch(() => searchQuery.value, (newVal) => {
    if (!newVal) {
        showSearchResults.value = false;
    }
});
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s, transform 0.2s;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}
</style>
