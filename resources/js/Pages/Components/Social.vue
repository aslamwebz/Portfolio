<template>
    <div>
        <section id="my-skills" class="mb-4">
            <div>
                <div class="skills-content" @mouseover="hover = true" @mouseleave="hover = false">
                    <transition name="icon-bounce">
                        <div class="flex justify-center text-center">
                            <a href="https://www.linkedin.com/in/emaslam/" target="_blank"
                                class="flex items-center justify-center w-10 h-10 mr-2 text-white transition-colors duration-300 bg-gray-800 rounded-full hover:bg-blue-600">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="https://github.com/aslamwebz" target="_blank"
                                class="flex items-center justify-center w-10 h-10 text-white transition-colors duration-300 bg-gray-800 rounded-full hover:bg-gray-700">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </transition>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>

</script>

<style scoped>
.icon-bounce-enter-active,
.icon-bounce-leave-active {
    transition: transform 0.5s;
}

.icon-bounce-enter,
.icon-bounce-leave-to

/* .icon-bounce-leave-active in <2.1.8 */
    {
    color: black;
}
</style>
