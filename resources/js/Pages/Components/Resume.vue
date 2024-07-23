<template>
    <div class="resume py-12">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">My Resume</h2>
        </div>
        <div>
            <ResumeEntry v-for="(entry, index) in entries" :key="entry.title" :title="entry.title"
                :company="entry.company" :location="entry.location" :period="entry.period"
                :description="entry.description" :isLeftAligned="index % 2 === 1" />
        </div>
    </div>
</template>

<script setup>
import ResumeEntry from './ResumeEntry.vue';

const entries = [
    {
        title: 'UI/UX Designer',
        company: 'Google INC',
        location: 'New York',
        period: '2011 - 2013',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
    },
    {
        title: 'Web Designer',
        company: 'Facebook INC',
        location: 'New York',
        period: '2014 - 2018',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
    },
    {
        title: 'Specialization Course',
        company: 'Stanford University',
        location: 'New York',
        period: '2017 - 2018',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
    },
    {
        title: 'Bachelor Degree',
        company: 'Stanford University',
        location: 'New York',
        period: '2019 - 2021',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
    }
];

</script>

<style scoped></style>
