<template>
    <div class="contract-warp">
        <div class="contract-header">
            <img src="../../assets/img/bg-agreementlist@2x.png" alt="">
        </div>
        <div class="contract-list" v-if="contractList.length != 0">
            <div class="contract-one" v-for="(contract,index) in contractList" @click="linkTreeSupervise(index)" :key="contract.tender_order_id">
                <div class="contract-number">
                    <img src="../../assets/img/ht-icon@2x.png" alt="">
                    <span>合同号: {{contract.order_num}}</span>
                    <div class="contract-number-linkIcon">
                        <img src="../../assets/img/more-icon@2x.png" alt="">
                    </div>
                </div>
                <div class="contract-parta">
                    <img src="../../assets/img/jiafang-icon@2x.png" alt="">
                    <span class="contract-parta-namelabel">甲方：</span>
                    <span class="contract-parta-name" v-text="contract.partya_company_name"></span>
                </div>
                <div class="contract-partb">
                    <img src="../../assets/img/yifang-icon@2x.png" alt="">
                    <span class="contract-parta-namelabel">乙方：</span>
                    <span class="contract-parta-name" v-text="contract.partyb_company_name"></span>
                </div>
                <div class="contract-num-warp">
                    <span class="contract-num" v-text="contract.sum">
                    </span>
                    <span class="contract-danwei">
                        株
                    </span>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="supervise-none">
                <img class="img-none" src="../../assets/img/none.png" alt="">
                <p class="none-descript">该条件下目前没有数据哦~</p>
            </div>
        </div>
    </div>
</template>

<script>
    import {getContractList} from "../../api/supervise"

    export default {
        data() {
            return {
                project_id: "",
                contractList: []
            }
        },
        created() {
            this.project_id = this.$route.params.id;
            this.getContract();
        },
        methods: {
            linkTreeSupervise(index){
                this.$router.push({
                    name:"treeSupervise",
                    params:{
                        id:this.contractList[index].tender_order_id,
                        yc:1
                    }
                })
            },
            getContract() {
                let data = {
                    project_id: this.project_id
                }
                getContractList(data).then(res => {
                    this.contractList = res.data.data
                })
            }

        }
    };
</script>

<style lang="less">
    .contract-warp {
        .contract-list{
            margin-top: -62px;
            .contract-one{
                height: 120px;
                background: #ffffff;
                width: 313px;
                margin: 0 auto;
                border-radius: 10px;
                position: relative;
                padding: 25px 17px 0 17px;
                margin-top: 10px;
                .contract-num-warp{
                    position: absolute;
                    top: 67px;
                    right: 17px;
                    .contract-num{
                        font-size: 20px;
                        color: #4EACBA;
                    }
                    .contract-danwei{
                        font-size: 12px;
                        color: #666666;
                    }
                }
                .contract-partb{
                    margin-top: 5px;
                    height: 26px;
                    img{
                        display: block;
                        float: left;
                        width: 23px;
                        height: 23px;
                    }
                    .contract-parta-namelabel{
                        display: block;
                        float: left;
                        height: 26px;
                        font-size: 14px;
                        line-height: 15px;
                    }
                    .contract-parta-name{
                        font-family: PingFang-SC-Regular;
                        display: block;
                        float: left;
                        height: 26px;
                        font-size: 16px;
                        line-height: 15px;
                    }
                }
                .contract-parta{
                    margin-top: 20px;
                    height: 26px;
                    img{
                        display: block;
                        float: left;
                        width: 23px;
                        height: 23px;
                    }
                    .contract-parta-namelabel{
                        display: block;
                        float: left;
                        height: 26px;
                        font-size: 14px;
                        line-height: 15px;
                    }
                    .contract-parta-name{
                        font-family: PingFang-SC-Regular;
                        display: block;
                        float: left;
                        height: 26px;
                        font-size: 16px;
                        line-height: 15px;
                    }
                }
                .contract-number{
                    border-bottom: 1px solid #eeeeee;
                    position: relative;
                    height: 26px;
                    img{
                        display: block;
                        float: left;
                        width: 23px;
                        height: 23px;
                    }
                    span{
                        display: block;
                        float: left;
                        height: 26px;
                        font-size: 12px;
                        color: #666666;
                    }
                    .contract-number-linkIcon{
                        position: absolute;
                        right: 0px;
                        top: 0px;
                        width: 8px;
                        height: 14px;
                        img{
                            display: block;
                            width: 7px;
                            height: 12px;
                        }
                    }
                }
            }
        }
        .contract-header {
            width: 100%;
            img {
                width: 100%;
                height: 90px;
            }
        }
    }
</style>
