<template>
    <div>
        <div class="container py-8 mx-auto max-w-7xl">
            <div class="grid grid-cols-4 gap-6 px-4 sm:grid-cols-12 ">
                <div class="col-span-4 bg-gray-800 rounded-md shadow-2xl sm:col-span-3 shadow-black">
                    <div class="relative px-4 py-2 bg-gray-700 rounded-md">
                        <div class="absolute flex space-x-2 left-4">
                            <div class="w-3 h-3 p-2 mt-2 bg-red-500 rounded-full"></div>
                            <div class="w-3 h-3 p-2 mt-2 bg-yellow-500 rounded-full"></div>
                            <div class="w-3 h-3 p-2 mt-2 bg-green-500 rounded-full"></div>
                        </div>
                        <div class="text-white text-[14px] text-center">Profile.php</div>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-col items-center">
                            <img src="img/profile.jpg"
                                class="w-40 h-40 mb-6 transition-transform duration-300 bg-gray-300 rounded-full shadow-xl shrink-0 ring-4 ring-blue-500 hover:scale-105"
                                alt="Mohamed Aslam's profile picture">
                            <h1 class="mb-2 text-xl font-bold text-white">Mohamed Aslam</h1>
                            <p class="px-4 py-1 text-sm text-blue-400 bg-blue-900 rounded-full">Backend Engineer</p>
                            <div class="flex flex-wrap justify-center gap-4 mt-8">
                                <a href="#"
                                    class="px-6 py-2 text-white transition duration-300 ease-in-out transform bg-blue-600 rounded-full shadow-lg hover:bg-blue-700 hover:scale-105 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                    Contact Me
                                </a>
                                <a href="#"
                                    class="px-6 py-2 text-white transition duration-300 ease-in-out transform bg-gray-700 rounded-full shadow-lg hover:bg-gray-600 hover:scale-105 focus:ring-2 focus:ring-gray-400 focus:outline-none">
                                    Download CV
                                </a>
                            </div>
                        </div>
                        <h3 class="mt-6 mb-4 font-semibold text-center text-gray-300">
                            Find me on
                        </h3>
                        <div class="flex items-center justify-center gap-6 my-6">
                            <a class="text-white hover:text-blue-600" aria-label="Visit GitHub Profile"
                                href="https://github.com/aslamwebz" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" class="h-6">
                                    <path fill="currentColor"
                                        d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z" />
                                </svg>
                            </a>
                            <a class="text-white hover:text-orange-600" aria-label="Visit TrendyMinds LinkedIn"
                                href="https://www.linkedin.com/in/emaslam/" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-6">
                                    <path fill="currentColor"
                                        d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z">
                                    </path>
                                </svg>
                            </a>

                        </div>
                        <hr class="my-6 border-t border-gray-300">

                    </div>
                </div>
                <div class="col-span-4 sm:col-span-9 ">
                    <div class="bg-gray-800 rounded-md shadow-2xl shadow-black">
                        <div class="relative px-4 py-2 bg-gray-700 rounded-t-lg">
                            <div class="absolute flex space-x-2 left-4">
                                <div class="w-3 h-3 p-2 mt-2 bg-red-500 rounded-full"></div>
                                <div class="w-3 h-3 p-2 mt-2 bg-yellow-500 rounded-full"></div>
                                <div class="w-3 h-3 p-2 mt-2 bg-green-500 rounded-full"></div>
                            </div>
                            <div class="text-white text-[14px] text-center">aboutMe.php</div>
                        </div>
                        <div class="p-12 text-lg text-white bg-gray-800 rounded-md">
                            <h2 class="mb-6 text-3xl font-bold text-blue-400">About Me</h2>
                            <div class="space-y-6 text-base leading-relaxed text-gray-400">
                                <p>
                                    👋 Hi there! I'm Mohamed Aslam, a passionate Backend Engineer with a deep
                                    fascination for AI, automation, and building robust web solutions. I specialize in
                                    crafting high-performance applications using PHP, Laravel, Vue.js, and RESTful APIs.
                                </p>

                                <p>
                                    🔧 My expertise lies in:
                                </p>
                                <ul class="ml-6 space-y-2 list-disc">
                                    <li>Backend Development (PHP, Laravel)</li>
                                    <li>Frontend Development (Vue.js, TailwindCSS)</li>
                                    <li>API Development & Integration</li>
                                    <li>Database Design & Optimization</li>
                                    <li>AI Integration & Automation</li>
                                </ul>

                                <p>
                                    🤖 I'm currently exploring the exciting intersection of AI and web development,
                                    working on:
                                </p>
                                <ul class="ml-6 space-y-2 list-disc">
                                    <li>AI-powered automation solutions</li>
                                    <li>LLM integrations for enhanced functionality</li>
                                    <li>Intelligent workflow optimizations</li>
                                </ul>

                                <p>
                                    💡 I believe in writing clean, maintainable code and building scalable solutions
                                    that make a real impact. Whether it's optimizing database queries, implementing
                                    complex business logic, or creating intuitive user experiences, I'm always up for a
                                    challenge.
                                </p>

                                <p class="pt-4 font-semibold text-blue-400">
                                    Ready to collaborate on your next project? Let's create something amazing together!
                                    🚀
                                </p>
                            </div>
                        </div>
                        <!-- <Resume /> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Resume from "@/Pages/Components/Resume.vue";
</script>

<style scoped></style>
