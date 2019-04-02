<template>
    <div>
        <div class="confirm-supervise">
            <div class="treeInfo-header">
                <img src="../../assets/img/mmsj@2x.png" alt="">
                <div class="treeInfo-projectName">
                    <div class="treeInfo-projectName-left">
                        <img src="../../assets/img/project-header.png" alt="">
                    </div>
                    <div class="treeInfo-projectName-right">
                        <div class="treeInfo-projectNumber">
                            合同号: {{headerInfo.order_num}}
                        </div>
                        <div class="treeInfo-projectNa" v-text="headerInfo.project_name"></div>
                    </div>
                </div>
            </div>
            <div>
                <div class="content">
                    <div class="content-middle">
                        <div class="header">基本信息 <span></span></div>
                        <div class="inputTyle inputActive">
                            <van-row type="flex" >
                                <van-col span="12">
                                    <div class="left">绑定二维码</div>
                                </van-col>
                                <van-col span="12">
                                    <div class="right" v-text="headerInfo.qrcode_id"></div>
                                </van-col>
                            </van-row>
                        </div>
                        <div :class="dataInfo.tree_name?'inputTyle inputActive':'inputTyle'">
                            <van-row type="flex" >
                                <van-col span="12">
                                    <div class="left">苗木名称</div>
                                </van-col>
                                <van-col span="12">
                                    <div class="right">
                                        <input type="text" :disabled="disabled" v-model="dataInfo.tree_name"
                                               placeholder="请输入苗木名称">
                                    </div>
                                </van-col>
                            </van-row>
                        </div>
                        <div :class="dataInfo.dbh?'inputTyle inputActive':'inputTyle'">
                            <van-row type="flex"  >
                                <van-col span="12">
                                    <div class="left">胸径（公分）</div>
                                </van-col>
                                <van-col span="12">
                                    <div class="right">
                                        <input type="text" :disabled="disabled" v-model="dataInfo.dbh"
                                               placeholder="请输入胸径">
                                    </div>
                                </van-col>
                            </van-row>
                        </div>
                        <div :class="dataInfo.crown?'inputTyle inputActive':'inputTyle'">
                            <van-row type="flex"  >
                                <van-col span="12">
                                    <div class="left">冠幅（米）</div>
                                </van-col>
                                <van-col span="12">
                                    <div class="right">
                                        <input type="text" :disabled="disabled" v-model="dataInfo.crown"
                                               placeholder="请输入冠幅">
                                    </div>
                                </van-col>
                            </van-row>
                        </div>
                        <div :class="dataInfo.plant_height?'inputTyle inputActive':'inputTyle'">
                            <van-row type="flex" >
                                <van-col span="12">
                                    <div class="left">株高（米）</div>
                                </van-col>
                                <van-col span="12">
                                    <div class="right">
                                        <input type="text" :disabled="disabled" v-model="dataInfo.plant_height"
                                               placeholder="请输入株高">
                                    </div>
                                </van-col>
                            </van-row>
                        </div>
                        <div :class="high_branch_point?'inputTyle inputActive':'inputTyle'">
                            <van-row type="flex" >
                                <van-col span="12">
                                    <div class="left">分支点高（公分）</div>
                                </van-col>
                                <van-col span="12">
                                    <div class="right">
                                        <input type="text" :disabled="disabled" v-model="high_branch_point"
                                               placeholder="请输入分支点高(选填)">
                                    </div>
                                </van-col>
                            </van-row>
                        </div>
                        <div class="remark">
                            <textarea cols="30" rows="10" :disabled="disabled" v-model="tree_attribute"
                                      placeholder="请输入备注信息（选填）"></textarea>
                        </div>
                        <div v-show="!disabled" :class="buttonActive?'sub subActive':'sub'" @click="subTreeInfo">
                            提交
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import {getTwoCodeInfo, postTreeInfo} from "../../api/supervise"

    export default {
        data() {
            return {
                id: "",
                disabled: false,
                headerInfo: {},
                high_branch_point: "",
                tree_attribute: "",
                buttonActive: false,
                dataInfo: {
                    tree_name: "",
                    dbh: "",
                    crown: "",
                    plant_height: ""

                }
            }
        },
        created() {
            this.id = this.$route.params.id;
            this.getTreeInfo();

        },
        methods: {
            subTreeInfo() {
                if (!this.buttonActive) {
                    return
                }
                let data = this.dataInfo;
                data.id = this.id;
                data.tree_attribute = this.tree_attribute;
                data.high_branch_point = this.high_branch_point;
                postTreeInfo(data).then(res => {
                    if (res.data.status == 0) {
                        this.Notify({
                            message: '信息绑定成功',
                            duration: 2000,
                            background: '#4EACBA'
                        });
                        this.disabled = true
                    } else {
                        this.Notify({
                            message: '信息已经绑定,异常请联系客服',
                            duration: 4000,
                            background: '#BA4E4E'
                        });
                        this.disabled = true
                    }
                })

            },
            getTreeInfo() {
                let data = {
                    id: this.id,
                }
                this.Toast.loading({
                    message: '加载中...',
                    duration: 0
                });
                getTwoCodeInfo(data).then(res => {
                    this.Toast.clear()
                    this.headerInfo = res.data

                }).catch(res => {
                    this.Toast.clear()
                })
            }

        },
        watch: {
            dataInfo: {
                handler(curVal, oldVal) {
                    for (var key in oldVal) {
                        this.buttonActive = false
                        if (!oldVal[key]) return;
                    }
                    this.buttonActive = true
                },
                deep: true
            }
        }
    };
</script>

<style lang="less">
    .confirm-supervise {
        .sub {
            width: 150px;
            height: 40px;
            margin: 0 auto;
            margin-top: 10px;
            background: #cccccc;
            color: #ffffff;
            font-size: 16px;
            line-height: 40px;
            text-align: center;
            border-radius: 20px;
        }
        .subActive {
            background: #4EACBA;
        }
        .content {
            width: 100%;
            background: #ffffff;
            padding-top: 16px;
            padding-bottom: 15px;
            margin-top: 40px;
            .content-middle {
                width: 345px;
                margin: 0 auto;
                .remark {
                    textarea {
                        width: 345px;
                        height: 72px;
                        background: #EEEEEE;
                        font-size: 12px;
                        color: #999999;
                        border: none;
                    }
                }
                .inputTyle {
                    padding: 15px 0;
                    border-bottom: 1px solid #eeeeee;
                    height: 20px;
                    .left {
                        font-size: 14px;
                        color: #666666;
                    }
                    .right {
                        font-size: 14px;
                        color: #999999;
                        text-align: right;
                        width: 100%;
                        input {
                            display: block;
                            height: 20px;
                            width: 100%;
                            font-size: 12px;
                            color: #999999;
                            text-align: right;
                            border: none;
                            outline: none;
                            text-align: right;
                            background: #ffffff;
                        }
                    }
                }
                .inputActive {
                    .right {
                        font-size: 16px;
                        color: #333333;
                        text-align: right;
                        height: 20px;
                        input {
                            font-size: 16px;
                            color: #333333;
                            text-align: right;
                        }
                    }
                }
                .header {
                    text-indent: 8px;
                    position: relative;
                    font-size: 16px;
                    color: #666666;
                    span {
                        display: block;
                        position: absolute;
                        height: 16px;
                        width: 2px;
                        left: 0px;
                        top: 2px;
                        background: #4EACBA;
                    }
                }
            }
        }
        .treeInfo-header > img {
            width: 100%;
            height: 90px;
            display: block;
            position: relative;
        }
        .treeInfo-header {
            width: 100%;
            .treeInfo-projectName {
                width: 345px;
                height: 76px;
                border-radius: 10px;
                background: #ffffff;
                left: 15px;
                position: absolute;
                top: 44px;
                box-shadow: 0 5px 10px #eaf0f1;
                .treeInfo-projectName-right {
                    position: absolute;
                    right: 16px;
                    top: 19px;
                    width: 270px;
                    .treeInfo-projectNumber {
                        font-size: 12px;
                        color: #999999;
                    }
                    .treeInfo-projectNa {
                        font-size: 16px;
                        color: #333333;
                    }

                }
                .treeInfo-projectName-left {
                    position: absolute;
                    width: 31px;
                    height: 36px;
                    left: 15px;
                    top: 20px;
                    img {
                        display: block;
                        width: 31px;
                        height: 36px;
                    }
                }
            }
        }
    }
</style>
