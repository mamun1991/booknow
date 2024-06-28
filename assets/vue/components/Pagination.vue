<template>
  <div class="grid w-full justify-end mt-6">
    <ul class="pagi">
        <li><button :class="{ 'bg-rose-600 hover:bg-rose-700': ispre, 'bg-emerald-600 hover:bg-emerald-700': !ispre }" class="w-12 h-12 rounded-full text-white active:bg-rose-600" :disabled="ispre" @click="previousPage(previous)">Prev</button></li>
        <li v-for="(page) in pageButton" :key="page"><button class="w-12 h-12 rounded-full text-white active:bg-rose-600" :class=" iscurrent === page ? 'bg-blue-600 hover:bg-blue-700': 'bg-emerald-600 hover:bg-emerald-700' " @click="currentPage(page)">{{ page }}</button></li>
        <li><button class="w-12 h-12 rounded-full text-white active:bg-rose-600" :class="{ 'bg-rose-600 hover:bg-rose-700': isnext, 'bg-emerald-600 hover:bg-emerald-700': !isnext }" :disabled="isnext" @click="nextPage(next)">Next</button></li>
    </ul>
  </div>
</template>

<script>
export default {
    data() {
        return{
            //currentPage: '',
        }  
    },
    props: {
        previous: {
            type: Number,
        },
        next: {
            type: Number,
        },
        pageButton: {
            type: Number,
        },
        currentpage: {
            type: Number,
        },
        ispre: {
            type: Boolean,
        },
        isnext: {
            type: Boolean,
        },
        iscurrent: {
            type: Number,
        },
    },
    methods: {
        currentPage(pageButton) {
            this.$emit("pageChanged", pageButton);
            // console.log('pageChanged', pageButton);
        },
        previousPage(previous) {
            this.$emit("pageChanged", previous);
            // console.log('previous', previous);
        },
        nextPage(next) {
            this.$emit("pageChanged", next);
            // console.log('next', next);
        }
    }
}
</script>

<style>
.pagination{
    width: 100%;
    height: auto;
    padding: 10px 0px;
    text-align: center;
}
.pagi{
    list-style: none;
    padding: 0px;
    width: 100%;
    height: auto;
    display: block;
    overflow: hidden;
}
.pagi li{
    float: left;
    margin: 0px 3px;
}
.pagi-btn{
    cursor: pointer;
    border: 1px solid #19820a;
    background: #fff;
    border-radius: 50px;
    padding: 12px 6px;
    width: 43px;
}
.pagi-btn:hover{
    background: #87bd83;
}
.pagi-btn:active {
    background: #42753e;
}
.disableBtn{
    background: #f5d6d6;
    border: 1px solid #b59797;
}
.disableBtn:hover {
    background: #f5d6d6;
    border: 1px solid #b59797;
}
.activeBtn{
    background: #50ac4d;
}
</style>