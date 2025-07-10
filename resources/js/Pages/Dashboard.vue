<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Hero from "@/Pages/Components/Hero.vue";
import About from "@/Pages/Components/About.vue";
import Projects from './Components/Projects.vue';
import Services from './Components/Services.vue';
import Skills from './Components/Skills.vue';
import Resume from './Components/Resume.vue';
import Contact from './Components/Contact.vue';
import Footer from './Components/Footer.vue';
import { ref, onMounted, onUnmounted } from 'vue';

// For scroll to top functionality
const showScrollTop = ref(false);

// Function to scroll to top smoothly
const scrollToTop = () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
};

// Function to check scroll position and show/hide button
const handleScroll = () => {
    showScrollTop.value = window.scrollY > 300;
};

// For AI works popup
const showAIPopup = ref(false);
const dismissedAIPopup = ref(false);

// Show AI popup after a delay
const showAIPopupWithDelay = () => {
    setTimeout(() => {
        if (!dismissedAIPopup.value) {
            showAIPopup.value = true;
        }
    }, 3000); // Show after 3 seconds
};

// Close AI popup
const closeAIPopup = () => {
    showAIPopup.value = false;
    dismissedAIPopup.value = true;
};

// Navigate to AI works page
const goToAIWorks = () => {
    // Replace with your actual navigation logic
    window.location.href = '/ai';
    closeAIPopup();
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);

    // Add smooth scrolling to the entire document
    document.documentElement.style.scrollBehavior = 'smooth';

    // Show AI popup after delay
    showAIPopupWithDelay();
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div>
            <!-- Hero section -->
            <Hero id="hero" />

            <!-- About section -->
            <About id="about" />

            <!-- Projects section -->
            <Projects id="projects" />

            <!-- Services section -->
            <Services id="services" />

            <!-- Skills section -->
            <Skills id="skills" />

            <!-- Resume section -->
            <Resume id="resume" />

            <!-- Contact section -->
            <Contact id="contact" />

            <!-- Footer section -->
            <Footer />

            <!-- Scroll to top button -->
            <button v-if="showScrollTop" @click="scrollToTop" class="scroll-to-top">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
            </button>

            <!-- AI Works Popup - Hidden on mobile -->
            <div v-if="showAIPopup" class="ai-popup hidden sm:block">
                <button @click="closeAIPopup" class="ai-popup-close">&times;</button>
                <div class="ai-popup-content">
                    <div class="ai-popup-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <div class="ai-popup-message">Check out my AI projects!</div>
                    <button @click="goToAIWorks" class="ai-popup-button">View AI Works</button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.scroll-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    border: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    z-index: 1000;
}

.scroll-to-top:hover {
    background-color: rgba(0, 0, 0, 0.9);
    transform: translateY(-3px);
}

/* Add animation for the button appearance */
@keyframes fadeIn {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

.scroll-to-top {
    animation: fadeIn 0.3s ease-in-out;
}

/* AI Popup Styles */
.ai-popup {
    position: fixed;
    bottom: 30px;
    left: 30px;
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
    padding: 20px;
    z-index: 1000;
    max-width: 280px;
    animation: slideIn 0.5s ease-out;
}

@keyframes slideIn {
    from {
        transform: translateY(100px);
        opacity: 0;
    }

    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.ai-popup-close {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: #666;
    padding: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.ai-popup-close:hover {
    background-color: #f0f0f0;
    color: #333;
}

.ai-popup-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.ai-popup-icon {
    margin-bottom: 12px;
    color: #3b82f6;
    background-color: #eff6ff;
    padding: 12px;
    border-radius: 50%;
}

.ai-popup-message {
    font-weight: 600;
    margin-bottom: 15px;
    color: #333;
}

.ai-popup-button {
    background-color: #3b82f6;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    transition: background-color 0.2s;
}

.ai-popup-button:hover {
    background-color: #2563eb;
}
</style>
