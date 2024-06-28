<template>
    <div class="">
        <div class="warningMsgComp">
            <TransitionGroup name="warnMsgTrn" tag="div">
                <Warning v-for="(warn, index) in warningMessage" :key="index" :warningType="warn.warnType"
                    :warningMsg="warn.warnMsg"></Warning>
            </TransitionGroup>
        </div>

        <h1 class="custom-text bg-slate-300 font-semibold text-center p-4 text-3xl">Destination Panel</h1>
        <div class="flex w-full justify-end pr-4">
            <button @click="addopenmodal = true"
                class="py-2 px-4 text-xl bg-purple-600 hover:bg-purple-500 active:bg-purple-600 active:text-gray-400 drop-shadow shadow text-white rounded mt-2">Add
                Destination</button>
        </div>
        <div class="w-full flex-wrap mt-4 flex">
            <div class="w-full flex font-semibold bg-purple-400 border-b border-gray-300 py-2">
                <div class="flex-auto w-3/4 md:w-5/6 pl-2">Destination</div>
                <div class="flex-auto w-1/4 md:w-1/6 pl-2">Action</div>
            </div>
            <div v-for="(destination, index) in getdestination" :key="index" :class="{ 'bg-indigo-200': isEven(index), 'bg-fuchsia-200': isOdd(index) }" class="w-full flex border-b border-gray-100 text-base py-1">
                <div class="flex-auto w-3/4 md:w-5/6 pl-2">{{ destination.destname }}</div>
                <div class="flex-auto w-1/4 md:w-1/6 pl-2">
                    <button @click="openDestinationModal(destination)"
                        class="bg-yellow-500 hover:bg-yellow-400 active:bg-yellow-500 px-2 sm:py-1 mr-2  rounded text-slate-700">Edit</button>
                    <button @click="deleteopenmodal = true, deleteDataDestination = destination.id"
                        class="bg-red-500 hover:bg-red-400 active:bg-red-500 px-2 sm:py-1 mt-1 mr-1 text-white rounded">Delete</button>
                </div>
            </div>
            <Pagination v-if="ispagination" :page-button="totalpage" :previous="previouspage" :next="nextpage"
                :currentpage="currentpage" @pageChanged="onPageClick" :ispre="ispredisable" :isnext="isnextdisable"
                :iscurrent="iscurrenttab">
            </Pagination>
        </div>

        <div class="flex w-full justify-end pr-4 mt-24">
            <button @click="openmodal = true"
                class="py-2 px-4 text-xl bg-purple-600 hover:bg-purple-500 active:bg-purple-600 active:text-gray-400 drop-shadow shadow text-white rounded mt-2">Set
                Destination</button>
        </div>
        <div class="w-full mt-4 sm:hidden">
            <div v-for="(getSets, index) in getSet" :key="index" :class="{ 'bg-indigo-200': isEven(index), 'bg-fuchsia-200': isOdd(index) }" class="flex w-full">
                <div class="w-1/2 flex flex-col font-semibold">
                    <div class=" pl-2 border-b">Hotel Name</div>
                    <div class=" pl-2 border-b">Destination</div>
                    <div class=" pl-2 border-b">Price</div>
                    <div class=" pl-2 border-b">Status</div>
                    <div class=" pl-2 border-b">Action</div>
                </div>
                <div class="w-1/2 flex flex-col">
                    <div class="pl-2 border-b">{{ getSets.clientname }}</div>
                    <div class="pl-2 border-b">{{ getSets.destname }}</div>
                    <div class="pl-2 border-b">€{{ getSets.price }}</div>
                    <div class="pl-2 border-b" :class="{ 'text-red-600': getSets.status == 0 }">{{ getSets.status == 1 ? 'Active' : 'Inactive' }}</div>
                    <div class="pl-2 border-b h-8">
                        <button @click="openEditModal(getSets)"
                            class="bg-yellow-500 hover:bg-yellow-400 active:bg-yellow-500 px-2 mr-2 rounded text-slate-700 mt-1">Edit</button>
                        <button @click="deletemodal = true, deletegetset = getSets.id"
                            class="bg-red-500 hover:bg-red-400 active:bg-red-500 px-2 text-white rounded mt-1">Delete</button>
                    </div>
                </div>
                <Pagination v-if="setispagination" :page-button="settotalpage" :previous="setpreviouspage" :next="setnextpage"
                    :currentpage="setcurrentpage" @pageChanged="setonPageClick" :ispre="setispredisable" :isnext="setisnextdisable"
                    :iscurrent="setiscurrenttab">
                </Pagination>
            </div>
        </div>
        <div class="w-full flex-wrap mt-4 hidden sm:flex">
            <div class="w-full flex font-semibold bg-purple-400 border-b border-gray-300 py-2">
                <div class="flex-auto w-72 pl-2">Hotel Name</div>
                <div class="flex-auto w-32 pl-2">Destination</div>
                <div class="flex-auto w-32 pl-2">Price</div>
                <div class="flex-auto w-32 pl-2">Status</div>
                <div class="flex-auto w-36 pl-2">Action</div>
            </div>
            <div v-for="(getSets, index) in getSet" :key="index" :class="{ 'bg-indigo-200': isEven(index), 'bg-fuchsia-200': isOdd(index) }" class="w-full flex border-b border-gray-100 text-base py-1">
                <div class="flex-auto w-72 pl-2">{{ getSets.clientname }}</div>
                <div class="flex-auto w-32 pl-2">{{ getSets.destname }}</div>
                <div class="flex-auto w-32 pl-2">€{{ getSets.price }}</div>
                <div class="flex-auto w-32 pl-2" :class="{ 'text-red-600': getSets.status == 0 }">{{ getSets.status == 1 ? 'Active' : 'Inactive' }}</div>
                <div class="flex-auto w-36 pl-2">
                    <button @click="openEditModal(getSets)"
                        class="bg-yellow-500 hover:bg-yellow-400 active:bg-yellow-500 px-2 py-1 mr-2 rounded text-slate-700">Edit</button>
                    <button @click="deletemodal = true, deletegetset= getSets.id"
                        class="bg-red-500 hover:bg-red-400 active:bg-red-500 px-2 py-1 text-white rounded">Delete</button>
                </div>
            </div>
            <Pagination v-if="setispagination" :page-button="settotalpage" :previous="setpreviouspage" :next="setnextpage"
                :currentpage="setcurrentpage" @pageChanged="setonPageClick" :ispre="setispredisable" :isnext="setisnextdisable"
                :iscurrent="setiscurrenttab">
            </Pagination>
        </div>
        
        <!--------add desti modal -------->
        <Modal :modalShowHide="addopenmodal" @modalShowHide="addopenmodal = $event" modal-header="Add Destination">
            <form class="w-full" @submit.prevent="addDestination">
                <div class="m-2 sm:w-96 text-gray-700">
                    <div class="w-full flex flex-wrap mt-4">
                        Destination
                        <input v-model="destination.destname"
                            class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2"
                            type="text" placeholder="Enter Destination">
                    </div>
                    <!--<div class="w-full flex flex-wrap mt-4">
                        Status
                        <select v-model="destination.deststatus" class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>-->
                    <div class="w-full my-4 flex">
                        <button class="w-full py-2 px-4 text-xl bg-orange-600 hover:bg-orange-500 active:bg-orange-600 active:text-gray-400 drop-shadow shadow text-white rounded mt-2">Submit</button>
                    </div>
                </div>
            </form>
        </Modal>

        <!--------edit desti modal -------->
        <Modal :modalShowHide="editopenmodal" @modalShowHide="editopenmodal = $event" modal-header="Edit Destination" modalStyle="slide-fade">
            <form class="w-full" @submit.prevent="editDestination">
                <div class="m-2 sm:w-96 text-gray-700">
                    <div class="w-full flex flex-wrap mt-4">
                        Destination
                        <input v-model="editdestination.destname"
                            class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2"
                            type="text" placeholder="Enter Destination">
                    </div>
                    <!--<div class="w-full flex flex-wrap mt-4">
                        Status
                        <select v-model="editdestination.deststatus" class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>-->
                    <div class="w-full my-4">
                        <button class="w-full py-2 px-4 text-xl bg-orange-600 hover:bg-orange-500 active:bg-orange-600 active:text-gray-400 drop-shadow shadow text-white rounded mt-2">Submit</button>
                    </div>
                </div>
            </form>
        </Modal>

        <!------- delete desti modal------>
        <Modal :modalShowHide="deleteopenmodal" @modalShowHide="deleteopenmodal = $event" modal-header="Delete Destination" modalStyle="bounce">
            <form class="w-full" @submit.prevent="deleteDestination">
                <div class="m-2 sm:w-96 text-gray-700">
                    <h1 class="w-full text-center text-2xl text-slate-800 drop-shadow my-10">Are you sure want to delete Destination
                        !</h1>
                    <div class="w-full flex mt-24">
                        <button @click.prevent="deleteopenmodal = false"
                            class="w-1/2 py-2 px-4 mr-2 text-xl bg-green-600 hover:bg-green-500 active:bg-green-600 active:text-gray-400 drop-shadow shadow text-white rounded mt-2">No</button>
                        <input v-model="deleteDataDestination" type="hidden">
                        <button
                            class="w-1/2 py-2 px-4 ml-2 text-xl bg-red-600 hover:bg-red-500 active:bg-red-600 active:text-gray-400 drop-shadow shadow text-white rounded mt-2">Yes</button>
                    </div>
                </div>
            </form>
        </Modal>

        <!------------- set destination -------------->
        <Modal :modalShowHide="openmodal" @modalShowHide="openmodal = $event" modal-header="Set Destination">
            <form class="w-full" @submit.prevent="setDestination">
                <div class="m-2 sm:w-96 text-gray-700">
                    <div class="w-full flex flex-wrap mt-4">
                        Hotel Name
                        <select v-model="setDesti.clientname" class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2">
                            <option v-for="(clname, index) in clientName" :key="index" :data-role="clname.id">{{ clname.name }}</option>
                        </select>
                    </div>
                    <div class="w-full flex flex-wrap mt-4">
                        Destination
                        <select v-model="setDesti.destname" class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2">
                            <option v-for="(getidnameDest, index) in getdestination" :key="index" :data-role="getidnameDest.id">{{ getidnameDest.destname }}</option>
                        </select>
                    </div>
                    <div class="w-full flex flex-wrap mt-4">
                        Price
                        <input v-model="setDesti.price" class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2"
                            type="text" placeholder="Enter Price">
                    </div>
                    <div class="w-full flex flex-wrap mt-4">
                        Status
                        <select v-model="setDesti.status" class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="w-full my-4">
                        <button
                            class="w-full py-2 px-4 text-xl bg-orange-600 hover:bg-orange-500 active:bg-orange-600 active:text-gray-400 drop-shadow shadow text-white rounded mt-2">Submit</button>
                    </div>
                </div>
            </form>
        </Modal>

        <!-- ---------- edit destination modal ---------- -->
        <Modal :modalShowHide="editmodal" @modalShowHide="editmodal = $event" modal-header="Edit Destination Set" modalStyle="slide-fade">
            <form class="w-full" @submit.prevent="updateSetDest">
                <div class="m-2 sm:w-96 text-gray-700">
                    <div class="w-full flex flex-wrap mt-4">
                        Hotel Name
                        <select v-model="editgetSet.clientname" class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2">
                            <option v-for="(clname, index) in clientName" :key="index" :data-role="clname.id">{{ clname.name }}</option>
                        </select>
                    </div>
                    <div class="w-full flex flex-wrap mt-4">
                        Destination
                        <select v-model="editgetSet.destname" class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2">
                            <option v-for="(getidnameDest, index) in getdestination" :key="index" :data-role="getidnameDest.id">{{ getidnameDest.destname }}</option>
                        </select>
                    </div>
                    <div class="w-full flex flex-wrap mt-4">
                        Price
                        <input v-model="editgetSet.price" class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2"
                            type="text" placeholder="Enter Price">
                    </div>
                    <div class="w-full flex flex-wrap mt-4">
                        Status
                        <select v-model="editgetSet.status" class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="w-full my-4">
                        <button
                            class="w-full py-2 px-4 text-xl bg-orange-600 hover:bg-orange-500 active:bg-orange-600 active:text-gray-400 drop-shadow shadow text-white rounded mt-2">Submit</button>
                    </div>
                </div>
            </form>
        </Modal>

        <!-- ------------ delete modal -------- -->
        <Modal :modalShowHide="deletemodal" @modalShowHide="deletemodal = $event" modal-header="Delete Destination" modalStyle="bounce">
            <form class="w-full" @submit.prevent="deleteSetDest">
                <div class="m-2 sm:w-96 text-gray-700">
                    <h1 class="w-full text-center text-2xl text-slate-800 drop-shadow my-10">Are you sure want to delete Destination
                        !</h1>
                    <div class="w-full flex mt-24">
                        <button @click.prevent="deletemodal = false"
                            class="w-1/2 py-2 px-4 mr-2 text-xl bg-green-600 hover:bg-green-500 active:bg-green-600 active:text-gray-400 drop-shadow shadow text-white rounded mt-2">No</button>
                        <input v-model="deletegetset" type="hidden">
                        <button
                            class="w-1/2 py-2 px-4 ml-2 text-xl bg-red-600 hover:bg-red-500 active:bg-red-600 active:text-gray-400 drop-shadow shadow text-white rounded mt-2">Yes</button>
                    </div>
                </div>
            </form>
        </Modal>
    </div>
</template>

<script>
import Modal from './Modal.vue';
import Warning from './Warning.vue';
import axios from 'axios';
import Pagination from './Pagination.vue';

export default {
    data() {
        return {
            addopenmodal: false,
            editopenmodal: false,
            deleteopenmodal: false,
            openmodal: false,
            editmodal: false,
            deletemodal: false,
            deleteDataDestination: '',

            getdes: [],
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

            setgetdes: [],
            setispagination: true,
            settotalpage: 0,
            setperPageData: 10,
            setpreviouspage: 0,
            setnextpage: 0,
            setcurrentpage: 0,
            setispredisable: true,
            setisnextdisable: false,
            setiscurrenttab: 1,
            setpagiIndex: 1,
            setpagiLimit: this.setperPageData,
            
            setDesti: {
                clientname: '',
                destname: '',
                price: '',
                status: 1,
                destiname: '',
                clientId: '',
            },
            setupDesti: [],
            

            warningMessage: [],
            clientName: [],
            getSet: [],
            editgetSet: [],
            deletegetset: '',

            submitLoading: false,
            setLoading: false,

            getdestination:[],
            editdestination:[],
            destination: {
                destname: '',
                deststatus: 1,
            },

            BaseUrl: 'http://localhost:8000',
            contentheader: {
                'X-H': '1234',
            }
        }
    },
    components: {
        Modal,
        Warning,
        Pagination,
    },
    created() {
        if (!localStorage.getItem('loginInfo')) {
            this.$router.push('/dashboard/login');
        }
        this.BaseUrl = this.$hostname;
        this.getDestination();
        this.getClientName();
        this.getSetDest();
        
    },
    methods: {
        removeWarningMsg() {
            this.warningMessage.shift();
        },
        async getClientName() {
            await axios.get(this.BaseUrl + '/dashboard/getClientName', { headers: this.contentheader }).then((response) => {
                this.clientName = JSON.parse(response.data.clientName);
                this.setDesti.clientname = this.clientName[0].name;
            }).finally(() => {
                // console.log(this.clientName);
            });
        },
        addDestination() {
            if (!this.destination.destname) {
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
            // if (this.destination.deststatus != 0 && this.destination.deststatus != 1) {
            //     this.warningMessage.push({
            //         warnType: 'Error',
            //         warnMsg: 'Please select status!',
            //     });
            //     setTimeout(() => {
            //         this.removeWarningMsg();
            //         this.submitLoading = false;
            //     }, 3000);
            //     return;
            // }

            axios.post(this.BaseUrl + '/dashboard/addDestination', this.destination).then((response) => {
                // console.log(response.data.message);
                // console.log(response.data);
                this.getDestination();
                this.warningMessage.push({
                    warnType: response.data.status,
                    warnMsg: response.data.message,
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                }, 3000);
                setTimeout(() => {
                    // this.addopenmodal = false;
                    this.destination.destname = '';
                    this.destination.deststatus = 1;
                }, 1000);

            }).finally(() => {
                this.submitLoading = false;
                //this.getProductBySupplier = [];
            });
        },
        editDestination() {
            if (!this.editdestination.destname) {
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
            if (this.editdestination.deststatus != 0 && this.editdestination.deststatus != 1) {
                this.warningMessage.push({
                    warnType: 'Error',
                    warnMsg: 'Please select status!',
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                    this.submitLoading = false;
                }, 3000);
                return;
            }
            axios.post(this.BaseUrl + '/dashboard/updateDestination', this.editdestination).then((response) => {
                // console.log(response.data);
                this.getDestination();
                this.warningMessage.push({
                    warnType: response.data.status,
                    warnMsg: response.data.message,
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                }, 3000);
                setTimeout(() => {
                    this.editopenmodal = false;
                }, 1000);

            }).finally(() => {
                this.submitLoading = false;
                //this.getProductBySupplier = [];
            });
        },
        async getDestination() {
            await axios.get(this.BaseUrl + '/dashboard/getDestination', { headers: this.contentheader }).then((response) => {
                this.getdes = JSON.parse(response.data.getDestination);
                this.setDesti.destname = this.getdes[0].destname;

                let totalData = this.getdes.length;
                this.totalpage = Math.ceil(totalData / this.perPageData);

                this.currentpage = 1;
                this.previouspage = 1;
                this.nextpage = 2;
                this.iscurrenttab = 1;

                this.ispredisable = true;
                if (this.totalpage < 2) {
                    this.isnextdisable = true;
                } else {
                    this.isnextdisable = false;
                }
                
                // this.getOrders = response.data.bookingData;
                this.getdestination = this.getdes.slice(0, this.perPageData);
                this.ispagination = true;
            }).finally(() => {
                // console.log(this.setDesti.destname);
            });
        },

        openDestinationModal(destination) {
            // Copy the data to the modal
            this.editdestination = { ...destination };
            this.editopenmodal = true;
        },
        deleteDestination() {
            axios.delete(this.BaseUrl + '/dashboard/deleteDestination', { data: { deleteDataId: this.deleteDataDestination }, headers: this.contentheader }).then((response) => {
                // console.log(response.data.getUser);
                this.getDestination();
                this.warningMessage.push({
                    warnType: response.data.status,
                    warnMsg: response.data.message,
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                }, 3000);
                setTimeout(() => {
                    this.deleteopenmodal = false;
                }, 1000);
            }).finally(() => {

            });
        },
        setDestination() {
            const selectedDest = this.setDesti.destname;
            this.setDesti.destiname = this.getdestination.find(dest => dest.destname === selectedDest)?.id;

            const sedestid = this.setDesti.clientname;
            this.setDesti.clientId = this.clientName.find(destid => destid.name === sedestid)?.id;

            if (!this.setDesti.clientname) {
                this.warningMessage.push({
                    warnType: 'Error',
                    warnMsg: 'Please select client!',
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                    this.setLoading = false;
                }, 3000);
                return;
            }
            if (!this.setDesti.destname) {
                this.warningMessage.push({
                    warnType: 'Error',
                    warnMsg: 'Please select destination!',
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                    this.setLoading = false;
                }, 3000);
                return;
            }
            if (!this.setDesti.price) {
                this.warningMessage.push({
                    warnType: 'Error',
                    warnMsg: 'Please enter price!',
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                    this.setLoading = false;
                }, 3000);
                return;
            }
            if (this.setDesti.status != 0 && this.setDesti.status != 1) {
                this.warningMessage.push({
                    warnType: 'Error',
                    warnMsg: 'Please select status!',
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                    this.setLoading = false;
                }, 3000);
                return;
            }

            // console.log(this.setDesti);

            axios.post(this.BaseUrl + '/dashboard/setDestination', this.setDesti).then((response) => {
                // console.log(response.data.message);
                // console.log(response.data);
                this.getSetDest();
                this.warningMessage.push({
                    warnType: response.data.status,
                    warnMsg: response.data.message,
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                }, 3000);
                setTimeout(() => {
                    // this.openmodal = false;
                    this.setDesti.price = '';
                    this.setDesti.status = 1;
                }, 1000);

            }).finally(() => {
                this.submitLoading = false;
                //this.getProductBySupplier = [];
            });
        },
        updateSetDest() {
            const selectedDest = this.editgetSet.destname;
            this.editgetSet.destiname = this.getdestination.find(dest => dest.destname === selectedDest)?.id;
            // console.log(dataRole);

            if (!this.editgetSet.clientname) {
                this.warningMessage.push({
                    warnType: 'Error',
                    warnMsg: 'Please select client!',
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                    this.setLoading = false;
                }, 3000);
                return;
            }
            if (!this.editgetSet.destname) {
                this.warningMessage.push({
                    warnType: 'Error',
                    warnMsg: 'Please select destination!',
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                    this.setLoading = false;
                }, 3000);
                return;
            }
            if (!this.editgetSet.price) {
                this.warningMessage.push({
                    warnType: 'Error',
                    warnMsg: 'Please enter price!',
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                    this.setLoading = false;
                }, 3000);
                return;
            }
            if (this.editgetSet.status != 0 && this.editgetSet.status != 1) {
                this.warningMessage.push({
                    warnType: 'Error',
                    warnMsg: 'Please select status!',
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                    this.setLoading = false;
                }, 3000);
                return;
            }
            axios.post(this.BaseUrl + '/dashboard/getSetUpdate', this.editgetSet).then((response) => {
                // console.log(response.data);
                this.getSetDest();
                this.warningMessage.push({
                    warnType: response.data.status,
                    warnMsg: response.data.message,
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                }, 3000);
                setTimeout(() => {
                    this.editmodal = false;
                }, 1000);

            }).finally(() => {
                this.submitLoading = false;
                //this.getProductBySupplier = [];
            });
        },
        async getSetDest() {
            await axios.get(this.BaseUrl + '/dashboard/getSetDest', { headers: this.contentheader }).then((response) => {
                this.setgetdes = JSON.parse(response.data.getSet);
                this.setupDesti = this.setgetdes;

                // this.setgetdes = JSON.parse(response.data.getDestination);
                // this.setDesti.destname = this.getdes[0].destname;

                let settotalData = this.setgetdes.length;
                this.settotalpage = Math.ceil(settotalData / this.setperPageData);

                this.setcurrentpage = 1;
                this.setpreviouspage = 1;
                this.setnextpage = 2;
                this.setiscurrenttab = 1;

                this.setispredisable = true;
                if (this.settotalpage < 2) {
                    this.setisnextdisable = true;
                } else {
                    this.setisnextdisable = false;
                }

                // this.getOrders = response.data.bookingData;
                this.getSet = this.setgetdes.slice(0, this.setperPageData);
                this.setispagination = true;
            }).finally(() => {
                // console.log(this.getSet);
            });
        },
        deleteSetDest() {
            axios.delete(this.BaseUrl + '/dashboard/deleteSetDest', { data: { deleteDataId: this.deletegetset }, headers: this.contentheader }).then((response) => {
                // console.log(response.data.getUser);
                this.getSetDest();
                this.warningMessage.push({
                    warnType: response.data.status,
                    warnMsg: response.data.message,
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                }, 3000);
                setTimeout(() => {
                    this.deletemodal = false;
                }, 1000);
            }).finally(() => {

            });
        },
        isEven(index) {
            return index % 2 === 0;
        },
        isOdd(index) {
            return index % 2 !== 0;
        },
        openEditModal(getSets) {
            // Copy the data to the modal
            this.editgetSet = { ...getSets };
            this.editmodal = true;
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

            this.getdestination = this.getdes.slice(this.pagiIndex, this.perPageData * page);

        },
        setonPageClick(page) {
            this.setcurrentpage = page;
            this.setiscurrenttab = page;
            if (page == 1) {
                this.setpreviouspage = this.setcurrentpage;
                this.setispredisable = true;
            } else {
                this.setpreviouspage = this.setcurrentpage - 1;
                this.setispredisable = false;
            }

            if (page == this.settotalpage) {
                this.setnextpage = this.setcurrentpage;
                this.setisnextdisable = true;
            } else {
                this.setnextpage = this.setcurrentpage + 1;
                this.setisnextdisable = false;
            }

            if (page == 1) {
                this.setpagiIndex = 0;
            } else {
                this.setpagiIndex = page * this.setperPageData - this.setperPageData;
            }

            this.getSet = this.setgetdes.slice(this.setpagiIndex, this.setperPageData * page);

        },
    }
}
</script>
    
<style>
    .custom-text {
        color: rgb(212, 84, 127);
    }
    .warningMsgComp {
        z-index: 9999999999;
        top: 10px;
    }
</style>