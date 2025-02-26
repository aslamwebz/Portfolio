<template>
    <section class="container mx-auto py-16 max-w-screen-xl">
        <div class="p-8 bg-gray-800 rounded-md shadow-2xl shadow-black">
            <div class="px-4 py-8 mx-auto text-center">
                <h2 class="mb-4 text-5xl font-bold text-white">Technical Skills</h2>
                <p class="text-lg text-gray-400 mb-12">
                    Here are the technologies and tools I specialize in
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Frontend Skills -->
                <div class="bg-gray-900 p-6 rounded-xl shadow-lg">
                    <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-laptop-code text-blue-500 mr-3"></i> Frontend
                    </h3>
                    <div class="space-y-4">
                        <SkillBar name="Vue.js" :percentage="90" color="green" />
                        <SkillBar name="JavaScript" :percentage="85" color="yellow" />
                        <SkillBar name="HTML/CSS" :percentage="90" color="blue" />
                        <SkillBar name="Tailwind CSS" :percentage="85" color="cyan" />
                        <SkillBar name="React" :percentage="70" color="blue" />
                    </div>
                </div>

                <!-- Backend Skills -->
                <div class="bg-gray-900 p-6 rounded-xl shadow-lg">
                    <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-server text-purple-500 mr-3"></i> Backend
                    </h3>
                    <div class="space-y-4">
                        <SkillBar name="PHP" :percentage="95" color="purple" />
                        <SkillBar name="Laravel" :percentage="90" color="red" />
                        <SkillBar name="Node.js" :percentage="75" color="green" />
                        <SkillBar name="MySQL" :percentage="85" color="blue" />
                        <SkillBar name="API Development" :percentage="90" color="indigo" />
                    </div>
                </div>

                <!-- Other Skills -->
                <div class="bg-gray-900 p-6 rounded-xl shadow-lg">
                    <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-tools text-amber-500 mr-3"></i> Tools & Others
                    </h3>
                    <div class="space-y-4">
                        <SkillBar name="Git/GitHub" :percentage="90" color="orange" />
                        <SkillBar name="Docker" :percentage="80" color="blue" />
                        <SkillBar name="CI/CD" :percentage="75" color="green" />
                        <SkillBar name="AWS" :percentage="70" color="yellow" />
                        <SkillBar name="System Admin" :percentage="85" color="gray" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import SkillBar from './Skills/SkillBar.vue';
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
