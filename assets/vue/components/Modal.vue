<template>
  <Teleport to="body">
    <Transition :name="modalStyle">
        <div class="modalMainDiv" v-show="modalShowHide">
            <Transition name="dashTransition">
                <div class="modalBody-main" v-show="modalShowHide">
                    <div class="modalContainer-main">
                        <div class="modalHeader-main bg-stone-300">
                            <h1 class="text-orange-500 text-2xl mt-0">{{ modalHeader }}</h1>
                            <img @click="modalClose" src="../../images/close.png">
                        </div>
                        <div class="modalBody-sub">
                            <slot></slot>
                        </div>
                    </div>
                </div>
            </Transition>
        </div>
    </Transition>
  </Teleport>
</template>

<script>
export default {
    inheritAttrs: false,
    data() {
        return {
            
        }
    },
    props: {
        modalHeader: {
            type: String,
            default: "Modal Header"
        },
        modalShowHide: {
            type: Boolean,
            default: false,
        },
        modalStyle: {
            type: String,
            default: "dashTransition"
        },
    },
    methods: {
        modalClose() {
            this.$emit("modalShowHide", false);
            //console.log('modal: ' + this.modalShowHide);
           
        }
    },
    
}

</script>

<style>
.modalMainDiv{
    width: 100%;
    height: auto;
    position: fixed;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    justify-content: center;
    justify-items: center;
    display: flex;
    background: rgba(0, 0, 0, 0.7);
    z-index: 999999;
}
.modalBody-main{
    width: auto;
    height: auto;
    min-height: 300px;
    background: #fff;
    min-width: 320px;
    position: absolute;
    overflow-y: auto;
    overflow-x: hidden;
    top: 10%;
    border-radius: 10px;
    box-shadow: 0px 0px 20px 5px rgba(0, 0, 0, 0.2);
    max-height: 85vh;
}
.modalContainer-main{
    width: 100%;
    height: auto;
    /* padding: 10px; */
}
.modalHeader-main{
    width: 100%;
    margin: 0px;
    margin-bottom: 10px;
}
.modalHeader-main h1{
    width: 100%;
    text-align: center;
    color: rgb(249 115 22 / var(--tw-text-opacity));
    padding: 10px 0px;
    font-weight: bold;
}
.modalHeader-main img{
    position: absolute;
    width: 25px;
    height: auto;
    top: 10px;
    right: 10px;
    cursor: pointer;
}
</style>