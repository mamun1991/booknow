<template>
  <div :class="['warningMsg', 'warnBg' + warningType]">
    <div :class="['warnTitle', 'warnTitleBg' + warningType]">
        {{ warningType }}
    </div>
    <div :class="['warnMsg', 'warnMsg' + warningType]">
        {{ warningMsg }}
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {

        }
    },
    props: {
        warningType: {
            type: String,
            default: "Error",
        },
        warningMsg: {
            type: String,
            default: "Warning Message",
        }
    }

}
</script>

<style>
.warnTitle {
    color: #fff;
    font-size: 22px;
    text-align: center;
    font-weight: bold;
    padding: 5px;
    margin-bottom: 15px;
    border-radius: 10px 10px 0px 0px;
}
.warnMsg{
    font-size: 16px;
    padding-left: 20px;
}
.warningMsg {
    width: 250px;
    height: 100px;
    border-radius: 10px;
    box-shadow: 0px 2px 9px 2px #aaa;
    margin: 20px;
}
.warnTitleBgError {
    background: #ff5757;
}
.warnBgError{
    background: #e8c8c8;
}
.warnMsgError{
    color: #621252;
}

.warnTitleBgSuccess {
    background: #3ca643;
}

.warnBgSuccess {
    background: #c8e8cf;
}

.warnMsgSuccess {
    color: #156212;
}
</style>