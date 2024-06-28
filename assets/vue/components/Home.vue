<template>
    <div>
        <div class="flex w-full">
            <div class="chart flex-auto w-1/2 px-2">
                <Bar v-if="isloaded" id="my-chart-id" class="barChart" :data="getMonthlyRent" />
            </div>
            <div class="chart flex-auto w-1/2 px-2">
                <Bar v-if="isCount" id="my-chart-id" class="barChart" :data="getMonthlyCount" />
            </div>
        </div>
        <div class="flex w-full mt-6">
            <div class="chart w-1/3 px-4">
                <div class="buyProTitle width-4">
                  <Pie id="my-chart-id-sell-2" v-if="isrent" class="pieChart" :data="clientTotal" />
                </div>
            </div>
            <div class="chart w-1/3 px-4">
                <div class="buyProTitle width-4">
                  <Pie id="my-chart-id-sell-1" v-if="istotal" class="pieChart" :data="clientTotalCount" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { Bar, Pie } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement, elements } from 'chart.js';
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement);

export default {
    data() {
        return {
            isloaded: false,
            isCount: false,
            isrent: false,
            istotal: false,
            getMonthlyRent: {
                labels: [],
                datasets: [
                    {
                        data: [],
                        label: 'Rent',
                        backgroundColor: 'rgba(0, 0, 255, 0.3)',
                        borderColor: 'rgba(0, 0, 255, 0.6)',
                        borderWidth: 1,
                    },
                ]
            },
            getMonthlyCount: {
                labels: [],
                datasets: [
                    {
                        data: [],
                        label: 'Rent Count',
                        backgroundColor: 'rgba(219, 39, 119, 0.3)',
                        borderColor: 'rgba(219, 39, 119, 0.6)',
                        borderWidth: 1,
                    },
                ]
            },

            clientTotal: {
                labels: [],
                datasets: [{
                    label: 'Euro',
                    data: [100, 50],
                    backgroundColor: [],
                    hoverOffset: 10,
                }]
            },

            clientTotalCount: {
                labels: [],
                datasets: [{
                    label: 'Total Order',
                    data: [100, 50],
                    backgroundColor: [],
                    hoverOffset: 10,
                }]
            },

            legend: {
                display: true
            },

            BaseUrl: 'http://localhost:8000',
            contentheader: {
                'X-H': '1234',
            },
        }
    },

    methods: {
        
        async getAllChartData() {
            await axios.get(this.BaseUrl + '/dashboard/getMonthlyOrderReport', { headers: this.contentheader }).then((response) => {
                // console.log(response.data.getReportByRent);
                this.getMonthlyRent.labels = (response.data.getReportByMonth);
                this.getMonthlyRent.datasets[0].data = (response.data.getReportByRent);
                // console.log((response.data.getReportByMonth));
            }).finally(() => {
                this.isloaded = true;
            }); 
        },

        async getMonthlyCountRent() {
            await axios.get(this.BaseUrl + '/dashboard/getMonthlyCountRent', { headers: this.contentheader }).then((response) => {
                // console.log(response.data);
                this.getMonthlyCount.labels = (response.data.getReportByMonth);
                this.getMonthlyCount.datasets[0].data = (response.data.getReportByRent);
                // console.log((response.data.getReportByMonth));
            }).finally(() => {
                this.isCount = true;
            });
        },

        async getClientTotalRent() {
            await axios.get(this.BaseUrl + '/dashboard/getClientTotalRent', { headers: this.contentheader }).then((response) => {
                // console.log(response.data);
                this.clientTotal.labels = (response.data.getReportByMonth);
                this.clientTotal.datasets[0].data = (response.data.getReportByRent);
                this.clientTotal.datasets[0].backgroundColor = response.data.color;
                // console.log((response.data.getReportByMonth));
            }).finally(() => {
                this.isrent = true;
            });
        },

        async getClientTotalCount() {
            await axios.get(this.BaseUrl + '/dashboard/getClientTotalCount', { headers: this.contentheader }).then((response) => {
                // console.log(response.data);
                this.clientTotalCount.labels = (response.data.getReportByMonth);
                this.clientTotalCount.datasets[0].data = (response.data.getReportByRent);
                this.clientTotalCount.datasets[0].backgroundColor = response.data.color;
                // console.log((response.data.getReportByMonth));
            }).finally(() => {
                this.istotal = true;
            });
        },
    },
    components: {
        Bar,
        Pie,
    },
    created() {
        if (!localStorage.getItem('loginInfo')) {
            this.$router.push('/dashboard/login');
        }
        this.BaseUrl = this.$hostname;
        // this.getAllChartData();
        // this.getMonthlyCountRent();
        // this.getClientTotalRent();

        
    },
    mounted() {
        this.getAllChartData();
        this.getMonthlyCountRent();
        this.getClientTotalRent();
        this.getClientTotalCount();
    },
}
</script>

<style></style>