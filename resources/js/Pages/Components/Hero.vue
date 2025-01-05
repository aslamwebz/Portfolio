<template>
    <div class="container grid min-h-screen grid-cols-1 gap-6 px-6 mx-auto mt-[80px] md:grid-cols-3">
      <div class="col-span-1 flex flex-col items-center justify-center">
        <img src="img/profile.png" alt="Mohamed Aslam" class="w-48 h-48 rounded-full shadow-lg">
        <Social />
      </div>
      <div class="col-span-2 flex flex-col justify-center px-4 py-8 text-center md:text-left">
        <div class="text-2xl font-semibold text-gradient leading-none from-blue-500 to-purple-500">
          Greetings! 👋 I'm
        </div>
        <div class="text-6xl font-bold text-white leading-tight mt-2">
          Mohamed Aslam
        </div>
        <div class="pt-2 text-3xl font-medium text-gray-300">
          Backend / Full Stack Developer
        </div>
        <div class="mt-6 mb-8 text-lg font-light text-gray-400">
          Empowering technology with precision and creativity. I specialize in crafting robust back-end solutions and seamless full-stack experiences. Let’s build the future together—one line of code at a time. 🚀
        </div>
        <div class="flex justify-center md:justify-start">
          <a href="#contact" class="px-8 py-3 text-lg font-medium text-white bg-gradient-to-r from-indigo-600 to-blue-500 rounded-full shadow-lg transition transform hover:scale-105 hover:shadow-xl focus:outline-none">
            Contact Me
          </a>
        </div>
        <Skills />
      </div>
    </div>
  </template>

  <script setup>
  import Skills from "@/Pages/Components/Skills.vue";
  import Social from "@/Pages/Components/Social.vue";
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
