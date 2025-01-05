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
        title: 'PHP Backend Developer',
        company: 'FULLSTRIPE TECHNOLOGIES S.R.O.',
        location: 'Remote, Czechia',
        period: '07/05/2021 – CURRENT',
        description: 'Spearheaded web application development using PHP, Laravel, and Vue.js. Enhanced user experience through robust authentication systems and diverse payment gateways. Optimized codebase for 30% better performance and integrated real-time chat systems.'
    },
    {
        title: 'WordPress and PHP Web Developer',
        company: 'REMOTE - OFFICE ONE',
        location: 'Sri Lanka',
        period: '07/2019 – 11/2020',
        description: 'Transformed design mockups into functional WordPress websites. Developed custom plugins, integrated external APIs, and maintained web projects documentation. Focused on troubleshooting and clean coding practices.'
    },
    {
        title: 'System Administrator',
        company: 'QATARLINE',
        location: 'Doha, Qatar',
        period: '01/2017 – 05/2019',
        description: 'Managed routers, switches, and wireless devices. Handled IT security administration and system backup. Configured and monitored network infrastructure, ensuring smooth operation and security.'
    },
    {
        title: 'IT Administrator',
        company: 'AURA TECH SOLUTIONS',
        location: 'Colombo, Sri Lanka',
        period: '12/2015 – 12/2016',
        description: 'Provided system and network administration, technical support, and server installation. Designed and implemented network systems, ensuring access and security throughout customer destinations.'
    },
    {
        title: 'Technical Support Engineer',
        company: 'VG ENGINEERING',
        location: 'Doha, Qatar',
        period: '12/2013 – 05/2015',
        description: 'Provided level 3 technical support and managed incoming tickets. Administered Active Directory and ensured reliable technical service for both onsite and remote support.'
    }
];

</script>

<style scoped></style>
