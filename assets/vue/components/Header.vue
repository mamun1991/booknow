<template>
    <div class="w-full">
        <div class="w-full bg-violet-200 border-b border-violet-300">
            <div class="flex flex-wrap w-full md:h-24 justify-between items-center">
                <div class="logo w-full md:w-1/5 items-center text-center">
                    <h1 class="my-6 md:ml-6 text-3xl md:text-2xl text-violet-700 font-semibold">BookNow Admin</h1>
                </div>
                <div class="w-full flex flex-wrap justify-center md:justify-end mb-6 md:mb-2 md:w-4/5 text-center md:text-right md:pr-6 text-lg h-auto"> 
                    <router-link :class="{ 'active-btn': activeTab === 'home' }" @click="setActiveTab('home')" class="mt-2 md:mt-0 px-4 py-1 md:px-6 md:py-2 font-semibold rounded-lg bg-orange-400 hover:bg-orange-300 hover:text-gray-800 active:bg-orange-400 active:text-gray-900 shadow drop-shadow mx-1" to="/dashboard/home">Home</router-link>
                    <router-link :class="{ 'active-btn': activeTab === 'destination' }" @click="setActiveTab('destination')" class="mt-2 md:mt-0 px-4 py-1 md:px-6 md:py-2 font-semibold rounded-lg bg-orange-400 hover:bg-orange-300 hover:text-gray-800 active:bg-orange-400 active:text-gray-900 shadow drop-shadow mx-1" to="/dashboard/destination">Destination</router-link>
                    <router-link :class="{ 'active-btn': activeTab === 'order' }" @click="setActiveTab('order')" class="mt-2 md:mt-0 px-4 py-1 md:px-6 md:py-2 font-semibold rounded-lg bg-orange-400 hover:bg-orange-300 hover:text-gray-800 active:bg-orange-400 active:text-gray-900 shadow drop-shadow mx-1" to="/dashboard/order">Orders</router-link>
                    <router-link :class="{ 'active-btn': activeTab === 'user' }" @click="setActiveTab('user')" class="mt-2 md:mt-0 px-4 py-1 md:px-6 md:py-2 font-semibold rounded-lg bg-orange-400 hover:bg-orange-300 hover:text-gray-800 active:bg-orange-400 active:text-gray-900 shadow drop-shadow mx-1" to="/dashboard/user">Hotel</router-link>
                    <router-link v-if="showHide" :class="{ 'active-btn': activeTab === 'admin' }" @click="setActiveTab('admin')" class="mt-2 md:mt-0 px-4 py-1 md:px-6 md:py-2 font-semibold rounded-lg bg-orange-400 hover:bg-orange-300 hover:text-gray-800 active:bg-orange-400 active:text-gray-900 shadow drop-shadow mx-1" to="/dashboard/admin">Admin</router-link>
                    <button @click.prevent="logOut" class="mt-2 md:mt-0 px-4 py-1 md:px-6 md:py-2 font-semibold rounded bg-red-600 hover:bg-red-500 text-white hover:text-gray-300 active:bg-red-600 active:text-gray-400 shadow drop-shadow mx-1">Logout</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            lastUrl: '',
            activeTab: '',
            showHide: false,
        }
    },
     mounted() {
         this.extractLastPartOfUrl();
         if (JSON.parse(localStorage.getItem('loginInfo')).admintype == 2) {
             this.showHide = true;
        }
    },
    
    methods: {
        setActiveTab(tab) {
            this.activeTab = tab;
        },
        logOut() {
            setTimeout(() => {
                localStorage.removeItem('loginInfo')
                // this.removeWarningMsg();
                this.$router.push("/dashboard/login");
            }, 1000);
        },

        extractLastPartOfUrl() {
            // Get the current URL
            const currentUrl = window.location.href;
            // Split the URL by '/' to get an array of parts
            const urlParts = currentUrl.split('/');
            // Get the last part of the URL (excluding any trailing slashes)
            const lastPart = urlParts[urlParts.length - 1];
            // Update the data property with the last part of the URL
            this.activeTab = lastPart;
            // console.log(lastPart);
        },
    },
}
</script>

<style>
    .active-btn{
        /* background-color: rgb(234 88 12 / var(--tw-bg-opacity)); */
        background-color: rgb(194 65 12 / var(--tw-bg-opacity));
    }
</style>