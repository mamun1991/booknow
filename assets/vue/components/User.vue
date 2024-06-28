<template>
    <div class="">
        <div class="warningMsgComp">
            <TransitionGroup name="warnMsgTrn" tag="div">
                <Warning v-for="(warn, index) in warningMessage" :key="index" :warningType="warn.warnType"
                    :warningMsg="warn.warnMsg"></Warning>
            </TransitionGroup>
        </div>
        <h1 class="custom-text bg-slate-300 font-semibold text-center p-4 text-3xl">Hotel Panel</h1>
        <div class="flex w-full justify-end pr-4">
            <button @click="openmodal = true"
                class="py-2 px-4 text-xl bg-purple-600 hover:bg-purple-500 active:bg-purple-600 active:text-gray-400 drop-shadow shadow text-white rounded mt-2">Add
                Hotel</button>
        </div>
        <div class="w-full mt-4 sm:hidden">
            <div v-for="(getuser, index) in getUsers" :key="index"
                :class="{ 'bg-indigo-200': isEven(index), 'bg-fuchsia-200': isOdd(index) }" class="flex w-full">
                <div class="w-1/2 flex flex-col font-semibold">
                    <div class=" pl-2 border-b">Name</div>
                    <div class=" pl-2 border-b">Password</div>
                    <div class=" pl-2 border-b">Status</div>
                    <div class=" pl-2 border-b h-8">Action</div>
                </div>
                <div class="w-1/2 flex flex-col">
                    <div class="pl-2 border-b">{{ getuser.name }}</div>
                    <div class="pl-2 border-b">{{ getuser.password }}</div>
                    <div class="pl-2 border-b">{{ getuser.status == 1 ? 'Active' : 'Inactive' }}</div>
                    <div class="pl-2 border-b h-8">
                        <button @click="openEditModal(getuser)"
                            class="bg-yellow-500 hover:bg-yellow-400 active:bg-yellow-500 px-2 mr-2 rounded text-slate-700 mt-1">Edit</button>
                        <button @click="deletemodal = true, deleteDataId = getuser.id"
                            class="bg-red-500 hover:bg-red-400 active:bg-red-500 px-2 text-white rounded mt-1">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full flex-wrap mt-4 hidden sm:flex">
            <div class="w-full flex font-semibold bg-purple-400 border-b border-gray-300 py-2">
                <div class="flex-auto w-64 pl-2">Name</div>
                <div class="flex-auto w-32 pl-2">Password</div>
                <div class="flex-auto w-24 pl-2">Status</div>
                <div class="flex-auto w-36 pl-2">Action</div>
            </div>
            <div v-for="(getuser, index) in getUsers" :key="index"
                :class="{ 'bg-indigo-200': isEven(index), 'bg-fuchsia-200': isOdd(index) }"
                class="w-full flex  border-b border-gray-100 text-base py-1">
                <div class="flex-auto w-64 pl-2">{{ getuser.name }}</div>
                <div class="flex-auto w-32 pl-2">{{ getuser.password }}</div>
                <div class="flex-auto w-24 pl-2" :class="{ 'text-red-600': getuser.status == 0 }">{{ getuser.status == 1 ? 'Active' : 'Inactive' }}</div>
                <div class="flex-auto w-36 pl-2">
                    <button @click="openEditModal(getuser)"
                        class="bg-yellow-500 hover:bg-yellow-400 active:bg-yellow-500 px-2 py-1 mr-2 rounded text-slate-700">Edit</button>
                    <button @click="deletemodal = true, deleteDataId = getuser.id"
                        class="bg-red-500 hover:bg-red-400 active:bg-red-500 px-2 py-1 text-white rounded">Delete</button>
                </div>
            </div>
        </div>
        <!--------- add user ---------->
        <Modal :modalShowHide="openmodal" @modalShowHide="openmodal = $event" modal-header="Add Hotel">
            <div class="m-2 sm:w-96 text-gray-700">
                <form class="w-full" @submit.prevent="addUser">
                    <div class="w-full flex flex-wrap mt-4">
                        Name
                        <input v-model="userData.name"
                            class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2"
                            type="text" placeholder="Enter Name">
                    </div>
                    <div class="w-full flex flex-wrap mt-4">
                        Password
                        <input v-model="userData.password"
                            class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2"
                            type="text" placeholder="Enter password">
                    </div>
                    <div class="w-full flex flex-wrap mt-4">
                        Status
                        <select v-model="userData.status"
                            class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="w-full my-4">
                        <button v-if="submitLoading" disabled
                            class="flex items-center justify-center w-full py-2 px-4 text-xl bg-orange-600 drop-shadow shadow text-white rounded mt-2"
                            type="submit">
                            <img src="../../images/loading.png" class="w-7 h-7 mr-2 mt-1 animate-spin">
                        </button>
                        <button v-else
                            class="w-full py-2 px-4 text-xl bg-orange-600 hover:bg-orange-500 active:bg-orange-600 active:text-gray-400 drop-shadow shadow text-white rounded mt-2">Submit</button>
                    </div>
                </form>
            </div>
        </Modal>

        <!-- ---------- edit modal------------ -->
        <Modal :modalShowHide="editmodal" @modalShowHide="editmodal = $event" modal-header="Edit Hotel" modalStyle="slide-fade">
            <div class="m-2 sm:w-96 text-gray-700">
                <form class="w-full" @submit.prevent="editUser">
                    <div class="w-full flex flex-wrap mt-4">
                        Name
                        <input v-model="editData.name"
                            class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2"
                            type="text" placeholder="Enter Name">
                    </div>
                    <div class="w-full flex flex-wrap mt-4">
                        Password
                        <input v-model="editData.password"
                            class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2"
                            type="text" placeholder="Enter password">
                    </div>
                    <div class="w-full flex flex-wrap mt-4">
                        Status
                        <select v-model="editData.status"
                            class="focus:ring-0 block w-full bg-gray-100 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="w-full my-4">
                        <button v-if="submitLoading" disabled
                            class="flex items-center justify-center w-full py-2 px-4 text-xl bg-orange-600 drop-shadow shadow text-white rounded mt-2"
                            type="submit">
                            <img src="../../images/loading.png" class="w-7 h-7 mr-2 mt-1 animate-spin">
                        </button>
                        <button v-else
                            class="w-full py-2 px-4 text-xl bg-orange-600 hover:bg-orange-500 active:bg-orange-600 active:text-gray-400 drop-shadow shadow text-white rounded mt-2">Submit</button>
                    </div>
                </form>
            </div>
        </Modal>

        <!-- delete modal -->
        <Modal :modalShowHide="deletemodal" @modalShowHide="deletemodal = $event" modal-header="Delete Hotel"
            modalStyle="bounce">
            <div class="m-2 sm:w-96 text-gray-700">
                <form @submit.prevent="deleteUser" class="w-full">
                    <h1 class="w-full text-center text-2xl text-slate-800 drop-shadow my-10">Are you sure want to delete hotel !</h1>
                    <input v-model="deleteDataId" type="hidden">
                    <div class="w-full flex mt-24">
                        <button @click.prevent="deletemodal = false"
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
import Modal from './Modal.vue';
import axios from 'axios';
import Warning from './Warning.vue';
export default {
    data() {
        return {
            openmodal: false,
            editmodal: false,
            deletemodal: false,
            warningMessage: [],
            submitLoading: false,

            getUsers: [],

            userData: {
                name: '',
                password: '',
                status: 1,
                adminid: 1,
            },
            editData: [],
            deleteDataId: '',

            BaseUrl: 'http://localhost:8000',
            contentheader: {
                'X-H': '1234',
            }
        }
    },
    components: {
        Modal,
        Warning,
    },
    created() {
        if (!localStorage.getItem('loginInfo')) {
            this.$router.push('/dashboard/login');
        }
        this.BaseUrl = this.$hostname;
        this.getUser();

        
    },
    methods: {
        removeWarningMsg() {
            this.warningMessage.shift();
        },

        addUser() {
            this.submitLoading = true;
            if (!this.userData.name) {
                this.warningMessage.push({
                    warnType: 'Error',
                    warnMsg: 'Please enter name!',
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                    this.submitLoading = false;
                }, 3000);
                return;
            }
            if (!this.userData.password) {
                this.warningMessage.push({
                    warnType: 'Error',
                    warnMsg: 'Please enter password!',
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                    this.submitLoading = false;
                }, 3000);
                return;
            }
            if (this.userData.status != 0 && this.userData.status != 1) {
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

            axios.post(this.BaseUrl + '/dashboard/addUser', this.userData).then((response) => {
                // console.log(response.data.message);
                // console.log(response.data);
                this.getUser();
                this.warningMessage.push({
                    warnType: response.data.status,
                    warnMsg: response.data.message,
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                }, 3000);
                setTimeout(() => {
                    this.openmodal = false;
                    this.userData.name = '';
                    this.userData.password = '';
                    this.userData.status = 1;
                }, 1000);

            }).finally(() => {
                this.submitLoading = false;
                //this.getProductBySupplier = [];
            });
        },
        editUser() {
            this.submitLoading = true;
            if (!this.editData.name) {
                this.warningMessage.push({
                    warnType: 'Error',
                    warnMsg: 'Please enter name!',
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                    this.submitLoading = false;
                }, 3000);
                return;
            }
            if (!this.editData.password) {
                this.warningMessage.push({
                    warnType: 'Error',
                    warnMsg: 'Please enter password!',
                });
                setTimeout(() => {
                    this.removeWarningMsg();
                    this.submitLoading = false;
                }, 3000);
                return;
            }
            if (this.editData.status != 0 && this.editData.status != 1) {
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

            axios.post(this.BaseUrl + '/dashboard/updateUser', this.editData).then((response) => {
                // console.log(response.data);
                this.getUser();
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
        getUser() {
            axios.get(this.BaseUrl + '/dashboard/getUsers', { headers: this.contentheader }).then((response) => {
                this.getUsers = JSON.parse(response.data.getUser);
            }).finally(() => {
                // console.log(this.getUsers);
            });
        },
        deleteUser() {
            axios.delete(this.BaseUrl + '/dashboard/deleteUser', { data: { deleteDataId: this.deleteDataId }, headers: this.contentheader }).then((response) => {
                // console.log(response.data.getUser);
                this.getUser();
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

        openEditModal(getuser) {
            // Copy the data to the modal
            this.editData = { ...getuser };
            this.editmodal = true;
        },
    }
}
</script>
    
<style>.custom-text {
    color: rgb(212, 84, 127);
}

.warningMsgComp {
    z-index: 9999999999;
    top: 10px;
}</style>