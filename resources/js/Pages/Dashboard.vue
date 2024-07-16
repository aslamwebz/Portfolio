<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Resume from './Components/Resume.vue';
import Services from './Components/Services.vue';
import Footer from './Components/Footer.vue';
import Contact from './Components/Contact.vue'
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-6 context">


            <!-- hero section -->
            <div class="lg:w-2/6 xl:w-2/4 mt-20 lg:mt-30 text-left">
                <div class="text-2xl font-semibold text-[#728afb] leading-none">Greetings! 👋 I'm</div>
                <div class="text-6xl font-semibold text-gray-900 leading-none">Mohamed Aslam</div>
                <div class="text-3xl font-semibold text-gray-900 leading-none">Full Stack developer</div>
                <div class="mt-6 text-xl font-light text-[#9ea2b6] antialiased">Driven by a passion for innovation
                    and backed by years of experience, I specialize in the intricate world of back-end development. From
                    crafting efficient databases to optimizing server-side processes, I'm committed to building the
                    foundation that powers exceptional digital solutions. Let's collaborate and turn your vision into
                    reality!</div>
                <a href="#contact"
                    class="mt-6 px-8 py-4 rounded-full font-normal tracking-wide bg-gradient-to-b from-blue-600 to-blue-700 text-white outline-none focus:outline-none hover:shadow-lg hover:from-blue-700 transition duration-200 ease-in-out">
                    Contact Me
                </a>
            </div>
            <div class="mt-12 lg:mt-32 lg:ml-20 text-left">
                <button type="button"
                    class="flex items-center justify-center w-12 h-12 rounded-full bg-gray-100 text-gray-800 animate-bounce hover:text-gray-900 hover:bg-gray-50 transition duration-300 ease-in-out cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </bottom>
            </div>

            <!-- Services -->
            <Services></Services>

            <!-- Resume Experience Section -->
            <Resume></Resume>

            <!-- Resume Experience Section -->
            <Contact></Contact>
            <!-- Footer -->
            <Footer></Footer>
        </div>
        <div class="area">
            <ul class="circles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div >
    </AuthenticatedLayout>
</template>

<style scoped>
.context {
    width: 100%;
    position: absolute;
    top:50vh;
}

.context h1{
    text-align: center;
    color: #fff;
    font-size: 50px;
}

.area{
    background: linear-gradient(to left, #8f94fb, #4e54c8);
    width: 100%;
    height:100vh;
}

.circles{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.circles li{
    position: absolute;
    display: block;
    list-style: none;
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 0.2);
    animation: animate 25s linear infinite;
    bottom: -150px;

}

.circles li:nth-child(1){
    left: 25%;
    width: 80px;
    height: 80px;
    animation-delay: 0s;
}


.circles li:nth-child(2){
    left: 10%;
    width: 20px;
    height: 20px;
    animation-delay: 2s;
    animation-duration: 12s;
}

.circles li:nth-child(3){
    left: 70%;
    width: 20px;
    height: 20px;
    animation-delay: 4s;
}

.circles li:nth-child(4){
    left: 40%;
    width: 60px;
    height: 60px;
    animation-delay: 0s;
    animation-duration: 18s;
}

.circles li:nth-child(5){
    left: 65%;
    width: 20px;
    height: 20px;
    animation-delay: 0s;
}

.circles li:nth-child(6){
    left: 75%;
    width: 110px;
    height: 110px;
    animation-delay: 3s;
}

.circles li:nth-child(7){
    left: 35%;
    width: 150px;
    height: 150px;
    animation-delay: 7s;
}

.circles li:nth-child(8){
    left: 50%;
    width: 25px;
    height: 25px;
    animation-delay: 15s;
    animation-duration: 45s;
}

.circles li:nth-child(9){
    left: 20%;
    width: 15px;
    height: 15px;
    animation-delay: 2s;
    animation-duration: 35s;
}

.circles li:nth-child(10){
    left: 85%;
    width: 150px;
    height: 150px;
    animation-delay: 0s;
    animation-duration: 11s;
}



@keyframes animate {

    0%{
        transform: translateY(0) rotate(0deg);
        opacity: 1;
        border-radius: 0;
    }

    100%{
        transform: translateY(-1000px) rotate(720deg);
        opacity: 0;
        border-radius: 50%;
    }

}
</style>
