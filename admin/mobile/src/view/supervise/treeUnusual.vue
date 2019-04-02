<template>
    <div class="treeInfo-warp">
        <div class="treeInfo-header">
            <img src="../../assets/img/bg-info.png" alt="">
            <div class="treeInfo-projectName">
                <div class="treeInfo-projectName-left">
                    <img src="../../assets/img/project-header.png" alt="">
                </div>
                <div class="treeInfo-projectName-right">
                    <div class="treeInfo-projectNumber">
                        合同号: {{projectInfo.order_num}}
                    </div>
                    <div class="treeInfo-projectNa" v-text="projectInfo.project_name">
                    </div>
                    <div v-show="superviseInfo[4] && superviseInfo[4].unusual_state" class="treeInfo-yclinck" @click="linkMoreErrorTree">
                        <img src="../../assets/img/yc-more@2x.png" alt="">
                        <span>查看所有异常苗木</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="lineTo">苗木</div>
        <div class="treeInfo-desc">
            <div class="top">
                <div class="name" v-text="treeInfo.tree_name"></div>
                <div class="num">
                    <span>×</span>1
                </div>
                <div class="code">
                    <img src="../../assets/img/erweima-icon@2x.png" alt="">
                    <span v-text="treeInfo.qrcode"></span>
                </div>
            </div>
            <div class="bottom">
                <span v-show="treeInfo.dbh" v-text="'胸径'+treeInfo.dbh"></span>
                <span v-show="treeInfo.plant_height" v-text="'株高'+treeInfo.plant_height"></span>
                <span v-show="treeInfo.crown" v-text="'冠幅'+treeInfo.crown"></span>
            </div>
        </div>
        <div class="lineTo lineTo2">监管详情</div>
        <div class="ycList">
            <div class="type">
                <div class="left-icon">
                </div>
                <div class="haoshu">
                    号树
                </div>
            </div>
            <div class="type" v-for="item in superviseInfo" :key="item.id">
                <div class="left-icon">
                </div>
                <div :class="item.content?'content content2':'content'">
                    <div class="name-time">
                        <div class="name" v-text="item.active"></div>
                        <div class="time">{{item.time.split(" ")[1]}}  {{item.time.split(" ")[0]}}</div>
                    </div>
                    <div class="name-tel">
                        <div class="name"><img src="../../assets/img/ren2@2x.png" alt=""><span>负责人:{{item.name}}</span></div>
                        <div class="tel"><img src="../../assets/img/tel.png" alt=""><span v-text="item.phone"></span></div>
                    </div>
                    <div v-show="item.driver_name" class="sf">
                        <div class="sf-one">
                            <div class="tittle">
                                送货司机
                            </div>
                            <div class="sf-one-content" v-text="item.driver_name">
                            </div>
                        </div>
                        <div class="sf-one">
                            <div class="tittle">
                                运车车牌
                            </div>
                            <div class="sf-one-content" v-text="item.plate_number">
                            </div>
                        </div>
                        <div class="sf-one">
                            <div class="tittle">
                                联系方式
                            </div>
                            <div class="sf-one-content" v-text="item.driver_phone">
                            </div>
                        </div>
                    </div>
                    <div class="imgs-warp">
                        <img v-for="(img,index) in item.photo" @click="lookImg(item.photo,index)" :key="img" :src="img" alt="">
                    </div>
                    <div v-show="item.remark && item.type!= 5" class="remark">
                        备注：{{item.remark}}
                    </div>
                    <div v-show="item.unusual_state != 1 && item.unusual_state != 2 &&item.type == 5" class="remarkyc1">
                        验收结果：{{item.remark}}
                    </div>
                    <div v-show="item.unusual_state == 1 || item.unusual_state == 2" class="remarkyc2">
                        验收结果：{{item.remark}}
                    </div>
                    <div v-show="item.content && item.type == 5" class="yctext">
                        <div>平台处理</div>
                        <div class="cont" v-text="item.content"></div>
                        <img src="../../assets/img/face.png" alt="">
                    </div>
                    <div v-show="item.type == 5 && is_show == 1">
                        <div class="sub subActive" @click="subSuperviseContent">
                            处理
                        </div>
                    </div>
                </div>
            </div>
            <div class="lastStatus">
                <div v-for="state in lastState" :key="state" class="type type2">
                    <div class="left-icon">
                    </div>
                    <div class="haoshu" v-text="state"></div>
                </div>
            </div>
        </div>
        <van-dialog
                v-model="show"
                show-cancel-button
                :before-close="beforeClose"
                :confirm-button-text="'保存'"
        >
                <p class="dialog">处理结果</p>
                <div class="dialog-content">
                    <textarea  v-model="content"></textarea>
                </div>
        </van-dialog>
    </div>
</template>

<script>
    import {getTreeSuperviseInfo,getTwoCodeInfo,postSuperviseUnusual} from "../../api/supervise"

    export default {
        data() {
            return {
                show:false,
                id: "",
                is_show:1,
                treeInfo:{},
                superviseInfo:{},
                projectInfo:{},
                lastState:['起树',"装车","发车","卸车","验收"],
                content:""
            }
        },
        created() {
            this.id = this.$route.params.id;
            this.getTreeInfo()
        },
        methods: {
            beforeClose(action, done){
                if(action == "cancel"){
                    done()
                }
                if(!this.content){
                    this.Notify({
                        message: '备注必填！',
                        duration: 4000,
                        background: '#4EACBA'
                    });
                    done(false);
                }else {
                    var data = {
                        id : this.id,
                        content : this.content
                    }
                    postSuperviseUnusual(data).then(res =>{
                            if(res.data.status == 0){
                                this.$set(this,"is_show",0)
                                this.$set(this.superviseInfo[4],"content",this.content)
                                this.$set(this.superviseInfo[4],"unusual_state",1)
                                this.Notify({
                                    message: '异常处理成功',
                                    duration: 4000,
                                    background: '#4EACBA'
                                });
                            }
                    })
                    done(true);
                }


            },
            subSuperviseContent(){
                this.show = true
            },
            lookImg(arr,index){
                this.ImagePreview({
                    images: arr,
                    startPosition: index,
                    onClose() {
                        // do something
                    }
                });
            },
            linkMoreErrorTree() {
                this.$router.push({
                    name:"treeSupervise",
                    params:{
                        id:this.projectInfo.tender_order_id,
                        yc:2
                    }
                })
            },
            getTreeInfo() {
                let data = {
                    id: this.id
                }
                getTreeSuperviseInfo(data).then(res => {
                   this.treeInfo = res.data.info;
                   this.superviseInfo = res.data.record;
                   this.is_show = res.data.is_show
                   var lastState = this.lastState
                   this.lastState = lastState.splice(this.superviseInfo.length,1)
                })
                getTwoCodeInfo(data).then(res =>{
                    this.projectInfo = res.data
                })
            }

        }
    };
</script>

<style lang="less">
    .treeInfo-warp {
        .van-dialog__footer{
            border-top: 1px solid #eeeeee !important;
        }
        .van-dialog__confirm, .van-dialog__confirm:active{
            color: #4EACBA !important;
        }
        .van-dialog .van-button{
            border-right: 1px solid #eeeeee !important;
        }
        .dialog{
            margin-top: 20px;
            text-align: center;
            font-size: 16px;
            color: #333;
        }
        .dialog-content{
            width: 285px;
            height: 113px;
            padding: 10px 15px 20px 15px;
            textarea{
                display: block;
                width: 285px;
                height: 113px;
                background: #EEEEEE;
                border: none;
            }
        }
        .ycList{
            width: 345px;
            position: relative;
            margin: 0 auto;
            padding-top: 9px;
            padding-bottom: 23px;
            .lastStatus{
                padding-top: 15px;
            }
            .haoshu{
                height: 18px;
                line-height: 18px;
                color: #4EACBA;
                font-size: 12px;
                margin-left: 23px;
            }
            .type{
                margin-left: 6px;
                width: 337px;
                border-left: 2px solid #4EACBA;
                position: relative;
                .sub {
                    width: 150px;
                    height: 40px;
                    margin: 0 auto;
                    margin-top: 10px;
                    color: #ffffff;
                    font-size: 16px;
                    line-height: 40px;
                    text-align: center;
                    border-radius: 20px;
                    background: #4EACBA;
                }

                .content:not(:first-of-type){
                    margin-top: 15px;
                }
                .content{
                    margin-left: 23px;
                    padding: 18px 15px;
                    border-radius: 10px;
                    background: #ffffff;
                    .yctext{
                        padding: 15px 15px 20px 15px;
                        width: 285px;
                        position: absolute;
                        border-radius: 0 0 10px 10px;
                        right: 0px;
                        bottom: 0px;
                        background: #C3E3E7;
                        margin-top: 18px;
                        height: 99px;
                        div{
                            text-align: center;
                            font-size: 12px;
                            color: #4EACBA;
                        }
                        cont{
                            font-size: 12px;
                            color: #4EACBA;
                            margin-top: 5px;
                            width: 285px;
                            padding: 8px 0;
                        }
                        img{
                            margin:  0 auto;
                            display: block;
                            width: 27px;
                            height: 18px;
                        }
                    }
                    .remarkyc2{
                        font-size: 12px;
                        color: #BA4E4E;
                        margin-top: 10px;
                    }
                    .remarkyc1{
                        font-size: 12px;
                        color: #4EACBA;
                        margin-top: 10px;
                    }
                    .remark{
                        font-size: 12px;
                        color: #999999;
                        margin-top: 10px;
                    }
                    .sf{
                        width: 100%;
                        height: 40px;
                        margin-top: 6px;
                        .sf-one{
                            width: 33.3%;
                            float: left;
                            .tittle{
                                font-size: 12px;
                                color: #999999;
                            }
                            .sf-one-content{
                                font-size: 14px;
                                color: #666666;
                            }
                        }
                    }
                    .imgs-warp{
                        overflow: hidden;
                        img{
                            display: block;
                            width: 88px;
                            height: 65px;
                            margin-left: 10px;
                            float: left;
                            margin-top: 10px;
                        }
                        img:nth-of-type(3n+1){
                            margin-left: 0px;
                        }
                    }
                    .name-tel{
                        padding: 8px 0;
                        height: 18px;
                        .name{
                            float: left;
                            height: 18px;
                            img{
                                display: block;
                                width: 18px;
                                height: 18px;
                                float: left;
                            }
                            span{
                                font-size: 14px;
                                color: #333333;
                                float: left;
                                height: 18px;
                                line-height: 18px;
                                margin-left: 5px;
                            }
                        }
                        .tel{
                            float: right;
                            height: 18px;
                            img{
                                display: block;
                                width: 18px;
                                height: 18px;
                                float: left;
                            }
                            span{
                                font-size: 14px;
                                color: #333333;
                                float: left;
                                height: 18px;
                                line-height: 18px;
                                margin-left: 5px;
                            }
                        }
                    }
                    .name-time{
                        padding-bottom: 8px;
                        border-bottom: 1px solid #eeeeee;
                        height: 16px;
                        .name{
                            height: 16px;
                            line-height: 16px;
                            float: left;
                            font-size: 16px;
                            color: #333333;
                        }
                        .time{
                            height: 16px;
                            line-height: 16px;
                            float: right;
                            font-size: 12px;
                            color: #999999;
                        }
                    }
                }
                .content2{
                    padding-bottom: 145px;
                }
                .left-icon{
                    position: absolute;
                    top: 0px;
                    left: -10px;
                    width: 19px;
                    height: 19px;
                    border-radius: 10px;
                    background: #4EACBA;
                }
            }
            .type2{
                border-left: 2px solid #CCCCCC;
                .left-icon{
                    position: absolute;
                    top: 0px;
                    left: -10px;
                    width: 19px;
                    height: 19px;
                    border-radius: 10px;
                    background: #CCCCCC;
                }
                .haoshu{
                    color: #CCCCCC;
                }
            }
        }
        .treeInfo-desc{
            width: 345px;
            margin: 0 auto;
            margin-top: 10px;
            background: #ffffff;
            height: 80px;
            border-radius: 10px;
            box-shadow:0 5px 10px #eaf0f1;
            .top{
                padding: 19px 15px 4px 15px;
                position: relative;
                height: 16px;
                .name{
                    font-size: 16px;
                    color: #333333;
                    float: left;
                    height: 16px;
                    line-height: 16px;
                }
                .num{
                    margin-left: 18px;
                    float: left;
                    font-size: 20px;
                    color: #4EACBA;
                    height: 16px;
                    line-height: 16px;
                    span{
                        font-size: 12px;
                        color: #999999;
                        line-height: 16px;
                    }
                }
                .code{
                    height: 16px;
                    float: right;
                    img{
                        display: block;
                        float: left;
                        width: 11px;
                        height: 11px;
                        margin-top: 3px;
                    }
                    span{
                        font-size: 12px;
                        display: block;
                        height: 16px;
                        line-height: 16px;
                        float: left;
                        color: #999;
                        margin-left: 4px;
                    }
                }
            }
            .bottom{
                padding: 5px 15px 0 15px;
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
        }
        .lineTo {
            width: 333px;
            margin: 0 auto;
            border-left: 2px solid #4EACBA;
            padding-left: 10px;
            height: 16px;
            margin-top: 40px;
            line-height: 16px;
            font-size: 14px;
            color: #666;
        }
        .lineTo2{
            margin-top: 10px;
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
                box-shadow:0 5px 10px #eaf0f1;
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
                        margin-top: 4px;
                    }
                    .treeInfo-yclinck {
                        height: 13px;
                        position: absolute;
                        right: 0px;
                        top: 0px;
                        span {
                            font-size: 12px;
                            color: #BA4E4E;
                            float: right;
                        }
                        img {
                            display: block;
                            width: 13px;
                            height: 13px;
                            float: right;
                            margin-top: 2px;
                            margin-left: 5px;
                        }
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
