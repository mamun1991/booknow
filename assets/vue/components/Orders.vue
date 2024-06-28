<template>
    <div class="">
        <div class="warningMsgComp">
            <TransitionGroup name="warnMsgTrn" tag="div">
                <Warning v-for="(warn, index) in warningMessage" :key="index" :warningType="warn.warnType"
                    :warningMsg="warn.warnMsg"></Warning>
            </TransitionGroup>
        </div>

        <h1 class="custom-text bg-slate-300 font-semibold text-center p-4 text-3xl">Order Panel</h1>
        <div class="w-full mt-4 sm:hidden">
            <div v-for="(getOrder, index) in getOrders" :key="index"
                :class="{ 'bg-blue-400': getOrder.status === 1 && !curOrder(getOrder.time, getOrder.orderdate, getOrder.bookingdate, getOrder.status), 'bg-orange-400': getOrder.status === 0 && !curOrder(getOrder.time, getOrder.orderdate, getOrder.bookingdate, getOrder.status), 'bg-red-300': getOrder.status === 2 && !curOrder(getOrder.time, getOrder.orderdate, getOrder.bookingdate, getOrder.status), 'bg-lime-300': curOrder(getOrder.time, getOrder.orderdate, getOrder.bookingdate, getOrder.status) && getOrder.status === 1, 'bg-green-400': curOrder(getOrder.time, getOrder.orderdate, getOrder.bookingdate, getOrder.status) && (getOrder.status !== 1), }"
                class="flex w-full flex-col">
                <div class="w-full flex border-b border-gray-100">
                    <div class="w-1/2 flex-auto pl-2">Hotel Name</div>
                    <div class="w-1/2 flex-auto pl-2">{{ getOrder.hotel }}</div>
                </div>
                <div class="w-full flex border-b border-gray-100">
                    <div class="w-1/2 flex-auto pl-2">Destination</div>
                    <div class="w-1/2 flex-auto pl-2">{{ getOrder.destination }}</div>
                </div>
                <div class="w-full flex border-b border-gray-100">
                    <div class="w-1/2 flex-auto pl-2">Rent</div>
                    <div class="w-1/2 flex-auto pl-2">{{ getOrder.rent }}</div>
                </div>
                <div class="w-full flex border-b border-gray-100">
                    <div class="w-1/2 flex-auto pl-2">Cabs</div>
                    <div class="w-1/2 flex-auto pl-2">{{ getOrder.cabs }}</div>
                </div>
                <div class="w-full flex border-b border-gray-100">
                    <div class="w-1/2 flex-auto pl-2">Taxi</div>
                    <div class="w-1/2 flex-auto pl-2">{{ getOrder.cabdatacount }}</div>
                </div>
                <div class="w-full flex border-b border-gray-100">
                    <div class="w-1/2 flex-auto pl-2">Date</div>
                    <div class="w-1/2 flex-auto pl-2">{{ getOrder.bookingdate }} {{ getOrder.time }}</div>
                </div>
                <div class="w-full flex border-b border-gray-100">
                    <div class="w-1/2 flex-auto pl-2">Description</div>
                    <div class="w-1/2 flex-auto pl-2">{{ getOrder.description }}</div>
                </div>
                <div class="w-full flex border-b border-gray-100">
                    <div class="w-1/2 flex-auto pl-2">Status</div>
                    <div class="w-1/2 flex-auto pl-2">
                        <p v-if="getOrder.status == 0" class="px-2 py-1 w-16 text-center font-semibold text-green-800">
                            Approved</p>
                        <p v-else-if="getOrder.status == 2" class="px-2 py-1 w-16 text-center font-semibold text-red-800">
                            Cancelled</p>
                        <p v-else-if="getOrder.status == 1"
                            class="px-2 py-1 w-16 text-center font-semibold text-blue-900 animate-ping">Pending</p>
                        <p v-else-if="getOrder.status == 3" class="px-2 py-1 w-16 text-center font-semibold text-red-900">
                            Deleted</p>
                    </div>
                </div>
                <div class="w-full flex border-b border-gray-100 py-2">
                    <div class="w-1/2 flex-auto pl-2">Action</div>
                    <div class="w-1/2 flex-auto pl-2">
                        <button @click="approvedOrder(getOrder.id, 2, index)"
                            class="px-2 py-1 mr-1 bg-blue-600 hover:bg-blue-500 active:bg-blue-700 border-blue-500 hover:border-blue-600 active:border-blue-800 font-semibold text-white text-sm text-center rounded drop-shadow shadow">Cancel</button>
                        <button @click="approvedOrder(getOrder.id, 0, index)"
                            class="px-2 py-1 mr-1 bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700 border-emerald-500 hover:border-emerald-600 active:border-emerald-800 font-semibold text-sm text-white text-center rounded drop-shadow shadow">Approve</button>
                        <button @click="action = true, actionid = getOrder.id, deleteindex = index"
                            class="px-2 py-1 bg-rose-700 hover:bg-rose-500 active:bg-rose-700 border-rose-500 hover:border-rose-600 active:border-rose-800 font-semibold text-white text-sm text-center rounded drop-shadow shadow">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full flex-wrap mt-4 hidden text-sm sm:flex">
            <div class="w-full flex font-semibold bg-purple-400 border-b border-gray-300 py-2">
                <div class="flex-auto w-2/12 pl-2">Client Name</div>
                <div class="flex-auto w-1/12 pl-2">Dest.</div>
                <div class="flex-auto w-1/12 pl-2">Price</div>
                <div class="flex-auto w-1/12 pl-2">Cabs</div>
                <div class="flex-auto w-1/12 pl-2">Date</div>
                <div class="flex-auto w-2/12 pl-2">Description</div>
                <div class="flex-auto w-1/12 pl-2">Taxi</div>
                <div class="flex-auto w-2/12 pl-2 text-center">Status</div>
                <div class="flex-auto w-1/12 pl-2 text-center">Action</div>
            </div>
            <div v-for="(getOrder, index) in getOrders" :key="index"
                :class="{ 'bg-blue-400': getOrder.status === 1 && !curOrder(getOrder.time, getOrder.orderdate, getOrder.bookingdate, getOrder.status), 'bg-orange-400': getOrder.status === 0 && !curOrder(getOrder.time, getOrder.orderdate, getOrder.bookingdate, getOrder.status), 'bg-red-300': getOrder.status === 2 && !curOrder(getOrder.time, getOrder.orderdate, getOrder.bookingdate, getOrder.status), 'bg-lime-300': curOrder(getOrder.time, getOrder.orderdate, getOrder.bookingdate, getOrder.status) && getOrder.status === 1, 'bg-green-400': curOrder(getOrder.time, getOrder.orderdate, getOrder.bookingdate, getOrder.status) && (getOrder.status !== 1), }"
                class="w-full flex border-b border-gray-100 text-sm py-1">
                <div class="flex-auto w-2/12 pl-2">{{ getOrder.hotel }}</div>
                <div class="flex-auto w-1/12 pl-2">{{ getOrder.destination }}</div>
                <div class="flex-auto w-1/12 pl-2">{{ getOrder.rent }}</div>
                <div class="flex-auto w-1/12 pl-2">{{ getOrder.cabs }}</div>
                <div class="flex-auto w-1/12 pl-2">{{ getOrder.bookingdate }} {{ getOrder.time }}</div>
                <div class="flex-auto w-2/12 pl-2">{{ getOrder.description }}</div>
                <div class="flex-auto w-1/12 pl-2">{{ getOrder.cabdatacount }}</div>
                <div class="flex-auto w-2/12 pl-2 flex items-center justify-center">
                    <p v-if="getOrder.status == 0" class="px-2 py-1 w-16 text-center font-semibold text-green-800">Approved
                    </p>
                    <p v-else-if="getOrder.status == 2" class="px-2 py-1 w-16 text-center font-semibold text-red-800">
                        Cancelled</p>
                    <p v-else-if="getOrder.status == 1"
                        class="px-2 py-1 w-16 text-center font-semibold text-blue-900 animate-ping">Pending</p>
                    <p v-else-if="getOrder.status == 3" class="px-2 py-1 w-16 text-center font-semibold text-red-900">
                        Deleted</p>
                </div>
                <div class="flex-auto w-1/12 pl-2 text-yellow-600 grid items-center justify-center">
                    <button @click="approvedOrder(getOrder.id, 2, index)"
                        class="px-2 py-1 mb-1 w-16 bg-blue-600 hover:bg-blue-500 active:bg-blue-700 border-blue-500 hover:border-blue-600 active:border-blue-800 font-semibold text-white text-sm text-center rounded drop-shadow shadow">Cancel</button>
                    <button @click="approvedOrder(getOrder.id, 0, index)"
                        class="px-2 py-1 mb-1 w-16 bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700 border-emerald-500 hover:border-emerald-600 active:border-emerald-800 font-semibold text-sm text-white text-center rounded drop-shadow shadow">Approve</button>
                    <button @click="action = true, actionid = getOrder.id, deleteindex = index"
                        class="px-2 py-1 w-16 bg-rose-700 hover:bg-rose-500 active:bg-rose-700 border-rose-500 hover:border-rose-600 active:border-rose-800 font-semibold text-white text-sm text-center rounded drop-shadow shadow">Delete</button>
                    <!--<p v-else-if="getOrder.status == 0" class="px-2 py-1 w-24 text-center bg-emerald-600 rounded drop-shadow shadow text-green-400">Approved</p>
                <p v-else-if="getOrder.status == 2" class="px-2 py-1 w-24 text-center bg-rose-700 rounded drop-shadow shadow text-gray-400">Cancelled</p>-->
                </div>
            </div>
            <Pagination v-if="ispagination" :page-button="totalpage" :previous="previouspage" :next="nextpage"
                :currentpage="currentpage" @pageChanged="onPageClick" :ispre="ispredisable" :isnext="isnextdisable"
                :iscurrent="iscurrenttab">
            </Pagination>
        </div>
        <Modal :modalShowHide="action" @modalShowHide="action = $event" modal-header="Order Delete" modalStyle="bounce">
            <div class="m-2 sm:w-96 text-gray-700">
                <form @submit.prevent="approvedOrder(this.actionid, 3, this.deleteindex)" class="w-full">
                    <h1 class="w-full text-center text-2xl text-slate-800 drop-shadow my-10">Are you sure want to delete
                        Order!</h1>
                    <input v-model="actionid" type="hidden">
                    <div class="w-full flex mt-24">
                        <button @click.prevent="action = false"
                            class="w-1/2 py-2 px-4 mr-2 text-xl bg-green-600 hover:bg-green-500 active:bg-green-600 active:text-gray-400 drop-shadow shadow text-white rounded mt-2">No</button>
                        <button
                            class="w-1/2 py-2 px-4 ml-2 text-xl bg-red-600 hover:bg-red-500 active:bg-red-600 active:text-gray-400 drop-shadow shadow text-white rounded mt-2">Yes</button>
                    </div>
                </form>
            </div>
        </Modal>

        <!-------<audio v-if="loadAudio" class="invisible" ref="audio" autoplay loop controls src="https://www.soundjay.com/misc/sounds/censor-beep-2.mp3"></audio>
        <audio v-if="loadAudio" class="invisible" ref="audio" autoplay loop controls src="https://www.soundjay.com/misc/sounds/bell-ringing-05.mp3"></audio>
        <audio v-if="loadAudio" class="invisible" ref="audio" autoplay loop controls src="https://www.soundjay.com/misc/sounds/magic-chime-03.mp3"></audio>
        <audio v-if="loadAudio" class="invisible" ref="audio" autoplay loop controls src="https://www.soundjay.com/misc/sounds/magic-chime-02.mp3"></audio>-->
        <audio class="invisible" ref="audio" loop controls
            src="https://www.soundjay.com/misc/sounds/magic-chime-02.mp3"></audio>
    </div>
</template>

<script>
import axios from 'axios';
import Modal from './Modal.vue';
import Warning from './Warning.vue';
import Pagination from './Pagination.vue';
export default {
    data() {
        return {
            warningMessage: [],
            getOrders: [],
            getOrd: [],
            approveid: '',

            ispagination: true,
            totalpage: 0,
            perPageData: 10,
            previouspage: 0,
            nextpage: 0,
            currentpage: 0,
            ispredisable: true,
            isnextdisable: false,
            iscurrenttab: 1,
            pagiIndex: 1,
            pagiLimit: this.perPageData,

            action: false,
            actionid: '',
            selectedButton: null,
            pendingOrder: 0,
            reloadData: 0,

            deleteindex: 0,

            playaudio: 0,
            pauseaudio: 0,

            BaseUrl: 'http://localhost:8000',
            contentheader: {
                'X-H': '1234',
            },
        }
    },
    created() {
        if (!localStorage.getItem('loginInfo')) {
            this.$router.push('/dashboard/login');
        }
        this.BaseUrl = this.$hostname;
        this.getAllOrders();

        setInterval(() => {
            this.getRealNotification();
        }, 10000);

    },

    components: {
        Warning,
        Pagination,
        Modal,
    },
    methods: {
        removeWarningMsg() {
            this.warningMessage.shift();
        },

        selectButton(button) {
            this.selectedButton = button;
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
                return true;
            }
            if (orderhour == lesshour && lessfinalMinutes >= minute) {
                return true;
            }
        },

        async getAllOrders() {
            await axios.get(this.BaseUrl + '/dashboard/getAllOrders', { headers: this.contentheader }).then((response) => {
                // console.log(response.data.getAdmin);
                this.getOrd = JSON.parse(response.data.bookingData);

                let totalData = this.getOrd.length;
                this.totalpage = Math.ceil(totalData / this.perPageData);

                this.currentpage = 1;
                this.previouspage = 1;
                this.nextpage = 2;
                this.iscurrenttab = 1;

                this.ispredisable = true;
                this.isnextdisable = false;
                // this.getOrders = response.data.bookingData;
                this.getOrders = this.getOrd.slice(0, this.perPageData);
                this.ispagination = true;
            }).finally(() => {

            });
        },
        approvedOrder(order, id, index) {
            // console.log(id);
            // console.log(this.actionid);
            axios.post(this.BaseUrl + '/dashboard/updateOrderStatus', { orderid: order, action: id }).then((response) => {
                // console.log(response.data);
                if (response.data.status == 'Success') {
                    // this.getAllOrders();

                    this.warningMessage.push({
                        warnType: response.data.status,
                        warnMsg: response.data.message,
                    });
                    setTimeout(() => {
                        this.removeWarningMsg();
                    }, 3000);
                    setTimeout(() => {
                        this.action = false;
                    }, 1000);

                    const getOrder = this.getOrders[index];
                    getOrder.status = id;

                    this.pendingOrder = this.pendingOrder - 1;
                    if (this.pendingOrder < 1) {
                        this.$refs.audio.pause();
                        this.$refs.audio.currentTime = 0;
                    }
                }
            }).finally(() => {
                // this.submitLoading = false;
                //this.getProductBySupplier = [];
                this.selectedButton = null;
            });
        },
        deleteOrder() {

        },
        getRealNotification() {
            axios.post(this.BaseUrl + '/dashboard/getRealNotificationUpdate').then((response) => {
                let d = this.$refs.audio;
                if (response.data.order) {
                    this.pendingOrder = response.data.order;
                    this.$refs.audio.play();
                    // console.log('active order');
                }
                else {
                    this.$refs.audio.pause();
                    this.$refs.audio.currentTime = 0;
                    // console.log('pending order');
                }
             
                if (response.data.order != this.reloadData) {
                    this.getAllOrders();
                    this.reloadData = response.data.order
                }
            });
        },
        isEven(index) {
            return index % 2 === 0;
        },
        isOdd(index) {
            return index % 2 !== 0;
        },


        onPageClick(page) {
            this.currentpage = page;
            this.iscurrenttab = page;
            if (page == 1) {
                this.previouspage = this.currentpage;
                this.ispredisable = true;
            } else {
                this.previouspage = this.currentpage - 1;
                this.ispredisable = false;
            }

            if (page == this.totalpage) {
                this.nextpage = this.currentpage;
                this.isnextdisable = true;
            } else {
                this.nextpage = this.currentpage + 1;
                this.isnextdisable = false;
            }

            if (page == 1) {
                this.pagiIndex = 0;
            } else {
                this.pagiIndex = page * this.perPageData - this.perPageData;
            }

            this.getOrders = this.getOrd.slice(this.pagiIndex, this.perPageData * page);

        },
    },
}
</script>

<style>
.custom-text {
    color: rgb(212, 84, 127);
}

.warningMsgComp {
    top: 10px;
}
</style>