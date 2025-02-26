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

// Dismiss the AI popup
const dismissAIPopup = () => {
    showAIPopup.value = false;
    dismissedAIPopup.value = true;
};

// Navigate to AI works section
const goToAIWorks = () => {
    // You can replace this with the actual path to your AI works
    window.location.href = '/ai';
    dismissAIPopup();
};

// Add and remove scroll event listener
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
            <Hero />

            <!-- About section -->
            <About />

            <!-- Skills section -->
            <Skills />

            <!-- Projects -->
            <Projects />

            <!-- Services -->
            <Services />

            <!-- Resume -->
            <!-- <Resume /> -->

            <!-- Contact -->
            <Contact />

            <!-- Footer -->
            <Footer />

            <!-- Scroll to top button -->
            <button v-show="showScrollTop" @click="scrollToTop" class="scroll-to-top" aria-label="Scroll to top">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 15l-6-6-6 6" />
                </svg>
            </button>

            <!-- AI Works Popup -->
            <div v-if="showAIPopup" class="ai-popup">
                <button @click="dismissAIPopup" class="ai-popup-close" aria-label="Close popup">×</button>
                <div class="ai-popup-content">
                    <div class="ai-popup-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="10" rx="2" />
                            <circle cx="12" cy="5" r="2" />
                            <path d="M12 7v4" />
                            <line x1="8" y1="16" x2="8" y2="16" />
                            <line x1="16" y1="16" x2="16" y2="16" />
                        </svg>
                    </div>
                    <div class="ai-popup-message">Check out my AI works!</div>
                    <button @click="goToAIWorks" class="ai-popup-button">View Now</button>
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
