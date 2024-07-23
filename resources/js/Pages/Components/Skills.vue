<template>
    <div>
        <section id="my-skills" class="section-padding py-[55px] px-[5px]">
            <div class="container">
                <div class="row">
                    <div>
                        <div class="section-title text-[50px] text-center my-[50px]">
                            <h2>Professional Skills</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <div class="skills-content" @mouseover="hover = true" @mouseleave="hover = false">
                    <transition name="icon-bounce">
                        <div class="md:flex justify-between w-full">
                            <SkillItem v-for="skill in skills" :key="skill.skillName" :iconClass="skill.iconClass"
                                :skillName="skill.skillName" />
                        </div>
                    </transition>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>

import SkillItem from './SkillItem.vue';
import { ref } from 'vue';

const skills = ref(
    [
        { iconClass: 'fa-brands fa-laravel', skillName: 'Laravel' },
        { iconClass: 'fa-brands fa-php', skillName: 'PHP' },
        { iconClass: 'fa-solid fa-database', skillName: 'Databases' },
        { iconClass: 'fa-brands fa-js', skillName: 'JavaScript' },
        { iconClass: 'fa-solid fa-j', skillName: 'JQuery' },
        { iconClass: 'fa-brands fa-git', skillName: 'GIT' },
        { iconClass: 'fa-brands fa-bootstrap', skillName: 'BOOTSTRAP' },
        { iconClass: 'fa-brands fa-sass', skillName: 'SASS' },
        { iconClass: 'fa-brands fa-css3-alt', skillName: 'CSS3' },
        { iconClass: 'fa-brands fa-html5', skillName: 'HTML5' },
        { iconClass: 'fa-regular fa-image', skillName: 'Photoshop' }
    ]
);

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
