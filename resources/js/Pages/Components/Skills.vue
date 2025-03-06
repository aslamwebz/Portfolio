<template>
    <section class="container max-w-screen-xl py-12 mx-auto">
        <div class="p-6 bg-gray-800 rounded-md shadow-2xl shadow-black">
            <div class="px-4 py-6 mx-auto text-center">
                <h2 class="mb-4 text-xl font-bold text-white">Technical Skills</h2>
                <p class="mb-8 text-xs text-gray-400">
                    Here are the technologies and tools I specialize in
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <!-- Frontend Skills -->
                <div class="p-6 bg-gray-900 shadow-lg rounded-xl">
                    <h3 class="flex items-center mb-6 text-base font-bold text-white">
                        <i class="mr-3 text-blue-500 fas fa-laptop-code"></i> Frontend
                    </h3>
                    <div class="space-y-4">
                        <SkillBar name="JavaScript" :percentage="85" color="yellow" />
                        <SkillBar name="Livewire" :percentage="90" color="red" />
                        <SkillBar name="Vue.js" :percentage="90" color="green" />
                        <SkillBar name="HTML/CSS" :percentage="90" color="blue" />
                        <SkillBar name="Tailwind CSS" :percentage="85" color="cyan" />
                    </div>
                </div>

                <!-- Backend Skills -->
                <div class="p-6 bg-gray-900 shadow-lg rounded-xl">
                    <h3 class="flex items-center mb-6 text-base font-bold text-white">
                        <i class="mr-3 text-purple-500 fas fa-server"></i> Backend
                    </h3>
                    <div class="space-y-4">
                        <SkillBar name="PHP" :percentage="90" color="purple" />
                        <SkillBar name="Laravel" :percentage="90" color="red" />
                        <SkillBar name="MySQL" :percentage="75" color="blue" />
                    </div>
                </div>

                <!-- AI & Tools Skills -->
                <div class="p-6 bg-gray-900 shadow-lg rounded-xl">
                    <h3 class="flex items-center mb-6 text-base font-bold text-white">
                        <i class="mr-3 text-pink-500 fas fa-brain"></i> AI & Tools
                    </h3>
                    <div class="space-y-4">
                        <SkillBar name="Git/GitHub" :percentage="90" color="purple" />
                        <SkillBar name="Python" :percentage="50" color="blue" />
                        <SkillBar name="Crew AI" :percentage="50" color="orange" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import SkillBar from '@/Pages/Components/Skills/SkillBar.vue';
</script>

<style scoped>
.skill-item {
    font-size: 40px;
    height: 70px;
    width: 70px;
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
