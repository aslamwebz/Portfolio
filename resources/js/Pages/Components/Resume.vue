<template>
    <section class="container max-w-screen-xl py-16 mx-auto">
        <div class="p-8 bg-gray-800 rounded-md shadow-2xl shadow-black">
            <div class="px-4 py-8 mx-auto text-center">
                <h2 class="mb-4 text-3xl font-bold text-white">My Professional Journey</h2>
                <p class="mb-12 text-sm text-gray-400">
                    Explore my career path and achievements
                </p>
            </div>

            <!-- Resume Tabs - Only showing Experience for now -->
            <div class="mb-8">
                <div class="flex flex-wrap justify-center gap-4">
                    <button @click="activeTab = 'experience'"
                        class="px-6 py-3 text-sm text-white transition-all duration-300 bg-blue-600 rounded-lg">
                        <i class="mr-2 fas fa-briefcase"></i>
                        Experience
                    </button>

                </div>
            </div>

            <!-- Experience Tab with Enhanced Visuals -->
            <div class="resume-section">
                <div class="timeline-container">
                    <div v-for="(job, index) in experience" :key="index" class="timeline-item"
                        :class="{ 'expanded': expandedItems.includes(job.id) }" @mouseenter="hoveredJob = job.id"
                        @mouseleave="hoveredJob = null">
                        <div class="timeline-marker" :class="{ 'pulse': hoveredJob === job.id }"></div>
                        <div class="p-6 transition-all duration-300 transform bg-gray-900 shadow-lg timeline-content rounded-xl"
                            :class="{ 'scale-105': hoveredJob === job.id, 'border-l-4': expandedItems.includes(job.id) }"
                            :style="expandedItems.includes(job.id) ? 'border-color: #3b82f6' : ''">
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="flex items-center text-base font-bold text-white">
                                    <i :class="getJobIcon(job.title)" class="mr-2 text-blue-400"></i>
                                    {{ job.title }}
                                </h3>
                                <span class="px-3 py-1 text-xs text-blue-400 rounded-full bg-blue-900/50">{{ job.period
                                    }}</span>
                            </div>
                            <h4 class="flex items-center mb-4 text-sm text-blue-300">
                                <i class="mr-2 text-gray-400 fas fa-building"></i>
                                {{ job.company }}
                                <span class="ml-2 text-xs text-gray-400">{{ job.location }}</span>
                            </h4>

                            <div class="mb-4">
                                <p class="text-xs text-gray-400" v-if="!expandedItems.includes(job.id)">
                                    {{ job.description.substring(0, 150) }}...
                                </p>
                                <div v-else class="animate-fadeIn">
                                    <p class="mb-4 text-xs text-gray-400">{{ job.description }}</p>
                                    <h5 class="flex items-center mb-2 text-sm font-semibold text-white">
                                        <i class="mr-2 text-yellow-500 fas fa-trophy"></i> Key Achievements
                                    </h5>
                                    <ul class="pl-0 mb-6 space-y-3 text-gray-400 list-none">
                                        <li v-for="(achievement, i) in job.achievements" :key="i"
                                            class="flex items-start">
                                            <i class="mt-1 mr-2 text-green-500 fas fa-check-circle"></i>
                                            <span class="text-xs">{{ achievement }}</span>
                                        </li>
                                    </ul>
                                    <h5 class="flex items-center mb-2 font-semibold text-white">
                                        <i class="mr-2 text-purple-500 fas fa-code"></i> Technologies Used
                                    </h5>
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        <span v-for="(tech, i) in job.technologies" :key="i"
                                            class="px-3 py-1 text-xs text-gray-300 transition-colors bg-gray-800 rounded-full cursor-default hover:bg-blue-900 hover:text-blue-200">
                                            {{ tech }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <button @click="toggleExpand(job.id)"
                                class="flex items-center px-4 py-2 text-xs text-blue-400 transition-all bg-gray-800 rounded-full hover:text-blue-300 hover:bg-gray-700">
                                {{ expandedItems.includes(job.id) ? 'Show Less' : 'Show More' }}
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4 ml-1 transition-transform duration-300" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor"
                                    :class="{ 'rotate-180': expandedItems.includes(job.id) }">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';

const activeTab = ref('experience');
const expandedItems = ref([]);
const hoveredJob = ref(null);

// Function to toggle expanded state
const toggleExpand = (id) => {
    if (expandedItems.value.includes(id)) {
        expandedItems.value = expandedItems.value.filter(item => item !== id);
    } else {
        expandedItems.value.push(id);
    }
};

// Function to get appropriate icon for job title
const getJobIcon = (title) => {
    const titleLower = title.toLowerCase();
    if (titleLower.includes('developer')) return 'fas fa-code';
    if (titleLower.includes('admin')) return 'fas fa-server';
    if (titleLower.includes('engineer')) return 'fas fa-cogs';
    if (titleLower.includes('support')) return 'fas fa-headset';
    return 'fas fa-briefcase';
};

// Experience data with enhanced details
const experience = [
    {
        id: 'fullstripe',
        title: 'PHP Backend Developer',
        company: 'FULLSTRIPE TECHNOLOGIES',
        location: 'Remote',
        period: '2021 - Present',
        description: 'Leading the development of web applications using PHP, Laravel, Livewire, and Vue.js. Responsible for designing and implementing scalable backend solutions, optimizing database performance, and ensuring high-quality code through comprehensive testing.',
        achievements: [
            'Reduced API response time by 40% through implementation of efficient caching strategies and query optimization',
            'Developed a custom CMS that increased content management efficiency by 60%',
        ],
        technologies: ['PHP', 'Laravel', 'Livewire', 'Vue.js', 'MySQL', 'Git']
    },
    {
        id: 'officeone',
        title: 'WordPress and PHP Web Developer',
        company: 'REMOTE - OFFICE ONE',
        location: 'Remote',
        period: '2018 - 2020',
        description: 'Specialized in transforming design mockups into functional WordPress websites and developing custom plugins to extend functionality. Worked closely with designers and clients to ensure project requirements were met with high-quality deliverables.',
        achievements: [
            'Built 10+ custom WordPress sites for clients across various industries',
            'Improved website loading speed by an average of 35% through optimization techniques',
        ],
        technologies: ['WordPress', 'PHP', 'JavaScript', 'MySQL', 'HTML/CSS', 'jQuery']
    },
    {
        id: 'qatarline',
        title: 'System Administrator',
        company: 'QATARLINE',
        location: 'Doha, Qatar',
        period: '2017 - 2018',
        description: 'Managed network infrastructure and IT security administration. Responsible for maintaining server health, implementing security protocols, and providing technical support to ensure smooth operations across the organization.',
        achievements: [
            'Implemented a new backup system that reduced data recovery time by 70%',
            'Upgraded network infrastructure resulting in 99.9% uptime throughout the year',
        ],
        technologies: ['Windows Server', 'Active Directory', 'Exchange Server', 'VMware', 'Cisco Networking', 'PowerShell', 'Cloud Services']
    },
    {
        id: 'auratech',
        title: 'IT Administrator',
        company: 'AURA TECH SOLUTIONS',
        location: 'Colombo, Sri Lanka',
        period: '2016 - 2017',
        description: 'Provided comprehensive system and network administration, technical support, and server installation services. Managed IT infrastructure and implemented solutions to improve operational efficiency.',
        achievements: [

        ],
        technologies: ['Windows Server', 'Linux', 'Networking', 'Virtualization', 'Security', 'Hardware Troubleshooting']
    },
    {
        id: 'vgengineering',
        title: 'Technical Support Engineer',
        company: 'VG ENGINEERING',
        location: 'Doha, Qatar',
        period: '2014 - 2015',
        description: 'Provided level 3 technical support and managed Active Directory in a large enterprise environment. Responsible for troubleshooting complex technical issues and maintaining system reliability.',
        achievements: [

        ],
        technologies: ['Windows Server', 'Active Directory', 'Exchange', 'Networking', 'Troubleshooting', 'Technical Documentation']
    }
];
</script>

<style scoped>
.timeline-container {
    position: relative;
    padding: 20px 0;
}

.timeline-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    height: 100%;
    width: 2px;
    background-color: #3b82f6;
}

.timeline-item {
    position: relative;
    margin-bottom: 40px;
    width: 100%;
    display: flex;
    justify-content: center;
}

.timeline-marker {
    position: absolute;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background-color: #3b82f6;
    z-index: 1;
    transition: all 0.3s ease;
}

.timeline-marker.pulse {
    box-shadow: 0 0 0 rgba(59, 130, 246, 0.4);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4);
    }

    70% {
        box-shadow: 0 0 0 10px rgba(59, 130, 246, 0);
    }

    100% {
        box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
    }
}

.timeline-content {
    width: 45%;
    transition: all 0.3s ease;
}

.timeline-item:nth-child(odd) .timeline-content {
    margin-right: auto;
    margin-left: 0;
}

.timeline-item:nth-child(even) .timeline-content {
    margin-left: auto;
    margin-right: 0;
}

.animate-fadeIn {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .timeline-container::before {
        left: 30px;
    }

    .timeline-marker {
        left: 30px;
    }

    .timeline-content {
        width: calc(100% - 60px);
        margin-left: 60px !important;
        margin-right: 0 !important;
    }
}
</style>
