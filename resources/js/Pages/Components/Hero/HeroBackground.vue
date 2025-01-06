<template>
    <div>
        <ul id="scene" ref="scene" data-friction-x="0.1" data-friction-y="0.1" data-scalar-x="25" data-scalar-y="15">
            <li class="layer" data-depth="0.00">
                <div class="depth-0">Foreground</div>
            </li>
            <li class="layer" data-depth="0.20">
                <div class="depth-1 flake1 text-purple-50">
                    <i class="devicon-laravel-original colored"></i>
                </div>
                <div class="depth-1 flake2">
                    <i class="devicon-laravel-original colored"></i>
                </div>
                <div class="depth-1 flake3">
                    <i class="devicon-laravel-original colored"></i>
                </div>
                <div class="depth-1 flake4">
                    <i class="devicon-laravel-original colored"></i>
                </div>
            </li>
            <li class="layer" data-depth="0.40">
                <div class="depth-2 flake1">
                    <i class="devicon-laravel-original colored"></i>
                </div>
                <div class="depth-2 flake2">
                    <i class="devicon-laravel-original colored"></i>
                </div>
            </li>
            <li class="layer" data-depth="0.60">
                <div class="depth-3 flake1">
                    <i class="devicon-laravel-original colored"></i>
                </div>
                <div class="depth-3 flake2">
                    <i class="devicon-laravel-original colored"></i>
                </div>
                <div class="depth-3 flake3">
                    <i class="devicon-laravel-original colored"></i>
                </div>
                <div class="depth-3 flake4">
                    <i class="devicon-laravel-original colored"></i>
                </div>
            </li>
            <li class="layer" data-depth="0.80">
                <div class="depth-4">
                    <i class="devicon-laravel-original colored"></i>
                </div>
            </li>
            <li class="layer" data-depth="1.00">
                <div class="depth-5">
                    <i class="devicon-laravel-original colored"></i>
                </div>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { onMounted, onBeforeUnmount, ref } from "vue";
import Parallax from "parallax-js";
let parallaxInstance = null;

const scene = ref(null); // Reference for the scene element

onMounted(() => {
    // Initialize Parallax when the component mounts
    if (scene.value) {
        parallaxInstance = new Parallax(scene.value, {
            frictionX: 0.1,
            frictionY: 0.1,
            scalarX: 7,
            scalarY: 5,
        });
    }
});

onBeforeUnmount(() => {
    // Clean up the Parallax instance to avoid memory leaks
    if (parallaxInstance) {
        parallaxInstance.destroy();
        parallaxInstance = null;
    }
});
</script>

<style scoped>
#scene {
    width: 100%;
    height: 100vh;
    overflow: hidden;
    position: absolute;
    list-style: none;
    padding: 0;
    margin: 0;
    z-index: -1;
}

.layer {
    position: absolute;
    width: 100%;
    height: 100%;
}

.depth-0,
.depth-1,
.depth-2,
.depth-3,
.depth-4,
.depth-5 {
    position: absolute;
    text-align: center;
    font-size: 1.5rem;
    font-weight: bold;
}

.flake1,
.flake2,
.flake3,
.flake4 {
    position: absolute;
}

.depth-0 {
    top: 49%;
    left: 48%;
    color: #eee;
    font-size: 1em;
}

.depth-1 {
    font-size: 1.3em;
    text-shadow: 0 0 0px rgba(200, 200, 200, 0.5);
}

.depth-1.flake1 {
    left: 30%;
    bottom: 85%;
}

.depth-1.flake2 {
    left: 20%;
    top: 30%;
}

.depth-1.flake3 {
    bottom: 30%;
    right: 25%;
}

.depth-1.flake4 {
    right: 40%;
    top: 25%;
}

.depth-2 {
    font-size: 2em;
    text-shadow: 0 0 0px rgba(200, 200, 200, 0.5);
}

.depth-2.flake1 {
    right: 40%;
    top: 40%;
}

.depth-2.flake2 {
    top: 60%;
    left: 10%;
}

.depth-3 {
    font-size: 2.5em;
    text-shadow: 0 0 1px rgba(200, 200, 200, 0.5);
}

.depth-3.flake1 {
    left: 30%;
    top: 65%;
}

.depth-3.flake2 {
    right: 25%;
    bottom: 65%;
}

.depth-3.flake3 {
    left: 40%;
    bottom: 75%;
}

.depth-3.flake4 {
    left: 10%;
    bottom: 85%;
}

.depth-4 {
    left: 3%;
    top: 25%;
    font-size: 4em;
    text-shadow: 0 0 3px rgba(200, 200, 200, 0.5);
}

.depth-5 {
    right: 10%;
    top: 15%;
    font-size: 6em;
    text-shadow: 0 0 10px rgba(256, 256, 256, 0.9);
}
</style>
