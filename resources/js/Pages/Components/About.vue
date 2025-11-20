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
                                <a href="#contact"
                                   class="px-6 py-2 text-white transition duration-300 ease-in-out transform bg-blue-600 rounded-full shadow-lg hover:bg-blue-700 hover:scale-105 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                    Contact Me
                                </a>
                                <a href="/api/resume/download"
                                   class="px-6 py-2 text-white transition duration-300 ease-in-out transform bg-gray-700 rounded-full shadow-lg hover:bg-gray-600 hover:scale-105 focus:ring-2 focus:ring-gray-400 focus:outline-none">
                                    Download CV
                                </a>
                            </div>
                        </div>

                        <h3 class="mt-6 mb-4 font-semibold text-center text-gray-300">Find me on</h3>

                        <div class="flex items-center justify-center gap-6 my-6">
                            <!-- GitHub -->
                            <a class="text-white hover:text-blue-600" aria-label="Visit GitHub Profile"
                               href="https://github.com/aslamwebz" target="_blank">
                               <!-- svg unchanged -->
                            </a>

                            <!-- LinkedIn -->
                            <a class="text-white hover:text-orange-600" aria-label="Visit LinkedIn"
                               href="https://www.linkedin.com/in/emaslam/" target="_blank">
                               <!-- svg unchanged -->
                            </a>
                        </div>

                        <hr class="my-6 border-t border-gray-300">

                    </div>
                </div>

                <!-- Right Column -->
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
                                    👋 Hi there! I'm Mohamed Aslam — a backend-focused Laravel engineer who builds
                                    full-featured, scalable web applications from the ground up.
                                </p>

                                <p>
                                    I specialize in designing reliable backend systems using
                                    <strong>PHP, Laravel, RESTful APIs, authentication flows, and efficient database structures</strong>.
                                    My work centers on creating production-ready applications that handle real users,
                                    real traffic, and real business needs.
                                </p>

                                <p>🔧 My core expertise includes:</p>
                                <ul class="ml-6 space-y-2 list-disc">
                                    <li>Backend Engineering (PHP, Laravel)</li>
                                    <li>TALL Stack — Tailwind, Alpine.js, Laravel, Livewire</li>
                                    <li>Frontend familiarity with Vue.js, Inertia.js, and React</li>
                                    <li>Authentication, authorization & secure data flow</li>
                                    <li>Dashboards & CMS systems (Nova, Filament)</li>
                                    <li>Payments, notifications & real-time integrations</li>
                                </ul>

                                <p>
                                    I enjoy taking projects from requirements to deployment — turning ideas into
                                    well-structured backend systems with clean architecture and maintainable code.
                                </p>

                                <p class="pt-4 font-semibold text-blue-400">
                                    If you're looking for someone who can deliver robust Laravel applications with clarity,
                                    precision, and long-term maintainability — let's connect! 🚀
                                </p>

                            </div>
                        </div>

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
