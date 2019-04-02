<template>
    <div class="post-supervise-warp">
        <div class="post-supervise-header">
            <img src="../../assets/img/bg-info.png" alt="">
            <div class="post-supervise-desc">
                <div class="top">
                    <div class="name" v-text="treeinfo.tree_name"></div>
                    <div class="num">
                        <span>×</span>{{treeinfo.sum}}
                    </div>
                    <div class="code">
                        <img src="../../assets/img/erweima-icon@2x.png" alt="">
                        <span v-text="treeinfo.qrcode"></span>
                    </div>
                </div>
                <div class="bottom">
                    <span v-show="treeinfo.dbh" v-text="'胸径'+treeinfo.dbh"></span>
                    <span v-show="treeinfo.plant_height" v-text="'株高'+treeinfo.plant_height"></span>
                    <span v-show="treeinfo.crown" v-text="'冠幅'+treeinfo.crown"></span>
                </div>
            </div>
            <div class="link-treeInfo" @click="linkTreeInfo">监管详情</div>
        </div>
        <div class="state-warp">
            <div class="lineTo">监管流程</div>
            <img v-show="state == 1" src="../../assets/img/state1.png" alt="">
            <img v-show="state == 2" src="../../assets/img/state2.png" alt="">
            <img v-show="state == 3" src="../../assets/img/state3.png" alt="">
            <img v-show="state == 4" src="../../assets/img/state4.png" alt="">
            <img v-show="state == 5" src="../../assets/img/state5.png" alt="">
        </div>
        <div v-show="state == 5" class="yichang">
            <div class="lineTo">验收结果</div>
            <div class="yichang-radiu">
                <van-row type="flex" justify="space-between">
                    <van-col>
                        <label for="yichang-radiu1" :class="user.type == 0?'radiu2':'radiu1'">
                            异常
                            <input id="yichang-radiu1" name="Fruit" v-model="user.type" type="radio" value="1"/>
                        </label>
                    </van-col>
                    <van-col>
                        <label for="yichang-radiu2" :class="user.type == 0?'radiu1':'radiu2'">
                            通过
                            <input id="yichang-radiu2" name="Fruit" type="radio" v-model="user.type" value="0"/>
                        </label>
                    </van-col>
                </van-row>
            </div>
        </div>
        <div class="user-info">
            <div class="lineTo">基本信息</div>
            <div v-show="state == 3" class="wuliu">
                <div :class="user.driver_name?'inputTyle inputActive':'inputTyle'">
                    <van-row type="flex" >
                        <van-col span="12">
                            <div class="left">运货司机</div>
                        </van-col>
                        <van-col span="12">
                            <div class="right">
                                <input type="text" v-model="user.driver_name"
                                       placeholder="请输入司机姓名">
                            </div>
                        </van-col>
                    </van-row>
                </div>
                <div :class="user.driver_phone?'inputTyle inputActive':'inputTyle'">
                    <van-row type="flex" >
                        <van-col span="12">
                            <div class="left">联系电话</div>
                        </van-col>
                        <van-col span="12">
                            <div class="right">
                                <input type="text" v-model="user.driver_phone"
                                       placeholder="请输入司机电话">
                            </div>
                        </van-col>
                    </van-row>
                </div>
                <div :class="user.plate_number?'inputTyle inputActive':'inputTyle'">
                    <van-row type="flex" >
                        <van-col span="12">
                            <div class="left">运车车牌</div>
                        </van-col>
                        <van-col span="12">
                            <div class="right">
                                <input type="text" v-model="user.plate_number"
                                       placeholder="请输入车牌号">
                            </div>
                        </van-col>
                    </van-row>
                </div>
            </div>
            <div :class="user.name?'inputTyle inputActive':'inputTyle'">
                <van-row type="flex" >
                    <van-col span="12">
                        <div class="left">负责人</div>
                    </van-col>
                    <van-col span="12">
                        <div class="right">
                            <input type="text" v-model="user.name"
                                   placeholder="请输入负责人姓名">
                        </div>
                    </van-col>
                </van-row>
            </div>
            <div :class="user.phone?'inputTyle inputActive':'inputTyle'">
                <van-row type="flex" >
                    <van-col span="12">
                        <div class="left">联系电话</div>
                    </van-col>
                    <van-col span="12">
                        <div class="right">
                            <input type="text" v-model="user.phone"
                                   placeholder="请输入负责人电话">
                        </div>
                    </van-col>
                </van-row>
            </div>
        </div>
        <div class="img-warp">
            <div class="lineTo">图片上传<span>(最多上传9张)</span></div>
            <div class="imgs">
                <div v-for="(item,index) in photo" :key="item">
                    <img @click="lookImg(index)"  :src="item" alt="">
                    <div class="removeImg" @click="removeImg(index)">
                        <img src="../../assets/img/closeIcon.png" alt="">
                    </div>
                </div>
                <div class="img-sub" v-show="photo.length <= 8">
                    <van-uploader  :after-read="onRead" accept="image/*">
                        <label>
                            <div class="after"></div>
                            <div class="before"></div>
                        </label>
                    </van-uploader>
                </div>
            </div>
        </div>
        <div class="remark">
                            <textarea cols="30" rows="10" v-model="remark"
                                      placeholder="请输入备注信息（选填）"></textarea>
            <div :class="buttonActive?'sub subActive':'sub'" @click="subSuperviseInfo">
                提交
            </div>
        </div>
    </div>
</template>

<script>
    import {getSuperviseStatus,postSuperviseImg,postSuperviseInfo} from "../../api/supervise"
    import {imgPreview} from '../../libs/imgPreview'
    export default {
        data() {
            return {
                buttonActive: false,
                remark: "",
                id: "",
                state: 1,
                posting:false,
                user:{
                    name:"222",
                    phone: "",
                    driver_name: "",
                    type: 0,
                    driver_phone:"",
                    plate_number:""
                },
                treeinfo: {
                    dbh: "",
                    plant_height: "",
                    crown: "",
                    tree_name:"",
                    sum:"",
                    qrcode:""
                },
                photo: [],
                gps:""
            }
        },
        created() {
            this.id = this.$route.params.id;
            setTimeout(()=>{
                this.wxGetLocation().then(res =>{
                    if(res.latitude){
                        this.gps = res.latitude+","+res.longitude
                    }
                })
            },1000)
            this.getStatus()
        },
        methods: {
            linkTreeInfo(){
                this.$router.push({
                    name:"treeInfo",
                    params:{
                        id:this.id
                    }
                })
            },
            onRead(e){
                let that = this;
                imgPreview(e.file).then(file =>{
                    var formData=new FormData();
                    formData.append('photo', file);
                    postSuperviseImg(formData).then(res=>{
                        if(res.data.status == 0){
                            that.photo.push(res.data.photo)
                            if(!that.gps){
                                that.gps = res.data.gps
                            }
                        }else {
                            that.Notify({
                                message: res.data.msg,
                                duration: 1000,
                                background: '#BA4E4E'
                            });
                        }


                    })
                })

            },
            lookImg(index){
                this.ImagePreview({
                    images: this.photo,
                    startPosition: index,
                    onClose() {
                        // do something
                    }
                });
            },
            removeImg(index){
                var arr = this.photo
                arr.splice(index,1)
                this.photo = arr
            },
            subSuperviseInfo() {
                if(!this.buttonActive || this.posting){
                    return
                }
                this.posting = true
                let data = this.user;
                data.photo = this.photo
                data.remark = this.remark
                data.id = this.id
                data.state = this.state
                data.gps = this.gps
                postSuperviseInfo(data).then(res =>{
                    this.posting = false
                    if(res.data.status == 0){
                        window.location.replace('/admin/mobile/zhaoshu/index.html#/treeInfo/'+this.id)
                    }else {
                        this.Notify({
                            message: res.data.msg,
                            duration: 4000,
                            background: '#BA4E4E'
                        });
                    }
                }).catch(()=>{
                    this.posting = false
                })
            },
            linkMoreErrorTree() {

            },
            linkTreeSupervise(index) {
                alert(index)
            },
            getStatus() {
                let data = {
                    id: this.id
                }
                getSuperviseStatus(data).then(res => {
                    this.treeinfo = res.data.info;
                    this.user.name = res.data.user.name
                    this.user.phone = res.data.user.phone
                    this.state = res.data.state
                })
            },
            btnWatchStatus(){
                if(!this.user.name || !this.user.phone || this.photo.length == 0){
                    return false
                }
                if(this.state == 3){
                    if(!this.user.driver_name || !this.user.driver_phone || !this.user.plate_number){
                        return false
                    }
                }
                return true
            }

        },
        watch: {
            user: {
                handler() {
                    this.buttonActive = this.btnWatchStatus()
                },
                deep: true
            },
            photo:{
                handler() {
                    this.buttonActive = this.btnWatchStatus()
                },
                deep: true
            }
        }
    };
</script>

<style lang="less">
    .post-supervise-warp {
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
        .remark {
            width: 345px;
            margin: 0 auto;
            background: #ffffff;
            padding: 0 15px 15px 15px;
            overflow: hidden;
            textarea {
                width: 345px;
                height: 72px;
                background: #EEEEEE;
                font-size: 12px;
                color: #999999;
                border: none;
            }
        }
        .img-warp {
            width: 345px;
            margin: 0 auto;
            margin-top: 10px;
            background: #ffffff;
            padding: 15px;
            overflow: hidden;
            .img-sub .after {
                display: block;
                position: absolute;
                height: 31px;
                width: 3px;
                background: #eeeeee;
                left: 51px;
                top: 37px;
            }
            .img-sub .before {
                display: block;
                position: absolute;
                width: 31px;
                height: 3px;
                background: #eeeeee;
                top: 51px;
                left: 37px;
            }
            .img-sub {
                border: 1px solid #eeeeee;
                box-shadow: 0 0 10px #eaf0f1;
                position: relative;
                label{
                    display: block;
                    width: 105px;
                    height: 105px;
                }
            }
            .imgs:after{
                display: table;
                content: "";
                clear: both;
            }
            .imgs {
                padding-bottom: 15px;
                border-bottom: 1px solid #eeeeee;
                position: relative;
                .removeImg {
                    position: absolute;
                    right: -7px;
                    top: -7px;
                    z-index: 2;
                    border-radius: 20px;
                    img {
                        display: block;
                        width: 17px;
                        height: 17px;
                    }
                }
            }
            .imgs > div:not(:nth-of-type(3n+1)) {
                margin-left: 13px;
            }
            .imgs > div {
                position: relative;
                margin-top: 15px;
                width: 105px;
                height: 105px;
                float: left;
                img {
                    display: block;
                    width: 105px;
                    height: 105px;
                }
            }
        }
        .yichang {
            width: 345px;
            margin: 0 auto;
            margin-top: 10px;
            background: #ffffff;
            padding: 15px;
            overflow: hidden;
            .yichang-radiu {
                padding: 20px 0 10px 0;
                input {
                    display: none;
                }
                .radiu1 {
                    display: block;
                    width: 150px;
                    height: 40px;
                    border-radius: 3px;
                    background: #4EACBA;
                    color: #ffffff;
                    line-height: 40px;
                    text-align: center;
                    font-size: 16px;
                }
                .radiu2 {
                    display: block;
                    width: 150px;
                    height: 40px;
                    border-radius: 3px;
                    background: #ffffff;
                    color: #cccccc;
                    line-height: 40px;
                    text-align: center;
                    font-size: 16px;
                    border: 1px solid #eeeeee;
                }
            }
        }
        .lineTo {
            width: 333px;
            margin: 0 auto;
            border-left: 2px solid #4EACBA;
            padding-left: 10px;
            height: 16px;
            line-height: 16px;
            font-size: 14px;
            color: #666;
            span {
                font-size: 12px;
                color: #999999;
            }
        }
        .user-info {
            width: 345px;
            margin: 0 auto;
            margin-top: 10px;
            background: #ffffff;
            padding: 15px 15px 0 15px;
            .wuliu {
                padding-bottom: 10px;
            }
            .inputTyle:last-of-type {
                border-bottom: none !important;
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
                    input {
                        height: 20px;
                        font-size: 16px;
                        color: #333333;
                        text-align: right;
                    }
                }
            }
        }
        .state-warp {
            width: 345px;
            margin: 0 auto;
            margin-top: 43px;
            background: #ffffff;
            padding: 15px;
            height: 61px;
            img {
                display: block;
                width: 100%;
                margin-top: 15px;
                height: 30px;
            }
        }
        .post-supervise-header > img {
            width: 100%;
            height: 90px;
            display: block;
            position: relative;
        }
        .post-supervise-header {
            width: 100%;
            position: relative;
            .link-treeInfo {
                position: absolute;
                right: 15px;
                top: 16px;
                font-size: 14px;
                color: #ffffff;
                height: 14px;
                line-height: 14px;
                text-align: center;
            }
            .post-supervise-desc {
                z-index: 2;
                width: 345px;
                position: absolute;
                left: 15px;
                top: 44px;
                background: #ffffff;
                height: 80px;
                border-radius: 10px;
                box-shadow: 0 5px 10px #eaf0f1;
                .top {
                    padding: 19px 15px 4px 15px;
                    position: relative;
                    height: 16px;
                    .name {
                        font-size: 16px;
                        color: #333333;
                        float: left;
                        height: 16px;
                        line-height: 16px;
                    }
                    .num {
                        margin-left: 18px;
                        float: left;
                        font-size: 20px;
                        color: #4EACBA;
                        height: 16px;
                        line-height: 16px;
                        span {
                            font-size: 12px;
                            color: #999999;
                            line-height: 16px;
                        }
                    }
                    .code {
                        height: 16px;
                        float: right;
                        img {
                            display: block;
                            float: left;
                            width: 11px;
                            height: 11px;
                            margin-top: 3px;
                        }
                        span {
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
                .bottom {
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
        }
    }
</style>
