<template>
    <Disclosure as="nav" class="sticky top-6 z-50" v-slot="{ open }">
        <div class="navbar transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)]">
            <div class="relative flex items-center justify-between nav px-6 max-w-5xl mx-auto w-[90%] sm:w-[85%]" :class="{ 'bg-white/90 backdrop-blur-md shadow-[0_4px_30px_rgba(0,120,255,0.08)] rounded-full border border-gray-200/50': isScrolled }"
                :style="{ height: navbarHeight + 'rem' }">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden ">
                    <!-- Mobile menu button-->
                    <DisclosureButton
                        class="relative inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <span class="absolute -inset-0.5" />
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon v-if="!open" class="block w-6 h-6" aria-hidden="true" />
                        <XMarkIcon v-else class="block w-6 h-6" aria-hidden="true" />
                    </DisclosureButton>
                </div>
                <div class="flex flex-1 items-center justify-between w-full">
                    <div class="flex items-center flex-shrink-0 px-2">
                        <span class="text-[30px] font-bold">
                            M Aslam
                        </span>
                    </div>
                    <div class="hidden sm:flex items-center">
                        <div class="flex space-x-3">
                            <a v-for="item in navigation" :key="item.name" :href="item.href"
                                :class="[item.current ? 'bg-gray-900 text-white' : 'text-black hover:text-[#f39c12]', 'rounded-md px-3 py-2 text-[16px] font-medium']"
                                :aria-current="item.current ? 'page' : undefined">{{ item.name }}</a>
                            <div class="ml-6">
                                <Button @click="download" download
                                    class="px-4 py-2 text-[14px] tracking-wide text-white transition duration-200 ease-in-out rounded-full outline-none text-nowrap bg-gradient-to-b from-blue-600 to-blue-700 focus:outline-none hover:shadow-lg hover:from-blue-700">
                                    Download My Resume
                                </Button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <DisclosurePanel class="sm:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <DisclosureButton v-for="item in navigation" :key="item.name" as="a" :href="item.href"
                    :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'block rounded-md px-3 py-2 text-base font-medium']"
                    :aria-current="item.current ? 'page' : undefined">{{ item.name }}</DisclosureButton>
            </div>
        </DisclosurePanel>
    </Disclosure>
</template>

<script setup>
import { ref, onBeforeMount, onBeforeUnmount, computed } from 'vue';
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { Bars3Icon, BellIcon, XMarkIcon } from '@heroicons/vue/24/outline'

// Can change the height of the navbar when scrolled
const scrollY = ref(0);
const defaultHeight = 4.5; // default height of the navbar
const scrolledHeight = 4.5;  // height of the navbar when scrolled


onBeforeMount(() => {
    window.addEventListener('scroll', handleScroll)
})

onBeforeUnmount(() => {
    window.removeEventListener('scroll', handleScroll);
});

const navbarHeight = computed(() => {
    return scrollY.value > 50 ? scrolledHeight : defaultHeight;
});

const navigation = [
    { name: 'Home', href: '#', current: true },
    { name: 'About', href: '#about', current: false },
    { name: 'Projects', href: '#projects', current: false },
    { name: 'Contact', href: '#contact', current: false },
]

const isScrolled = ref(false);

function handleScroll() {
    scrollY.value = window.scrollY;
    isScrolled.value = window.scrollY > 50;
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
}

function download() {
    axios({
        url: 'api/resume/download',
        method: 'GET',
        responseType: 'arraybuffer',
    }).then((response) => {
        console.log(response)
        let blob = new Blob([response.data], {
            type: 'application/pdf'
        })
        let link = document.createElement('a')
        link.href = window.URL.createObjectURL(blob)
        link.download = 'M Aslam Resume.pdf'
        link.click()
    });
}

</script>

<style scoped>
.navbar {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    margin: 0.75rem auto;
    max-width: 100%;
    will-change: transform, box-shadow, background;
}

.navbar.scrolled {
    margin: 0.5rem auto;
}

@media (max-width: 640px) {
    .navbar, .navbar.scrolled {
        margin: 0.5rem auto;
        width: calc(100% - 2rem) !important;
        max-width: 100% !important;
    }
}

.nav {
    transition: height 0.3s ease;
}

/* Removed HR when scrolled */
</style>
