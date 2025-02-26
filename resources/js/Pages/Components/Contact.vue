<template>
    <section class="container mx-auto py-16 max-w-screen-xl">
        <div class="p-8 bg-gray-800 rounded-md shadow-2xl shadow-black">
            <div class="px-4 py-8 mx-auto text-center">
                <h2 class="mb-4 text-5xl font-bold text-white">Get In Touch</h2>
                <p class="text-lg text-gray-400 mb-12">
                    Have a project in mind or want to discuss opportunities? Feel free to reach out!
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-gray-900 p-8 rounded-xl shadow-lg">
                    <form @submit.prevent="submitForm" class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Name</label>
                            <input type="text" id="name" v-model="form.name"
                                   class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-white"
                                   placeholder="Your name">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                            <input type="email" id="email" v-model="form.email"
                                   class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-white"
                                   placeholder="your.email@example.com">
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-300 mb-1">Subject</label>
                            <input type="text" id="subject" v-model="form.subject"
                                   class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-white"
                                   placeholder="What's this about?">
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-300 mb-1">Message</label>
                            <textarea id="message" v-model="form.message" rows="5"
                                      class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-white"
                                      placeholder="Your message here..."></textarea>
                        </div>

                        <button type="submit"
                                class="w-full px-6 py-3 text-white font-medium rounded-lg bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all duration-300">
                            Send Message
                        </button>
                    </form>
                </div>

                <!-- Contact Information -->
                <div class="bg-gray-900 p-8 rounded-xl shadow-lg flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-6">Contact Information</h3>

                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full bg-blue-600 text-white">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-white">Email</h4>
                                    <p class="text-gray-400">contact@yourdomain.com</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full bg-green-600 text-white">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-white">Location</h4>
                                    <p class="text-gray-400">Remote - Worldwide</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full bg-purple-600 text-white">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-white">Working Hours</h4>
                                    <p class="text-gray-400">Monday - Friday: 9am - 6pm</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-lg font-medium text-white mb-4">Connect with me</h4>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-800 text-white hover:bg-blue-600 transition-colors duration-300">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-800 text-white hover:bg-gray-700 transition-colors duration-300">
                                <i class="fab fa-github"></i>
                            </a>
                            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-800 text-white hover:bg-blue-400 transition-colors duration-300">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-800 text-white hover:bg-red-600 transition-colors duration-300">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { reactive } from 'vue';

const form = reactive({
    name: '',
    email: '',
    subject: '',
    message: ''
});

const submitForm = () => {
    // Here you would typically send the form data to your backend
    console.log('Form submitted:', form);

    // Reset form after submission
    form.name = '';
    form.email = '';
    form.subject = '';
    form.message = '';

    // Show success message (you could implement a toast notification here)
    alert('Thank you for your message! I will get back to you soon.');
};
</script>
