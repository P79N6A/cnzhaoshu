<template>
    <div class="contract-tree-warp">
        <div class="contract-tree-header">
            <img src="../../assets/img/bg-treelist@2x.png" alt="">
        </div>
        <div class="contract-tree-projectName">
            <div class="contract-tree-projectName-left">
                <img src="../../assets/img/mbetree-mg@2x.png" alt="">
            </div>
            <div class="contract-tree-projectName-right">
                <div class="contract-tree-projectNumber">
                    合同号: {{treeInfo.order_num}}
                </div>
                <div class="contract-tree-projectNa">
                    {{treeInfo.name}}
                </div>
                <div class="contract-tree-projectNum">
                    <span>数量：<span>{{treeInfo.sum}}</span>株</span>
                </div>
            </div>
        </div>
        <van-list  v-model="loading" :finished="finished" :finished-text="yc == 2?'没有更多异常':'全部加载，没有更多数据'" @load="getMoreTree" >
            <div class="contract-tree-content">
                <div class="contract-tree-one" v-for="(tree,index) in treeInfo.content" @click="linkTreeInfo(index)" :key="tree.qrcode">
                    <div class="contract-tree-one-name">
                        <div class="contract-tree-one-tree">
                            <div class="name" v-text="tree.tree_name"></div>
                            <div class="num">
                                <span>1</span>株
                            </div>
                            <div class="status" v-text="tree.order_state"></div>
                        </div>
                        <div class="contract-tree-one-code">
                            <img src="../../assets/img/erweima-icon@2x.png" alt="">
                            <span v-text="tree.qrcode"></span>
                        </div>
                    </div>
                    <div class="contract-tree-one-content">
                        <span v-show="tree.dbh" v-text="'胸径'+tree.dbh+'公分'"></span>
                        <span v-show="tree.plant_height" v-text="'株高'+tree.plant_height+'米'"></span>
                        <span v-show="tree.crown" v-text="'冠幅'+tree.crown+'公分'"></span>
                    </div>
                    <div class="contract-tree-one-status">
                        <img v-show="tree.unusual_state == '1'" src="../../assets/img/finish-shen@2x.png" alt="">
                        <img v-show="tree.unusual_state == '2'" src="../../assets/img/waring@2x.png" alt="">
                    </div>
                </div>
            </div>
        </van-list>

    </div>
</template>

<script>
    import {getTreeSupervise} from "../../api/supervise"

    export default {
        data() {
            return {
                tender_order_id: "",
                treeInfo: {},
                page:0,
                loading:false,
                finished:false
            }
        },
        created() {
            this.tender_order_id = this.$route.params.id;
            this.yc = this.$route.params.yc
        },
        methods: {
            linkTreeInfo(index){
                if(this.treeInfo.content[index].order_state == '未起树'){
                    this.Dialog.alert({
                        message: '还未起树，无监管信息！'
                    }).then(() => {
                        // on close
                    });
                    return
                }else if(this.treeInfo.content[index].order_state == '未绑定'){
                    this.Dialog.alert({
                        message: '还未绑定，无监管信息！'
                    }).then(() => {
                        // on close
                    });
                    return
                }
                this.$router.push({
                    name:"treeInfo",
                    params:{
                        id:this.treeInfo.content[index].maps_order_id
                    }
                })
            },
            getMoreTree(){
                this.page = this.page+1;
                this.getTreeList();
            },
            linkTreeSupervise(index) {
                alert(index)
            },
            getTreeList() {
                let data = {
                    tender_order_id: this.tender_order_id,
                    page:this.page,
                    state:this.yc == 2?"7":"0"
                }
                getTreeSupervise(data).then(res => {
                    if(this.page == 1){
                        this.treeInfo = res.data.data;
                        this.loading = false
                    }else{
                        var content =  this.treeInfo.content;
                        content = content.concat(res.data.data.content)
                        this.$set(this.treeInfo,"content",content)
                        this.loading = false
                    }
                    if(res.data.data.content.length == 0){
                        this.finished = true
                    }

                })
            }

        }
    };
</script>

<style lang="less">
    .contract-tree-warp {
        .contract-tree-content {
            width: 345px;
            margin: 0 auto;
            background: #ffffff;
            margin-top: -40px !important;
            border-radius: 10px;
            .contract-tree-one:last-of-type{
                border-bottom: none!important;
            }
            .contract-tree-one {
                width: 315px;
                margin: 0 auto;
                padding: 20px 0;
                border-bottom: 1px #eeeeee solid;
                position: relative;
                .contract-tree-one-status{
                    width: 48px;
                    height: 46px;
                    position: absolute;
                    right: -16px;
                    top: 20px;
                    img{
                        width: 48px;
                        height: 46px;
                        display: block;
                    }
                }
                .contract-tree-one-content {
                    height: 15px;
                    span {
                        padding-right: 16px;
                        font-size: 14px;
                        color: #666666;
                        height: 15px;
                        line-height: 15px;
                        position: relative;
                        display: block;
                        float: left;
                    }
                    span:before {
                        display: table;
                        content: "";
                        height: 13px;
                        border-left: 1px solid #999999;
                        position: absolute;
                        left: -8px;
                        top: 0px;
                    }
                    span:first-of-type:before {
                        display: none;
                    }
                }
                .contract-tree-one-name {
                    position: relative;
                    height: 30px;
                    .contract-tree-one-code {
                        position: absolute;
                        right: 0px;
                        top: 0px;
                        height: 30px;
                        img {
                            display: block;
                            float: left;
                            width: 11px;
                            height: 11px;
                            margin-top: 9px;
                        }
                        span {
                            display: block;
                            float: left;
                            height: 11px;
                            font-size: 12px;
                            color: #999999;
                            line-height: 11px;
                            margin-top: 9px;
                            margin-left: 3px;
                        }
                    }
                    .contract-tree-one-tree {
                        position: absolute;
                        left: 0;
                        top: 0;
                        height: 30px;
                        .name {
                            font-size: 16px;
                            color: #333333;
                            float: left;
                            height: 30px;
                            line-height: 30px;
                        }
                        .num {
                            float: left;
                            margin-left: 20px;
                            color: #999999;
                            font-size: 12px;
                            height: 30px;
                            line-height: 30px;
                            span {
                                font-size: 20px;
                                color: #4EACBA;
                                height: 30px;
                                line-height: 30px;
                            }
                        }
                        .status {
                            width: 40px;
                            height: 17px;
                            font-size: 10px;
                            float: left;
                            margin-left: 3px;
                            color: #ffffff;
                            background: #4EACBA;
                            margin-top: 6px;
                            line-height: 19px;
                            border-radius: 17px;
                            text-align: center;
                        }
                    }
                }
            }
        }
        .contract-tree-projectName {
            width: 345px;
            height: 110px;
            border-radius: 10px;
            background: #ffffff;
            margin: 0 auto;
            position: relative;
            top: -50px;
            box-shadow:0 5px 10px #eaf0f1;
            .contract-tree-projectName-right {
                position: absolute;
                left: 77px;
                top: 20px;
                .contract-tree-projectNumber {
                    font-size: 12px;
                    color: #999999;
                }
                .contract-tree-projectNa {
                    font-size: 16px;
                    color: #333333;
                    margin-top: 9px;
                }
                .contract-tree-projectNum {
                    height: 16px;
                }
                .contract-tree-projectNum > span {
                    font-size: 12px;
                    height: 16px;
                    line-height: 16px;
                    color: #666666;
                    float: left;
                    margin-top: 8px;
                }
                .contract-tree-projectNum > span > span {
                    font-size: 20px;
                    color: #4EACBA;
                }

            }
            .contract-tree-projectName-left {
                position: absolute;
                width: 47px;
                height: 52px;
                left: 15px;
                top: 26px;
                img {
                    display: block;
                    width: 47px;
                    height: 52px;
                }
            }
        }
        .contract-tree-header {
            width: 100%;
            img {
                width: 100%;
                height: 90px;
            }
        }
    }
</style>
