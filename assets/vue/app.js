import { createApp } from 'vue';
import App from './components/App.vue';
import '../styles/app.css';
import '../styles/style.css';
import router from './router.js';
import VueTailwindDatepicker from "vue-tailwind-datepicker";
// import InactivityTimeoutPlugin from './timer.js';
// import store from './socket.js';

const app = createApp(App);

// app.config.globalProperties.$hostname = 'https://book.taxikone.com';
app.config.globalProperties.$hostname = 'http://localhost:8000';

if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/socket.js')
            .then(registration => {
                if (!navigator.serviceWorker.controller) {
                    console.info("controller is still none for some reason.");
                    return;
                }
                console.log('Service Worker registered:', registration.scope);
            })
            .catch(error => {
                console.error('Service Worker registration failed:', error);
            });
    });
}
// app.use(InactivityTimeoutPlugin);
// app.use(store);
app.use(router);
app.use(VueTailwindDatepicker);

app.mount('#app');






