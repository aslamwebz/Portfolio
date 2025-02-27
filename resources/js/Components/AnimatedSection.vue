<template>
    <div ref="sectionRef" :class="{ 'opacity-0 translate-y-10': !isVisible, 'transition-all duration-1000 ease-out': true }">
        <slot></slot>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const sectionRef = ref(null);
const isVisible = ref(false);

onMounted(() => {
    const observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
            isVisible.value = true;
            observer.disconnect();
        }
    }, { threshold: 0.1 });

    observer.observe(sectionRef.value);
});
</script>
