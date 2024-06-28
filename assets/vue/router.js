import { createRouter, createWebHistory } from 'vue-router';

const home = () => import('./components/Homepage.vue');
const dashboard = () => import('./components/Dashboard.vue');
const dashome = () => import('./components/Home.vue');
const login = () => import('./components/Login.vue');
const adminuser = () => import('./components/User.vue');
const order = () => import('./components/Orders.vue');
const admin = () => import('./components/Admin.vue');
const dashlogin = () => import('./components/Dash_login.vue');
const destination = () => import('./components/Destination.vue');

const routes = [
    {
        path: '/', component: home, meta: { requireAuth: true, title: 'Book Now' },
    },
    {
        path: '/login', component: login, meta: { title: 'Book Now | Login' },
    },
    {
        path: '/dashboard/login', component: dashlogin, meta: { requiresAuth: false, title: 'Admin | Login' },
    },
    {
        path: '/dashboard', component: dashboard, redirect: "/dashboard/home", meta: { requiresAuth: true, title: 'Admin | Dashboard' },
        children: [
            {
                path: 'home', component: dashome, meta: { requiresAuth: true, title: 'Admin | Dashboard' },
            },
            {
                path: 'user', component: adminuser, meta: { requiresAuth: true, title: 'Admin | Client' },
            },
            {
                path: 'order', component: order, meta: { requiresAuth: true, title: 'Admin | Orders' },
            },
            {
                path: 'admin', component: admin, meta: { requiresAuth: true, title: 'Admin | Admin' },
            },
            {
                path: 'destination', component: destination, meta: { requiresAuth: true, title: 'Admin | Destination' },
            },
        ],
    },
];

const router = createRouter(
    {
        routes,
        history: createWebHistory()
    },
);

router.beforeEach((to, from, next) => {
    // Check if the route has a meta title
    if (to.meta.title) {
        document.title = to.meta.title; // Update the document title
    } else {
        document.title = 'Admin | Dashboard'; // Set a default title if the route doesn't have a meta title
    }
    const isLoggedIn = localStorage.getItem('loginInfo');
    // const clientLogin = localStorage.getItem('clientLogin');

    // If the user is not logged in and is trying to access a protected route,
    // redirect to the home page
    if (!isLoggedIn && to.meta.requiresAuth) {
        next('/dashboard/login');
    }
    else {
        next();
    }
});


export default router;