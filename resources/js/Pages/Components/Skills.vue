<template>
    <div>
        <section id="my-skills" class="p-6 mt-4">
            <div class="skills-content" @mouseover="hover = true" @mouseleave="hover = false">
                <transition name="icon-bounce">
                    <div class="grid grid-cols-3 gap-4 text-center lg:grid-cols-8">
                        <div class="p-4 font-normal skill-item" v-for="skill in skills">
                            <div class="skill-item-content">
                                <i :class="skill.icon"></i>
                                <p>{{ skill.skillName }}</p>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
        </section>
    </div>
</template>

<script setup>

import { ref } from 'vue';

const skills = ref(
    [
        { icon: 'devicon-laravel-original colored', skillName: 'Laravel' },
        { icon: 'devicon-php-plain colored', skillName: 'PHP' },
        { icon: 'devicon-javascript-plain colored', skillName: 'Javascript' },
        { icon: 'devicon-livewire-plain-wordmark colored', skillName: 'Livewire' },
        { icon: 'devicon-vuejs-plain colored', skillName: 'VueJS' },
        { icon: 'devicon-tailwindcss-original colored', skillName: 'Tailwind Css' },
    ]
);

</script>

<style scoped>
.skill-item {
    font-size: 50px;
    height: 90px;
    width: 90px;
    display: flex;
    align-items: center;
}

.skill-item {
    height: 90px;
    width: 90px;
    position: relative;
    justify-content: center;
}

.skill-item-content>p {
    display: none;
    position: absolute;
    bottom: -50px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 22px;
    font-weight: bold;
    -webkit-transition: .3s;
    transition: .3s;
    /* text-align: center; */
    margin: 0;
}

.skill-item:hover p {
    display: block;
}

.skill-item:hover p {
    display: block;
}

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
