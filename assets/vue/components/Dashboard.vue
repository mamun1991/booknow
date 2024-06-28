<template>
    <div class="mb-24 w-full">
        <div class="warningMsgComp flex items-center justify-center left-0 right-0 top-1/3">
            <TransitionGroup name="warnMsgTrn" tag="div">
                <div class="w-full max-w-[250px]" :key="'myKey'" v-if="showNewNotification">
                    <button @click="removeNewOrder"
                        class="w-full flex bg-emerald-500 border border-emerald-500 hover:bg-emerald-400 active:bg-emerald-500 drop-shadow-lg shadow-lg text-white font-semibold rounded-lg p-10 text-xl">
                        New Order: {{ orderFrom }} <span class="animate-ping">!</span>
                    </button>
                </div>
            </TransitionGroup>
        </div>
        <button @click.prevent="showNotification('name')">push</button>
        <adminheader></adminheader>
        <router-view v-slot="{ Component }">
            <KeepAlive>
                <component :is="Component"></component>
            </KeepAlive>
        </router-view>

        <!-------<audio v-if="loadAudio" class="invisible" ref="audio" autoplay loop controls src="https://www.soundjay.com/misc/sounds/censor-beep-2.mp3"></audio>
        <audio v-if="loadAudio" class="invisible" ref="audio" autoplay loop controls src="https://www.soundjay.com/misc/sounds/bell-ringing-05.mp3"></audio>
        <audio v-if="loadAudio" class="invisible" ref="audio" autoplay loop controls src="https://www.soundjay.com/misc/sounds/magic-chime-03.mp3"></audio>
        <audio v-if="loadAudio" class="invisible" ref="audio" autoplay loop controls src="https://www.soundjay.com/misc/sounds/magic-chime-02.mp3"></audio>-->
        <audio class="invisible" ref="audio" loop controls
            src="https://www.soundjay.com/misc/sounds/magic-chime-02.mp3"></audio>

        <div
            class="w-full text-center h-20 bg-violet-200 mt-16 justify-center flex items-center text-gray-600 border-t border-violet-300 fixed bottom-0 max-w-[1280px]">
            booknow@copyright.com
        </div>
    </div>
</template>

<script>
import adminheader from './Header.vue';
import axios from 'axios';
import { messaging } from '../firebase.js';
import {  getToken } from "firebase/messaging";


export default {
    data() {
        return {
            newOrder: 0,
            showNewNotification: false,
            loadAudio: false,
            socket: null,
            liveUpdates: [],
            timeoutId: 30000,
            orderFrom: '',

            countOrder: 0,
            notifShow: 0,

            BaseUrl: 'http://localhost:8000',
        }
    },
    components: {
        adminheader,
    },
    created() {
        if (!localStorage.getItem('loginInfo')) {
            this.$router.push('/dashboard/login');
        }
        this.BaseUrl = this.$hostname;

        // this.getRealNotification();
        // this.initWebSocket();
        setInterval(() => {
            this.getRealNotification();
        }, 10000);
    },
    // beforeUnmount() {
    //     if (this.socket) {
    //         this.socket.close();
    //     }
    // },
    methods: {
        removeNewOrder() {
            this.showNewNotification = false;
            // this.newOrder = 0;
            // this.loadAudio = false;
            this.orderFrom = '';
            this.$refs.audio.pause();
            this.$refs.audio.currentTime = 0;
            this.$router.push('/dashboard/order');
        },
        // initWebSocket() {
        //     this.socket = new WebSocket('ws://localhost:8080');

        //     this.socket.addEventListener('open', (event) => {
        //         console.log('WebSocket connection opened:', event);
        //     });

        //     this.socket.addEventListener('close', (event) => {
        //         console.log('WebSocket connection closed:', event);
        //         // Handle the closed connection, you might want to attempt reconnection
        //     });

        //     this.socket.addEventListener('message', (event) => {
        //         if (this.socket.readyState === WebSocket.OPEN) {
        //             // Handle the message here
        //             const data = JSON.parse(event.data);
        //             if (data.value == 'WEBSOCKET') {
        //                 this.newOrder += 1;
        //                 this.showNewNotification = true;
        //                 this.loadAudio = true;

        //                 clearTimeout(this.timeoutId);
        //                 this.timeoutId = setTimeout(() => {
        //                     this.loadAudio = false;
        //                 }, 30000);

        //             }
        //             // console.log('websocket-data', data.value);
        //         } else {
        //             console.warn('Something went wrong!');
        //         }
        //     });

        //     // Optional: Handle errors
        //     this.socket.addEventListener('error', (event) => {
        //         console.error('WebSocket error:', event);
        //     });
        // },

        getRealNotification() {
            axios.post(this.BaseUrl + '/dashboard/getRealNotification').then((response) => {
                // console.log(response.data.getNewOrder);
                if (response.data.getNewOrder) {
                    // this.newOrder += 1;                    

                    // console.log('local store::', localStorage.getItem('countneworder'));

                    if (response.data.corder > this.notifShow) {
                        this.countOrder = response.data.corder;
                        // console.log('start notif----');
                        this.notifShow = response.data.corder;

                        this.orderFrom = response.data.getNewOrder;
                        this.showNotification(response.data.getNewOrder);
                        this.showNewNotification = true;
                        this.$refs.audio.play();
                    } else {
                        this.removeNotification();
                    }
                } else {
                    this.notifShow = 0;
                }
            }).finally(() => {
                this.submitLoading = false;
            });
        },

        // showNotification(name) {
        //     // Check if the browser supports notifications
        //     if (!("Notification" in window)) {
        //         alert("This browser does not support desktop notification");
        //     } else if (Notification.permission === "granted") {
        //         setTimeout(() => {
        //             this.createNotification(name);
        //         }, 2000);

        //         // console.log('second condition');
        //         // If permission has already been granted, show the notification
        //         // this.createNotification();
        //     } else if (Notification.permission !== "denied") {
        //         // If permission has not been denied, request permission
        //         Notification.requestPermission().then(permission => {
        //             if (permission === "granted") {
        //                 this.createNotification(name);
        //                 console.log('fourth condition');
        //             }
        //         });
        //     }
        // },
        createNotification(name) {
            // Create and show the notification
            // console.log('new notif...');
            new Notification('New Order', {
                body: 'You have a new order from' + name,
            });
        },

        showNotification(name) {
            if (!("Notification" in window)) {
                alert("This browser does not support desktop notification");
            } else if (Notification.permission === "granted") {
                setTimeout(() => {
                    this.sendMessageToServiceWorker(name);
                }, 2000);
            } else if (Notification.permission !== "denied") {
                Notification.requestPermission().then(permission => {
                    if (permission === "granted") {
                        sendMessageToServiceWorker(name);
                    }
                });
            }
        },
        sendMessageToServiceWorker(message) {
            // console.log('worker: ', navigator.serviceWorker);
            if ('serviceWorker' in navigator && navigator.serviceWorker.controller) {
                navigator.serviceWorker.controller.postMessage(message);
                this.createNotification(message);
            }
        },

        removeNotification() {
            axios.post(this.BaseUrl + '/dashboard/removeNotification').then((response) => {
                // console.log(response.data.getNewOrder);

                this.notifShow = 0;

            }).finally(() => {
                // this.submitLoading = false;
            });
        },
    }
}
</script>

<style>
.warningMsgComp {
    z-index: 9999999999;
}
</style>