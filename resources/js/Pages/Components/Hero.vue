<template>
    <div >
        <HeroBackground />
        <div class="min-h-screen px-6 mx-auto">
            <div class="flex flex-col items-center">
                <img src="img/profile.gif" alt="Mohamed Aslam">
                <Social />
                <div class="text-2xl font-semibold text-gradient leading-none from-blue-500 to-purple-500">
                    Greetings! 👋 I'm
                </div>
                <div class="text-5xl font-bold leading-tight">
                    Mohamed Aslam
                </div>
                <CodeTerminal />
                <div class="mt-8">
                    <a href="#contact"
                        class="px-8 py-3 text-lg font-medium text-white bg-gradient-to-r from-indigo-600 to-blue-500 rounded-full shadow-lg transition transform hover:scale-105 hover:shadow-xl focus:outline-none">
                        Contact Me
                    </a>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import Skills from "@/Pages/Components/Skills.vue";
import Social from "@/Pages/Components/Social.vue";
import HeroBackground from "@/Pages/Components/Hero/HeroBackground.vue";
import CodeTerminal from "@/Pages/Components/Hero/CodeTerminal.vue";

</script>

<style scoped>
.text-gradient {
    background: linear-gradient(90deg, var(--tw-gradient-stops));
    --tw-gradient-from: #60a5fa;
    --tw-gradient-to: #818cf8;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
</style>
