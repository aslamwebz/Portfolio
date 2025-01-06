<template>
    <Disclosure as="nav" class="sticky top-0 bg-white z-50" v-slot="{ open }">
        <div class="px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between nav" :style="{ height: navbarHeight + 'rem' }">
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
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start mx-[10%]  w-full">
                    <div class="flex items-center flex-shrink-0">
                        <span class="text-[40px] font-bold">
                            M Aslam
                        </span>
                    </div>
                    <div class="hidden sm:block ml-auto">
                        <div class="flex space-x-4 p-3">
                            <a v-for="item in navigation" :key="item.name" :href="item.href"
                                :class="[item.current ? 'bg-gray-900 text-white' : 'text-black hover:text-[#f39c12]', 'rounded-md px-3 py-2 text-[19px] font-medium']"
                                :aria-current="item.current ? 'page' : undefined">{{ item.name }}</a>
                            <div class="right-0">
                                <Button @click="download" download
                                    class="px-4 py-2 font-normal tracking-wide text-white transition duration-200 ease-in-out rounded-full outline-none text-nowrap bg-gradient-to-b from-blue-600 to-blue-700 focus:outline-none hover:shadow-lg hover:from-blue-700">
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

const scrollY = ref(0);
const defaultHeight = 6; // default height of the navbar
const scrolledHeight = 8;  // height of the navbar when scrolled


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
    { name: 'Dashboard', href: '#', current: true },
    { name: 'Team', href: '#', current: false },
    { name: 'Projects', href: '#', current: false },
    { name: 'Contact', href: '#contact', current: false },
]

function handleScroll() {
    scrollY.value = window.scrollY;
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
        link.download = 'test.pdf'
        link.click()
    });
}

</script>

<style scoped>
.nav {
    transition: height 0.3s ease;
}
</style>
