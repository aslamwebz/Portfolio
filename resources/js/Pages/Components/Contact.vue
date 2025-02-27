<template>
    <section class="container max-w-screen-xl py-16 mx-auto">
        <div class="p-8 bg-gray-800 rounded-md shadow-2xl shadow-black">
            <div class="px-4 py-8 mx-auto text-center">
                <h2 class="mb-4 text-4xl font-bold text-white">Get In Touch</h2>
                <p class="mb-12 text-base text-gray-400">
                    Have a project in mind or want to discuss opportunities? Feel free to reach out!
                </p>
            </div>

            <div class="grid grid-cols-1 gap-12 md:grid-cols-2">
                <!-- Contact Form -->
                <div class="p-8 bg-gray-900 shadow-lg rounded-xl">
                    <form @submit.prevent="submitForm" class="space-y-6">
                        <div>
                            <label for="name" class="block mb-1 text-sm font-medium text-gray-300">Name</label>
                            <input type="text" id="name" v-model="form.name"
                                class="w-full px-4 py-3 text-white bg-gray-800 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                :class="{'border-red-500': errors.name, 'border-gray-700': !errors.name}"
                                placeholder="Your name">
                            <p v-if="errors.name" class="mt-1 text-sm text-red-500">{{ errors.name }}</p>
                        </div>

                        <div>
                            <label for="email" class="block mb-1 text-sm font-medium text-gray-300">Email</label>
                            <input type="email" id="email" v-model="form.email"
                                class="w-full px-4 py-3 text-white bg-gray-800 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                :class="{'border-red-500': errors.email, 'border-gray-700': !errors.email}"
                                placeholder="your.email@example.com">
                            <p v-if="errors.email" class="mt-1 text-sm text-red-500">{{ errors.email }}</p>
                        </div>

                        <div>
                            <label for="subject" class="block mb-1 text-sm font-medium text-gray-300">Subject</label>
                            <input type="text" id="subject" v-model="form.subject"
                                class="w-full px-4 py-3 text-white bg-gray-800 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                :class="{'border-red-500': errors.subject, 'border-gray-700': !errors.subject}"
                                placeholder="What's this about?">
                            <p v-if="errors.subject" class="mt-1 text-sm text-red-500">{{ errors.subject }}</p>
                        </div>

                        <div>
                            <label for="message" class="block mb-1 text-sm font-medium text-gray-300">Message</label>
                            <textarea id="message" v-model="form.message" rows="5"
                                class="w-full px-4 py-3 text-white bg-gray-800 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                :class="{'border-red-500': errors.message, 'border-gray-700': !errors.message}"
                                placeholder="Your message here..."></textarea>
                            <p v-if="errors.message" class="mt-1 text-sm text-red-500">{{ errors.message }}</p>
                        </div>

                        <button type="submit"
                            class="w-full px-6 py-3 font-medium text-white transition-all duration-300 rounded-lg bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900"
                            :disabled="isSubmitting">
                            <span v-if="isSubmitting">
                                <svg class="inline-block w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Sending...
                            </span>
                            <span v-else>Send Message</span>
                        </button>
                    </form>
                </div>

                <!-- Contact Information -->
                <div class="flex flex-col justify-between p-8 bg-gray-900 shadow-lg rounded-xl">
                    <div>
                        <h3 class="mb-6 text-xl font-bold text-white">Contact Information</h3>

                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div
                                    class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-blue-600 rounded-full">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-white">Email</h4>
                                    <p class="text-gray-400">aslam4webz@gmail.com</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-green-600 rounded-full">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-white">Location</h4>
                                    <p class="text-gray-400">Remote - Worldwide</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-purple-600 rounded-full">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-white">Working Hours</h4>
                                    <p class="text-gray-400">Flexible Working Hours</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="mb-4 text-lg font-medium text-white">Connect with me</h4>
                        <div class="flex space-x-4">
                            <a href="https://www.linkedin.com/in/emaslam/" target="_blank"
                                class="flex items-center justify-center w-10 h-10 text-white transition-colors duration-300 bg-gray-800 rounded-full hover:bg-blue-600">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="https://github.com/aslamwebz" target="_blank"
                                class="flex items-center justify-center w-10 h-10 text-white transition-colors duration-300 bg-gray-800 rounded-full hover:bg-gray-700">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success message -->
            <div v-if="showSuccess" class="fixed inset-0 z-50 flex items-center justify-center">
                <div class="absolute inset-0 bg-black bg-opacity-50" @click="showSuccess = false"></div>
                <div class="relative z-10 max-w-md p-8 mx-auto bg-white rounded-lg">
                    <button @click="showSuccess = false" class="absolute text-gray-500 top-2 right-2 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div class="text-center">
                        <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-green-100 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-lg font-medium text-gray-900">Message Sent!</h3>
                        <p class="text-gray-500">Thank you for reaching out. I'll get back to you as soon as possible.</p>
                        <button @click="showSuccess = false" class="px-4 py-2 mt-6 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { reactive, ref } from 'vue';

const form = reactive({
    name: '',
    email: '',
    subject: '',
    message: ''
});

const errors = reactive({
    name: '',
    email: '',
    subject: '',
    message: ''
});

const isSubmitting = ref(false);
const showSuccess = ref(false);

const validateForm = () => {
    let valid = true;

    // Reset errors
    errors.name = '';
    errors.email = '';
    errors.subject = '';
    errors.message = '';

    if (!form.name.trim()) {
        errors.name = 'Name is required';
        valid = false;
    }

    if (!form.email.trim()) {
        errors.email = 'Email is required';
        valid = false;
    } else if (!/^\S+@\S+\.\S+$/.test(form.email)) {
        errors.email = 'Please enter a valid email address';
        valid = false;
    }

    if (!form.subject.trim()) {
        errors.subject = 'Subject is required';
        valid = false;
    }

    if (!form.message.trim()) {
        errors.message = 'Message is required';
        valid = false;
    }

    return valid;
};

const submitForm = async () => {
    if (!validateForm()) return;

    isSubmitting.value = true;

    try {
        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 1500));

        // Reset form
        form.name = '';
        form.email = '';
        form.subject = '';
        form.message = '';

        // Show success message
        showSuccess.value = true;
    } catch (error) {
        console.error('Error submitting form:', error);
        // Handle error (show error message)
    } finally {
        isSubmitting.value = false;
    }
};
</script>
