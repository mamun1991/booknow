<template>
    <div class="w-full h-screen">
        <div class="warningMsgComp">
            <TransitionGroup name="warnMsgTrn" tag="div">
                <Warning v-for="(warn, index) in warningMessage" :key="index" :warningType="warn.warnType"
                    :warningMsg="warn.warnMsg"></Warning>
            </TransitionGroup>
        </div>
        <div
            class="max-w-sm md:max-w-md top-1/4 absolute left-0 right-0 flex flex-col items-center justify-center bg-purple-300 rounded-lg border border-purple-400 shadow-xl shadow-gray-400 m-auto p-4">
            <form @submit.prevent="submitLogin" class="w-full">
                <div class="w-full mb-4 text-4xl color-mediumvioletred text-center font-semibold drop-shadow-md">
                    Admin Login
                </div>
                <div class="w-full mb-6 mt-2">
                    <h2 class="text-stone-600 text-lg">Name</h2>
                    <input v-model="loginData.name" type="text"
                        class="appearance-none focus:ring-0 block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                        placeholder="Enter Name">
                </div>
                <div class="w-full">
                    <h2 class="text-stone-600 text-lg">Password</h2>
                    <input v-model="loginData.password" type="password"
                        class="appearance-none focus:ring-0 block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                        placeholder="******">
                </div>
                <div class="w-full mt-6 mb-4">
                    <button
                        class="w-full rounded bg-purple-700 hover:bg-purple-600 active:bg-purple-700 border border-purple-800 active:border-purple-400 text-white text-2xl p-3 shadow font-semibold active:text-stone-300"
                        type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Warning from './Warning.vue';
export default {
    data() {
        return {
            
            warningMessage: [],
            loginData: {
                name: '',
                password: '',
            },
            getLogin: [],

            BaseUrl: 'http://localhost:8000',
            contentheader: {
                'X-H': 'booknow1221',
            }
        }
    },
    components: {
        Warning,
    },
    created() {
        if (localStorage.getItem('loginInfo')) {
            this.$router.push('/dashboard/home');
        }

        this.BaseUrl = this.$hostname;
    },
    methods: {
        submitLogin() {
            if (!this.loginData.name) {
                this.warningMessage.push({
                    warnType: 'Error',
                    warnMsg: 'Please enter name!',
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                    // this.submitLoading = false;
                }, 3000);
                return;
            }
            if (!this.loginData.password) {
                this.warningMessage.push({
                    warnType: 'Error',
                    warnMsg: 'Please enter password!',
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                    // this.submitLoading = false;
                }, 3000);
                return;
            }

            axios.post(this.BaseUrl + '/loginAuth', {  login: this.loginData } , { headers: { 'X-H': this.contentheader['X-H'] } }).then((response) => {
                // console.log(response.data.getAdmin);
                if (response.data.status == 'Success') {
                    this.getLogin = JSON.parse(response.data.loginsuccess);
                    localStorage.setItem('loginInfo', JSON.stringify(this.getLogin));

                    // console.log(this.getLogin);
                    // console.log(JSON.parse(localStorage.getItem('loginInfo')).name);

                    this.warningMessage.push({
                        warnType: 'Success',
                        warnMsg: 'Login successfull!',
                    });
                    setTimeout(() => {
                        this.removeWarningMsg();
                        this.$router.push('/dashboard/home');
                    }, 1500);
                } else {
                    this.warningMessage.push({
                        warnType: response.data.status,
                        warnMsg: response.data.message,
                    });
                    setTimeout(() => {
                        this.removeWarningMsg();
                    }, 2000);
                }
                
            }).finally(() => {
                // console.log(this.getLogin.id);
            });
        },
        removeWarningMsg() {
            this.warningMessage.shift();
        },
    }
}
</script>

<style>
    .color-mediumvioletred {
        color: mediumvioletred
    }
</style>