import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/hearty-meal',
        name: 'hearty-meal',
        component: () => import('../Pages/HeartyMeal/Index.vue')
    },
    {
        path: '/hearty-meal/restaurant/:id',
        name: 'restaurant',
        component: () => import('../Pages/HeartyMeal/Restaurant.vue'),
        props: true
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
