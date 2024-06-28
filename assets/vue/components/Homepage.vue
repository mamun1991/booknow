<template>
    <div id="mainTemplate">
        <div class="warningMsgComp">
            <TransitionGroup name="warnMsgTrn" tag="div">
                <Warning v-for="(warn, index) in warningMessage" :key="index" :warningType="warn.warnType"
                    :warningMsg="warn.warnMsg"></Warning>
            </TransitionGroup>
        </div>
        <div class="max-w-[1280px] mx-auto">
            <div class="header sm:h-32 flex flex-wrap bg-stone-200 border-b border-gray-300 mb-10">
                <div class="logo w-full sm:w-3/5 md:w-3/5 lg:w-4/6 sm:float-left">
                    <img src="../../images/booknow.png" class="w-72 sm:ml-6 mt-7 resize-none ml-auto mr-auto">
                </div>
                <div
                    class="w-full sm:w-2/5 md:w-2/5 lg:w-2/6 sm:float-right text-center sm:text-right pr-3 sm:place-items-end mb-5 sm:mb-0">
                    <button @click="openmodal = true"
                        class="shadow mt-10 bg-orange-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                        type="button">
                        Check Booking
                    </button>
                    <button @click.prevent="clientlogout"
                        class="shadow mt-10 ml-4 bg-red-600 hover:bg-red-500 active:bg-red-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                        type="button">
                        Logout
                    </button>
                </div>
            </div>
            <div class="mainBody">
                <h1 class="text-2xl sm:text-3xl font-bold text-center mb-10 underline-offset-4 underline text-orange-600">
                    Welcome {{ welcomeName }}!</h1>
                <form class="w-full p-4" @submit.prevent="submitBooking">
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full sm:w-1/2 px-3 mb-6 sm:mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2"
                                for="grid-zip">
                                Destination
                                <span
                                    class="text-orange-500 absolute after:content-['*'] after:text-base after:ml-1"></span>
                            </label>
                            <select v-model="bookData.destination" @change="handleChangeDestination"
                                class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-orange-500 mt-2">
                                <option v-for="(getDest, index) in getdestination" :key="index" :data-role="getDest.id">{{
                                    getDest.destname }}</option>
                            </select>
                        </div>
                        <div class="w-full sm:w-1/2 px-3 mb-6 sm:mb-6 flex">
                            <div class="dateInput w-1/2 px-3 mb-6 sm:mb-6">
                                <label class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2"
                                    for="grid-date">
                                    Date
                                    <!---<span class="text-orange-500 absolute after:content-['*'] after:text-base after:ml-1"></span>-->
                                </label>
                                <vue-tailwind-datepicker v-model="bookData.bookingdate" :formatter="formatter"
                                    class="appearance-none focus:ring-0 block w-full bg-gray-200 border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-orange-500"
                                    as-single />
                                <input type="hidden" v-model="bookData.orderdate">
                                <!--<TimePicker v-model="time" />-->
                            </div>
                            <div class="w-1/2">
                                <label class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2"
                                    for="grid-hours">
                                    Time
                                    <!---<span class="text-orange-500 absolute after:content-['*'] after:text-base after:ml-1"></span>-->
                                </label>
                                <select v-model="bookData.hours"
                                    class="float-left focus:ring-0 block w-1/2 bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-orange-500">
                                    <option value="00">00</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                </select>
                                <select v-model="bookData.minutes"
                                    class="float-right focus:ring-0 block w-1/2 bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-orange-500">
                                    <option value="00">00</option>
                                    <option value="05">05</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                    <option value="35">35</option>
                                    <option value="40">40</option>
                                    <option value="45">45</option>
                                    <option value="50">50</option>
                                    <option value="55">55</option>
                                    <option value="59">59</option>
                                </select>
                                <!--<TimePicker v-model="time" />-->
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2"
                                for="grid-description">
                                Description
                            </label>
                            <textarea v-model="bookData.description"
                                class="appearance-none min-h-80 focus:ring-0 block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-orange-500"
                                id="grid-description" type="text" placeholder="Write about your booking"></textarea>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full sm:w-2/4 px-3 mb-6 sm:mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2"
                                for="grid-cab">
                                How many Cabs
                            </label>
                            <select v-model="bookData.cabs" @change="handleChangeDestination"
                                class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-orange-500 mt-2">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div class="dateInput w-full sm:w-1/4 px-3 mb-6 sm:mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2"
                                for="grid-date">
                                Price per Cab
                            </label>
                            <p
                                class="font-semibold text-lg text-green-600 block w-full bg-gray-200 border border-gray-200 rounded py-3 px-4 leading-tight">
                                €{{ cabrent }}</p>
                        </div>
                        <div class="dateInput w-full sm:w-1/4 px-3 mb-6 sm:mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2"
                                for="grid-date">
                                Total Price
                            </label>
                            <p
                                class="font-semibold text-lg text-red-500 block w-full bg-gray-200 border border-gray-200 rounded py-3 px-4 leading-tight">
                                €{{ totalrent }}</p>
                            <input type="hidden" v-model="bookData.rent" value="{{ totalrent }}">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <button v-if="submitLoading" disabled
                                class="flex items-center justify-center shadow w-full mt-10 py-3 text-xl sm:text-2xl bg-green-600 hover:bg-green-500 focus:shadow-outline focus:outline-none text-white font-bold px-4 rounded"
                                type="submit">
                                <img src="../../images/loading.png" class="w-7 h-7 mr-2 mt-1 animate-spin">
                                Order
                            </button>
                            <button v-else
                                class="flex items-center justify-center shadow w-full mt-10 py-3 text-xl sm:text-2xl bg-green-600 hover:bg-green-500 focus:shadow-outline focus:outline-none text-white font-bold px-4 rounded"
                                type="submit">
                                Order
                            </button>

                        </div>
                    </div>
                </form>
                <!--<h1 class="text-2xl sm:text-3xl font-bold text-center mb-10 underline-offset-4 underline text-emerald-600">Last ten orders</h1>-->
                <div
                    class="flex w-full flex-col text-left text-xs sm:text-base sm:min-w-[600px] md:min-w-[700px] lg:min-w-[900px] mb-8">
                    <div class="w-full flex py-3  md:px-4 font-semibold text-white bg-violet-500">
                        <div class=" w-2/12 px-1">Destination</div>
                        <div class=" w-3/12 md:w-2/12 px-1 text-center sm:text-left">Date</div>
                        <!--<div class=" w-2/12 md:w-2/12 px-1 text-center sm:text-left">Booking Time</div>-->
                        <div class=" w-1/12 px-1 text-center">Cabs</div>
                        <div class=" w-1/12 px-1 text-center">Price</div>
                        <div class=" w-1/12 px-1">Taxi</div>
                        <div class=" w-2/12 px-1 md:w-2/12">Info</div>
                        <div class=" w-2/12 px-1 text-right">Action</div>
                    </div>
                    <div v-for="(history, index) in lastHistory" :key="index"
                        :class="{ 'bg-blue-400': history.status === 1 && !curOrder(history.time, history.orderdate, history.bookingdate, history.status), 'bg-orange-400': history.status === 0 && !curOrder(history.time, history.orderdate, history.bookingdate, history.status), 'bg-red-300': history.status === 2 && !curOrder(history.time, history.orderdate, history.bookingdate, history.status), 'bg-lime-300': curOrder(history.time, history.orderdate, history.bookingdate, history.status) && history.status === 1, 'bg-green-400': curOrder(history.time, history.orderdate, history.bookingdate, history.status) && (history.status !== 1), }"
                        class="w-full flex py-2  md:px-4 font-semibold text-gray-800">
                        <div class=" w-2/12 px-1">{{ history.destination }}</div>
                        <div class=" w-3/12 md:w-2/12 px-1 text-center sm:text-left">{{ history.bookingdate }} {{
                            history.time }}</div>
                        <!--<div class=" w-2/12 md:w-2/12 px-1 text-center sm:text-left">{{ history.orderdate }}</div>-->
                        <div class=" w-1/12 px-1 text-center">{{ history.cabs }}</div>
                        <div class=" w-1/12 px-1 text-center">{{ history.rent }}</div>
                        <div class=" w-1/12 md:w-2/12 px-1">{{ history.cabdatacount }}</div>
                        <div class=" w-2/12 md:w-2/12 px-1">{{ history.description }}</div>
                        <div class=" w-2/12 px-1 flex justify-end items-center">
                            <button @click="cancel = true, cancelId = history.id" v-if="history.status == 1"
                                class="py-1 sm:px-3 max-h-9 bg-pink-500 hover:bg-pink-600 active:bg-pink-800 border hover:border-pink-600 border-pink-500 active:border-pink-400 text-gray-900 shadow-lg active:drop-shadow rounded md:w-28">Pending</button>
                            <button v-else-if="history.status == 0"
                                class="py-1 sm:px-3 max-h-9 bg-emerald-500 text-gray-800 shadow-lg rounded md:w-28">Approved</button>
                            <button v-else
                                class="py-1 sm:px-3 max-h-9 bg-orange-500 text-gray-800 shadow-lg rounded md:w-28">Canceled</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer my-10 bg-stone-200 border-t py-5 border-gray-300">
                <h1 class="text-center text-orange-800">Contact Information | Copyright @booknow.com</h1>
            </div>
        </div>
        <Modal :modalShowHide="openmodal" @modalShowHide="openmodal = $event" modal-header="Your Orders">
            <div class="flex w-full flex-col sm:min-w-[600px] md:min-w-[700px] lg:min-w-[900px] mb-8 text-xs sm:text-base">
                <div class="w-full flex py-3  md:px-4 font-semibold text-white bg-violet-500">
                    <div class=" w-2/12 px-1">Destination</div>
                    <div class=" w-3/12 md:w-2/12 px-1 text-center sm:text-left">Date</div>
                    <!--<div class=" w-2/12 md:w-2/12 px-1 text-center sm:text-left">Booking Time</div>-->
                    <div class=" w-1/12 px-1 text-center">Cabs</div>
                    <div class=" w-1/12 px-1 text-center">Price</div>
                    <div class=" w-1/12 px-1 text-center">Taxi</div>
                    <div class=" w-2/12 md:w-4/12 px-1">Info</div>
                    <div class=" w-2/12 px-1 text-center">Action</div>
                </div>
                <div v-for="(checkBook, index) in checkBooking" :key="index"
                    :class="{ 'bg-blue-400': checkBook.status === 1 && !curOrder(checkBook.time, checkBook.orderdate, checkBook.bookingdate, checkBook.status), 'bg-orange-400': checkBook.status === 0 && !curOrder(checkBook.time, checkBook.orderdate, checkBook.bookingdate, checkBook.status), 'bg-red-300': checkBook.status === 2 && !curOrder(checkBook.time, checkBook.orderdate, checkBook.bookingdate, checkBook.status), 'bg-lime-300': curOrder(checkBook.time, checkBook.orderdate, checkBook.bookingdate, checkBook.status) && checkBook.status === 1, 'bg-green-400': curOrder(checkBook.time, checkBook.orderdate, checkBook.bookingdate, checkBook.status) && (checkBook.status !== 1), }"
                    class="w-full flex py-2  md:px-4 font-semibold text-gray-800">
                    <div class=" w-2/12 px-1">{{ checkBook.destination }}</div>
                    <div class=" w-3/12 md:w-2/12 px-1">{{ checkBook.bookingdate }} {{ checkBook.time }}</div>
                    <!--<div class=" w-3/12 md:w-2/12 px-1">{{ checkBook.orderdate }}</div>-->
                    <div class=" w-1/12 px-1 text-center">{{ checkBook.cabs }}</div>
                    <div class=" w-1/12 px-1 text-center">{{ checkBook.rent }}</div>
                    <div class=" w-1/12 px-1 text-center">{{ checkBook.cabdatacount }}</div>
                    <div class=" w-2/12 md:w-4/12 px-1">{{ checkBook.description }}</div>
                    <div class=" w-2/12 px-1 flex justify-end items-center">
                        <button @click="cancel = true, cancelId = checkBook.id" v-if="checkBook.status == 1"
                            class="py-1 sm:px-3 max-h-9 bg-pink-500 hover:bg-pink-600 active:bg-pink-800 border hover:border-pink-600 border-pink-500 active:border-pink-400 text-gray-900 shadow-lg active:drop-shadow rounded md:w-28">Cancel</button>
                        <button v-else-if="checkBook.status == 0"
                            class="py-1 sm:px-3 max-h-9 bg-emerald-500 text-gray-800 shadow-lg rounded md:w-28">Approved</button>
                        <button v-else
                            class="py-1 sm:px-3 max-h-9 bg-orange-500 text-gray-800 shadow-lg rounded md:w-28">Canceled</button>
                    </div>
                </div>
            </div>
        </Modal>

        <!--------- calcel order modal------------>
        <Modal :modalShowHide="cancel" @modalShowHide="cancel = $event" modal-header="Cancel Order" modalStyle="bounce">
            <div class="m-2 sm:w-96 text-gray-700">
                <form @submit.prevent="cancelOrder" class="w-full">
                    <h1 class="w-full text-center text-2xl text-slate-800 drop-shadow my-10">Are you sure want to cancel
                        order !</h1>
                    <input v-model="cancelId" type="hidden">
                    <div class="w-full flex mt-24">
                        <button @click.prevent="cancel = false"
                            class="w-1/2 py-2 px-4 mr-2 text-xl bg-green-600 hover:bg-green-500 active:bg-green-600 active:text-gray-400 drop-shadow shadow text-white rounded mt-2">No</button>
                        <button
                            class="w-1/2 py-2 px-4 ml-2 text-xl bg-red-600 hover:bg-red-500 active:bg-red-600 active:text-gray-400 drop-shadow shadow text-white rounded mt-2">Yes</button>
                    </div>
                </form>
            </div>
        </Modal>
    </div>
</template>
<script>
import { ref } from 'vue'
import Warning from './Warning.vue';
import Modal from './Modal.vue';
import axios from 'axios';
// import moment from 'moment';

// import { state, socket } from "../socket.js";

const formatter = ref({
    date: 'DD-MM-YYYY',
    month: 'MM',
})
export default {
    data() {
        return {
            formatter,
            openmodal: false,
            submitLoading: false,
            warningMessage: [],
            bookData: {
                description: '',
                hotel: '',
                destination: 'a',
                bookingdate: '',
                orderdate: '',
                cabs: 1,
                rent: '',
                cabdatacount: '',
                time: '',
                hours: '',
                minutes: '',
            },
            cabrent: '',
            totalrent: '',
            getdestination: [],
            checkBooking: [],
            welcomeName: '',

            cancel: false,
            cancelId: '',

            lastHistory: [],


            BaseUrl: 'http://localhost:8000',

            socket: {
                connection: null,
                isConnected: false,
                message: '',
                reconnectError: false,
            },
        }
    },
    mounted() {
        // this.$socket.emit('someevent', { data: 'Hello, WebSocket!' });
        // this.connectWebSocket();
        this.formatDate(new Date());
    },
    created() {
        this.BaseUrl = this.$hostname;
        if (!localStorage.getItem('clientLogin')) {
            // console.log(localStorage.getItem('clientLogin'));
            this.$router.push('/login');
        }

        this.welcomeName = JSON.parse(localStorage.getItem('clientLogin')).name;
        // this.connectWebSocket();
        // this.bookData.orderdate = new Date().toLocaleDateString();
        this.getallDestination();
        this.checkBookingOrder();
        this.formatDate(new Date());

        setInterval(() => {
            this.checkBookingOrder();
        }, 180000);

    },
    methods: {
        validateInput() {
            this.bookData.cabs = parseInt(this.bookData.cabs, 10);
            if (this.bookData.cabs % 1 !== 0) {
                this.bookData.cabs = 0;
            }
        },
        formatDate(date) {
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();

            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');

            this.bookData.bookingdate = `${day}-${month}-${year}`;
            this.bookData.orderdate = `${hours}:${minutes}`;
            this.bookData.hours = `${hours}`;

            if (minutes < 6) { this.bookData.minutes = '05'; }
            else if (minutes > 5 && minutes < 11) { this.bookData.minutes = 10; }
            else if (minutes > 10 && minutes < 16) { this.bookData.minutes = 15; }
            else if (minutes > 15 && minutes < 21) { this.bookData.minutes = 20; }
            else if (minutes > 20 && minutes < 26) { this.bookData.minutes = 25; }
            else if (minutes > 25 && minutes < 31) { this.bookData.minutes = 30; }
            else if (minutes > 30 && minutes < 36) { this.bookData.minutes = 35; }
            else if (minutes > 35 && minutes < 41) { this.bookData.minutes = 40; }
            else if (minutes > 40 && minutes < 46) { this.bookData.minutes = 45; }
            else if (minutes > 45 && minutes < 51) { this.bookData.minutes = 50; }
            else if (minutes > 50 && minutes < 56) { this.bookData.minutes = 55; }
            else if (minutes > 55) { this.bookData.minutes = 59; }
            // this.bookData.minutes = minutes;
            // this.bookData.orderdate = `${day}-${month}-${year} ${hours}:${minutes}`;
        },
        curOrder(booktime, ordertime, bookdate, status) {
            if (!booktime) { return false; }
            let bday = bookdate.split("-")[0];
            const day = String(new Date().getDate()).padStart(2, '0');

            if (bday != day && status == 1) {
                return false;
            }

            let hour = booktime.split(":")[0];
            let minute = booktime.split(":")[1];
            let lesshour = parseInt(hour) - 1;

            let orderhour = ordertime.split(":")[0];
            let orderminute = ordertime.split(":")[1];
            let finalMinutes = parseInt(orderminute) + 20;
            let lessfinalMinutes = parseInt(orderminute) - 60;

            // console.log(booktime, ordertime);

            if (orderhour == hour && finalMinutes >= minute) {
                // console.log('first:', time);
                return true;
            }
            if (orderhour == lesshour && lessfinalMinutes >= minute) {
                return true;
            }
        },
        removeWarningMsg() {
            this.warningMessage.shift();
        },
        async getallDestination() {
            const hotelname = JSON.parse(localStorage.getItem('clientLogin'));
            await axios.post(this.BaseUrl + '/getallDestination', { dataid: hotelname.id }).then((response) => {
                this.getdestination = JSON.parse(response.data.getDestinationById);
                // console.log(this.getdestination[0].destname);

                this.bookData.destination = this.getdestination[0].destname;
                this.cabrent = this.getdestination[0].price;
                this.bookData.rent = this.getdestination[0].price;
                this.totalrent = this.getdestination[0].price;

            }).finally(() => {
                // this.submitLoading = false;
            });
        },
        cabCounter(cabs) {
            if (localStorage.getItem('resetCounter') != new Date().getDate()) {
                localStorage.removeItem('cabCounter');
                localStorage.setItem('resetCounter', new Date().getDate());
            }
            let cabNumber = 500;
            let cabValue = '';
            if (localStorage.getItem('cabCounter')) {
                cabNumber = localStorage.getItem('cabCounter');
            }

            for (let i = 0; i < cabs; i++) {
                cabNumber++;
                cabValue += `${cabNumber} `;
                // console.log(cabNumber);
            }
            // console.log(new Date().getDate());
            this.bookData.cabdatacount = cabValue;

            localStorage.setItem('cabCounter', cabNumber);

        },
        submitBooking() {
            const storeData = JSON.parse(localStorage.getItem('clientLogin'));
            this.submitLoading = true;

            let bday = this.bookData.bookingdate.split("-")[0];
            let bmonth = this.bookData.bookingdate.split("-")[1];
            const day = String(new Date().getDate()).padStart(2, '0');
            const month = String(new Date().getMonth() + 1).padStart(2, '0');
            const year = new Date().getFullYear();

            const hours = String(new Date().getHours()).padStart(2, '0');
            const minutes = String(new Date().getMinutes()).padStart(2, '0');

            if (bmonth < month) {
                this.bookData.bookingdate = `${day}-${month}-${year}`;
            }
            if (bday < day && bmonth == month) {
                this.bookData.bookingdate = `${day}-${month}-${year}`;
            }
            if (this.bookData.hours < hours && bday == day) {
                this.bookData.hours = hours;
            }
            if (this.bookData.minutes < minutes && this.bookData.hours == hours) {
                this.bookData.minutes = minutes;
            }

            this.bookData.time = `${this.bookData.hours}:${this.bookData.minutes}`;
            this.bookData.orderdate = `${hours}:${minutes}`;

            this.bookData.hotel = storeData.name;
            if (this.bookData.cabs < 1) {
                this.bookData.cabs = 1;
            }

            this.cabCounter(this.bookData.cabs);
            // console.log(this.bookData.cabdatacount);

            if (!this.bookData.destination) {
                this.warningMessage.push({
                    warnType: 'Error',
                    warnMsg: 'Please enter destination!',
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                    this.submitLoading = false;
                }, 3000);
                return;
            }
            // if (!this.bookData.bookingdate) {
            //     this.warningMessage.push({
            //         warnType: 'Error',
            //         warnMsg: 'Please enter journey date!',
            //     });
            //     setTimeout(() => {
            //         this.removeWarningMsg();
            //         this.submitLoading = false;
            //     }, 3000);
            //     return;
            // }


            // 


            // console.log(this.bookData.bookingdate);
            axios.post(this.BaseUrl + '/submitBooking', this.bookData).then((response) => {
                // console.log(response.data.status);

                if (response.data.status) {
                    // this.sendWebSocketData();
                    this.checkBookingOrder();
                }

                this.warningMessage.push({
                    warnType: response.data.status,
                    warnMsg: response.data.message,
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                }, 3000);

                this.bookData.description = '';


            }).finally(() => {
                this.submitLoading = false;
            });
        },

        async cancelOrder() {
            await axios.post(this.BaseUrl + '/cancelOrder', { hotelId: this.cancelId }).then((response) => {
                // console.log(this.getdestination[0].destname);
                if (response.data.status == 'Success') {
                    this.checkBookingOrder();
                    setTimeout(() => {
                        this.cancel = false;
                    }, 1500);

                }

                this.warningMessage.push({
                    warnType: response.data.status,
                    warnMsg: response.data.message,
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                }, 3000);
            }).finally(() => {
                // console.log(this.checkBooking);
            });
        },

        async checkBookingOrder() {
            const hotelname = JSON.parse(localStorage.getItem('clientLogin'));
            await axios.post(this.BaseUrl + '/checkBookingOrder', { hotel: hotelname.name }).then((response) => {
                this.checkBooking = JSON.parse(response.data.booking);
                const lastten = JSON.parse(response.data.booking);
                this.lastHistory = lastten.slice(0, 10);
            }).finally(() => {
                // this.submitLoading = false;
                // console.log(this.checkBooking);
            });
        },

        handleChangeDestination() {
            const newdata = this.getdestination.find(des => des.destname === this.bookData.destination);
            // console.log(this.bookData.cabs);
            this.cabrent = newdata.price;
            if (this.bookData.cabs < 1) {
                this.totalrent = newdata.price;
            } else {
                this.totalrent = this.bookData.cabs * newdata.price;
            }
            // this.totalrent = this.bookData.cabs * newdata.price;
            this.bookData.rent = this.totalrent;
        },
        clientlogout() {
            localStorage.removeItem('clientLogin')
            this.$router.push("/login");
        },
        isEven(index) {
            return index % 2 === 0;
        },
        isOdd(index) {
            return index % 2 !== 0;
        },

        // connectWebSocket() {
        //     // Use your WebSocket server URL
        //     // this.socket.connection = new WebSocket("wss://book.taxikone.com:8080");
        //     this.socket.connection = new WebSocket("ws://localhost:8080");
        //     // console.log('WebSocket Object:', this.socket.connection);

        //     this.socket.connection.onopen = (e) => {
        //         // console.log("Connection established!");
        //         this.socket.isConnected = true;
        //         // You can send any initial messages or perform actions here
        //     };

        //     // this.socket.connection.onmessage = (e) => {
        //     //     console.log(e.data);
        //     //     this.$emit('websocket-data', e.data);
        //     // };
        //     this.socket.connection.onmessage = (e) => {
        //         // console.log(e.data+'::send socket data');
        //         this.$store.commit('setWebsocketData', JSON.parse(e.data));
        //     };

        //     this.socket.connection.onclose = (e) => {
        //         // console.error('WebSocket connection closed front.', e);
        //         this.socket.isConnected = false;
        //     };

        //     this.socket.connection.onerror = (e) => {
        //         console.error('WebSocket error:', e);
        //     };
        // },


        // // Method to send data to the WebSocket server
        // sendWebSocketData() {
        //     if (this.socket.isConnected) {
        //         const dataToSend = {
        //             value: 'WEBSOCKET',
        //         };
        //         // Convert the data to a JSON string before sending
        //         const jsonData = JSON.stringify(dataToSend);
        //         // Send the data over WebSocket
        //         this.socket.connection.send(jsonData);

        //         // console.log('Data sent over WebSocket:', dataToSend);
        //     } else {
        //         console.error('Something went wrong!');
        //         // Handle the case when the WebSocket connection is not open
        //     }
        // },
    },
    components: {
        Warning,
        Modal,
    },
    watch: {
        'bookData.cabs'(olddate, newdate) {
            this.handleChangeDestination();
        },
        '$store.state.websocketData': function (newValue) {
            // console.log('Store data changed:', newValue);
            // Handle the updated data
        }
    },
}
</script>

<style>
.warningMsgComp {
    z-index: 99999999;
}

.modalBody-main {
    background: rgb(253 164 175);
}

.modalHeader-main {
    background-color: rgb(244 114 182) !important;
    margin-bottom: 0px !important;
}

.modalHeader-main h1 {
    color: white;
    padding: 15px 0px;
}
</style>