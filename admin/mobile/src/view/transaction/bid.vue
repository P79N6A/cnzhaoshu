<template>
    <div class="bid-warp">
        <div class="supervise">
            <header>
                <div class="bid-header-btn">
                    <van-row type="flex" align="center">
                        <van-col span="8">
                            <div :class="adressactive?'text1':'text'" @click="chooseAddress">
                                用秒地
                                <img v-show="!adressactive" src="../../assets/img/more-address.png" alt="">
                                <img v-show="adressactive" src="../../assets/img/more-address-active.png" alt="">
                            </div>
                        </van-col>
                        <van-col span="8">
                            <div class="title">投标</div>
                        </van-col>
                        <van-col span="8">
                            <div class="btn">
                                <img @click="tuiSong()" v-if="subscribe == 0"
                                     src="../../assets/img/xiaoxi-normal@2x.png" alt="">
                                <img @click="tuiSong()" v-else src="../../assets/img/tuisong-active.png" alt="">
                                <img v-if="!isnurseryName" @click="getMyTree" src="../../assets/img/woshu-normal@2x.png"
                                     alt="">
                                <img v-else @click="getMyTree" src="../../assets/img/woshu-active@2x.png" alt="">
                            </div>
                        </van-col>
                    </van-row>
                </div>
                <div class="bid-header">
                    <div class="input-search">
                        <input type="text" ref="searchInput" v-model="searchStr" @blur="searchIconShow"
                               @focus="searchIconToggle"
                               @keydown="getProjectByName">
                        <div :class="searchIcon?'bid-header-searchIcon':'bid-header-searchIcon2'" v-show="searchIcon"
                             @click="searchIconToggle">
                            <img src="../../assets/img/search@2x.png" alt="">
                            <span>请输入苗木名称</span>
                        </div>
                    </div>
                </div>
            </header>
            <content>
                <van-list v-if="bidList.length != 0" :offset="10" @load="getMoreProject" v-model="loading"
                          :finished="finished" :finished-text="'没有更多了'">
                    <div class="bid-content">
                        <div class="bid-content-one" v-for="(item,index) in bidList"
                             @click="linkContract(index)" :key="item.project_id">
                            <div class="bid-content-one-title">
                                <div class="project-name" v-text="getTitle(item)">
                                </div>
                                <div class="project-name-num">
                                    <span v-text="item.tree_num+'株'"></span>
                                </div>
                                <div class="project-time">
                                    <img src="../../assets/img/daojishi-icon@2x.png" alt="">
                                    <span v-text="getlLastTime(item.project_info.Up_time)"></span>
                                </div>
                            </div>
                            <div class="bid-content-one-biaozhu">
                                <div class="bottom">
                                    <span v-if="item.dbh" v-text="'胸径'+item.dbh"></span>
                                    <span v-if="item.plant_height" v-text="'株高'+item.plant_height"></span>
                                    <span v-if="item.crown" v-text="'冠幅'+item.crown"></span>
                                </div>
                            </div>
                            <div class="project-address-warp">
                                <img src="../../assets/img/position@2x.png" alt="">
                                <div class="project-address"
                                     v-text="item.project_info.hcity+item.project_info.hproper+item.project_info.harea">
                                </div>
                                <div class="project-name" v-text="item.project_info.partya_company_name">

                                </div>
                            </div>
                            <div class="project-address-remark" v-text="item.remarks"></div>
                        </div>
                    </div>
                </van-list>
                <div v-else>
                    <div v-if="wiff" class="supervise-none">
                        <img class="img-none" src="../../assets/img/none.png" alt="">
                        <p class="none-descript">该条件下目前没有数据哦~</p>
                    </div>
                    <div v-else class="supervise-wiff">
                        <img class="img-none" src="../../assets/img/none.png" alt="">
                        <p class="none-descript">该条件下目前没有数据哦~</p>
                        <img @click="getMoreProjectList" class="supervise-wiff-refresh"
                             src="../../assets/img/sent@2x.png" alt="">
                    </div>
                </div>
                <div v-show="adressactive" class="address-warp">
                    <div class="address-content">
                        <div :class="localAddress.length == 0?'activebtn':'btn'" @click="removeAllAddress">全部</div>
                        <div v-for="item in addressList" :class="addressActive(item)?'activebtn':'btn'" :key="item"
                             v-text="item" @click="changgeAddress(item)"></div>
                    </div>
                    <div class="address-btn">
                        <div @click="clearAddress">重置</div>
                        <div @click="confirmAddress">确认</div>
                    </div>
                </div>
            </content>
            <van-dialog
                    v-model="subWarpShow"
                    show-cancel-button
                    :before-close="beforeClose"
                    confirm-button-text="投标"
                    title="我的报价"
            >
                <div class="warp-content">
                    <van-field
                            required
                            v-model="bidInfo.tree_price"
                            label="单价(元/株)"
                            placeholder="请输入上车价"
                    />
                    <van-field
                            required
                            v-model="bidInfo.tree_num"
                            label="数量(株)"
                            placeholder="请输入数量"
                    />
                    <div v-show="isnull_user == 0">
                        <van-field
                                required
                                v-model="bidInfo.phone"
                                label="手机号"
                                placeholder="请输入手机号"
                        />
                    </div>
                    <van-field
                            @click="showChooseAddress"
                            v-model="bidInfo.tree_address"
                            required
                            clearable
                            label="苗源地"
                            icon="arrow-down"
                            @click-icon="showChooseAddress"
                            readonly
                    />
                    <van-field
                            clearable
                            label="图片上传"
                            readonly
                    />
                    <div class="imgs">

                        <van-row type="flex" justify="left" align="center">
                            <van-col span="8" v-for="(item,index) in bidInfo.tree_imgs" :key="item">
                                <div class="img-one">
                                    <img class="img-close" src="../../assets/img/cha@2x.png" alt="" @click="removeBidImg(index)">
                                    <img class="img-inner" :src="'/admin/'+item" alt="">
                                </div>
                            </van-col>
                            <van-col span="8">
                                <label class="img-one" for="labelimg">
                                    <img class="img-btn" src="../../assets/img/shizi.png" alt="">
                                </label>
                                <van-uploader v-show="false" id="labelimg" :after-read="addimg">
                                </van-uploader>
                            </van-col>
                        </van-row>
                    </div>

                </div>
            </van-dialog>
        </div>
        <van-popup v-model="addressChooseActive" position="bottom" :overlay="false">
            <van-area :area-list="areaList" :columns-num="2" title="苗源地选择" @confirm="addresConfirmBack"
                      @cancel="addressChooseActive=false"/>
        </van-popup>
    </div>
</template>

<script>
    import {getBidList, getBidNurseryInfo, getMsg, getNurseryName,postBidImg,subBidInfo} from "../../api/transaction"
    import cookie from 'js-cookie'
    import {areaList} from '../../config/area'
    import {imgPreview} from '../../libs/imgPreview'
    export default {
        data() {
            return {
                areaList: [],
                addressChooseActive: false,
                bidInfo: {
                    tree_price: '',
                    tree_num: '',
                    phone: '',
                    tree_imgs: [],
                    tree_id: '',
                    tree_address: ''
                },
                bidIndx: "",
                subWarpShow: false,
                isnull_user: 0,
                nurseryName: [],
                loading: false,
                finished: false,
                searchStr: "",
                searchIcon: true,
                adressactive: false,
                page: 0,
                bidList: [],
                wiff: true,
                subscribe: 0,
                isnurseryName: false,
                treeInfo: {
                    dbh: "222gp"
                },
                localAddress: [],
                addressList: ["北京", "天津", "河北省", "山东省", "河南省", "山西省", "辽宁省", "吉林省", "黑龙江省", "上海", "江苏省", "浙江省", "安徽省", "福建省", "江西省", "湖北省", "湖南省", "广东省", "广西", "海南省", "重庆", "四川省", "贵州省", "云南省", "西藏", "陕西省", "甘肃省", "青海省", "宁夏", "新疆", "台湾省"]
            }
        },
        created() {
            this.areaList = areaList;
            let localAddress = cookie.get('address', this.localAddress)
            localAddress ? this.localAddress = JSON.parse(cookie.get('address', this.localAddress)) : this.localAddress = []
            this.getMoreProjectList()
            getNurseryName({}).then(res => {
                if (res.data.data) {
                    this.nurseryName = res.data.data
                    this.isnull_user = res.data.isnull_user
                }

            })
        },
        methods: {
            //投标图片删除index
            removeBidImg(index){
                var tree_imgs = this.bidInfo.tree_imgs;
                tree_imgs.splice(index,1)
                this.$set(this.bidInfo,"tree_imgs",tree_imgs)
            },
            //投标图片添加
            addimg(e){
                let that = this;
                imgPreview(e.file).then(file =>{
                    var formData=new FormData();
                    formData.append('img', file);
                    postBidImg(formData).then(res=>{
                        if(res.data.status == 0){
                            var tree_imgs = this.bidInfo.tree_imgs
                            tree_imgs.push(res.data.data)
                            that.$set(that.bidInfo,"tree_imgs",tree_imgs)
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
            //地区确定
            addresConfirmBack(back) {
                var address = "";
                address += back[0].name
                address += " "
                address += back[1].name
                this.bidInfo.tree_address = address
                this.addressChooseActive = false
            },
            //地区选择碳层显示
            showChooseAddress() {
                this.addressChooseActive = true
            },
            //清除投标弹窗数据
            clearBidInfo() {
                this.bidInfo = {
                    tree_price: '',
                    tree_num: '',
                    phone: '',
                    tree_imgs: [],
                    tree_id: '',
                    tree_address: ''
                }
                this.addressChooseActive = false
            },
            //弹窗关闭之前回调
            beforeClose(action, done) {
                if (action == "cancel") {
                    this.clearBidInfo()
                    done()
                } else {
                    let data = this.bidInfo
                    if(this.bidInfo.tree_price == ""){
                        this.Notify({
                            message: "价格必填！",
                            duration: 1000,
                            background: '#BA4E4E'
                        });
                        done(false)
                        return
                    }
                    if(this.bidInfo.tree_num == ""){
                        this.Notify({
                            message: "数量必填！",
                            duration: 1000,
                            background: '#BA4E4E'
                        });
                        done(false)
                        return
                    }
                    if(this.bidInfo.tree_address == ""){
                        this.Notify({
                            message: "苗源地必填！",
                            duration: 1000,
                            background: '#BA4E4E'
                        });
                        done(false)
                        return
                    }
                    if(this.bidInfo.phone == "" && this.isnull_user == 0){
                        this.Notify({
                            message: "手机号必填！",
                            duration: 1000,
                            background: '#BA4E4E'
                        });
                        done(false)
                        return
                    }
                    data.tree_id = this.bidList[this.bidIndx].tree_order_id
                    subBidInfo(data).then(() =>{
                        this.Notify({
                            message: '投标成功！',
                            duration: 2000,
                            background: '#4EACBA'
                        });
                        var bidlist = this.bidList
                        bidlist.splice(this.bidIndx,1)
                        this.bidList = bidlist
                        done()
                        this.clearBidInfo()
                    }).catch(() =>{
                        this.Notify({
                            message: "系统出错，请重新登录后重试!",
                            duration: 1000,
                            background: '#BA4E4E'
                        });
                        done()
                        this.clearBidInfo()
                    })



                }
            },
            //去除所有地区内存
            removeAllAddress() {
                this.localAddress = []
            },
            //地区匹配
            addressActive(name) {
                return this.localAddress.indexOf(name) != -1
            },
            //地区按钮添加删除
            changgeAddress(name) {
                var arr = this.localAddress
                if (this.localAddress.indexOf(name) > -1) {
                    arr.splice(this.localAddress.indexOf(name), 1)
                } else {
                    arr.push(name)
                }
                this.localAddress = arr
            },
            //确认用秒地
            confirmAddress() {
                this.adressactive = false;
                this.page = 0;
                cookie.set('address', this.localAddress)
                this.getMoreProjectList()
            },
            //清除地区选择
            clearAddress() {
                this.localAddress = [];
                this.adressactive = false;
                this.page = 0;
                this.getMoreProjectList()
            },
            //苗原地选择
            chooseAddress() {
                this.adressactive = !this.adressactive;
            },
            //消息推送配置
            tuiSong() {
                let data = {}
                if (this.subscribe == 0) {
                    data.subscribe = 1
                } else {
                    data.subscribe = 0
                }
                getMsg(data).then(() => {
                    if (this.subscribe == 0) {
                        this.subscribe = 1
                        this.Notify({
                            message: '开启微信给您推送投标匹配信息！',
                            duration: 2000,
                            background: '#4EACBA'
                        });
                    } else {
                        this.subscribe = 0
                        this.Notify({
                            message: "停止通过微信给您推送投标匹配信息！",
                            duration: 1000,
                            background: '#BA4E4E'
                        });
                    }
                })
            },
            getMyTree() {
                this.isnurseryName = true;
                this.page = 0;
                this.getMoreProjectList()
            },
            getMoreProject() {
                this.getMoreProjectList()
            },
            //图片列表添加
            imgsPush(path) {
                let imgs = this.bidInfo.tree_imgs
                imgs.push(path)
                this.$set(this.bidInfo, "tree_imgs", imgs)
            },
            //图片列表删除
            imgsRemove(index) {
                let imgs = this.bidInfo.tree_imgs
                imgs.slice(index, 1)
                this.$set(this.bidInfo, "tree_imgs", imgs)
            },
            //投标点击处理并且 弹出层展示
            linkContract(index) {
                this.bidIndx = index;
                let data = {
                    tree_id: this.bidList[index].tree_order_id,
                    tree_name: this.bidList[index].tree_name
                }
                getBidNurseryInfo(data).then(res => {
                    let info = res.data.nursery
                    this.bidInfo = {
                        tree_price: info.price ? info.price : "",
                        tree_num: info.count ? info.count : "",
                        phone: '',
                        tree_imgs: [],
                        tree_address: info.province ? info.province : ""
                    }
                    if (info.province) {
                        this.bidInfo.tree_address = info.province + " " + info.city
                    }
                    if (info.imgpath) {
                        this.imgsPush(info.imgpath)
                    }
                    this.subWarpShow = true;
                }).catch(() => {
                    this.subWarpShow = true;
                })
            },
            searchIconToggle() {
                this.searchIcon = false;
                this.$refs["searchInput"].focus();
            },
            searchIconShow() {
                if (this.searchStr == "") {
                    this.searchIcon = true
                }
            },
            //获取剩余天数
            getlLastTime(Up_time) {
                var time = new Date().getTime();
                var endtime = new Date(Up_time.replace(/-/g, "/")).getTime();
                var timenum = (endtime - time) / 1000 / 60 / 60;
                var timestr = "";
                if (time <= 0) {
                    timestr = "已经截止投标"
                } else {
                    if (parseInt(timenum) < 1) {
                        timestr = "剩余1小时"

                    } else if (1 < parseInt(timenum) && parseInt(timenum) < 24) {
                        timestr = "剩余" + parseInt(timenum) + "小时"

                    } else {
                        timestr = "剩余" + parseInt(parseInt(timenum) / 24) + "天"
                    }
                }
                return timestr
            },
            getTitle(treeInfo) {
                var title = "";
                if (treeInfo.dbh) {
                    title = treeInfo.dbh + "公分";
                } else if (treeInfo.plant_height) {
                    title = treeInfo.plant_height + "米"
                } else if (treeInfo.crown) {
                    title = treeInfo.crown + "公分"
                }
                title += treeInfo.tree_name
                return title
            },
            //根据树名获取
            getProjectByName(e) {
                if (e.keyCode == 13) {
                    this.page = 0;
                    this.isnurseryName = false;
                    this.Toast.loading({
                        message: '加载中...',
                        duration: 0
                    });
                    this.getMoreProjectList()
                }
            },
            //我有的树  提示信息拼串
            myTreeAllStr() {
                let miaoputreeList = this.nurseryName;
                let arrstr = "根据您的苗圃"
                for (var index in miaoputreeList) {
                    if (miaoputreeList[index].dbh) {
                        arrstr += miaoputreeList[index].dbh + "公分";
                    } else if (miaoputreeList[index].height) {
                        arrstr += miaoputreeList[index].height + "米"
                    } else if (miaoputreeList[index].crownwidth) {
                        arrstr += miaoputreeList[index].crownwidth + "公分"
                    }
                    arrstr += `${miaoputreeList[index].name}`
                }
                return arrstr += "进行匹配"
            },
            getList(data) {
                getBidList(data).then(res => {
                    this.Toast.clear()
                    var bidList = []
                    if (res.data.p == 1) {
                        bidList = res.data.data
                    } else {
                        bidList = this.bidList.concat(res.data.data)
                    }
                    this.$set(this, "bidList", bidList)
                    if (res.data.data.length == 0) {
                        this.finished = true
                    }
                    this.loading = false;

                }).catch(() => {
                    this.Toast.clear()
                    this.wiff = false;
                    this.page = 0
                })
            },
            getMoreProjectList() {
                this.page = this.page + 1;
                let data = {}
                if (!this.isnurseryName) {
                    data = {
                        name: this.searchStr,
                        p: this.page,
                        address: this.localAddress
                    }
                    this.Toast.loading({
                        message: '加载中...',
                        duration: 0
                    });
                    this.getList(data)

                } else {
                    data = {
                        nursery_info: this.nurseryName,
                        p: this.page,
                        address: this.localAddress
                    }
                    if (this.nurseryName.length == 0) {
                        this.$toast('苗圃为空,请及时更新苗圃完成匹配!');
                        return
                    }
                    this.Dialog.alert({
                        title: '苗店匹配',
                        message: this.myTreeAllStr()
                    }).then(() => {
                        this.Toast.loading({
                            message: '加载中...',
                            duration: 0
                        });
                        this.getList(data)
                    });
                }

            }
        }
    };
</script>

<style lang="less">
    .supervise {
        .warp-content {
            padding-top: 16px;
            .imgs {
                padding: 0 0.4rem 0.26667rem 0.4rem;
                .van-row--align-center{
                    flex-wrap: wrap !important;
                    .van-col{
                        margin-top: 10px;
                    }
                }
                .img-one:last-of-type{
                    border: 1px solid #eeeeee;
                }
                .img-one {
                    display: block;
                    width: 76px;
                    height: 76px;
                    position: relative;
                    .img-btn {
                        position: absolute;
                        display: block;
                        width: 33px;
                        left: 21px;
                        top: 21px;
                        height: 33px;
                    }
                    .img-inner {
                        display: block;
                        width: 76px;
                        height: 76px;
                    }
                    .img-close {
                        position: absolute;
                        display: block;
                        width: 17px;
                        height: 17px;
                        top: -9px;
                        right: -9px;
                    }
                }
            }
            .van-field__control {
                text-align: right;
            }
        }
        .van-dialog__footer {
            border-top: 1px solid #eeeeee !important;
        }
        .van-dialog__confirm, .van-dialog__confirm:active {
            color: #4EACBA !important;
        }
        .van-dialog .van-button {
            border-right: 1px solid #eeeeee !important;
        }
        .address-warp {
            position: fixed;
            top: 44px;
            left: 0px;
            right: 0px;
            bottom: 0px;
            background: rgba(0, 0, 0, 0.5);
            .address-btn {
                div:first-of-type {
                    width: 50%;
                    height: 40px;
                    text-align: center;
                    line-height: 40px;
                    color: #333333;
                    background: #FFFFFF;
                    float: left;
                    font-size: 16px;
                }
                div:last-of-type {
                    width: 50%;
                    height: 40px;
                    text-align: center;
                    line-height: 40px;
                    color: #FFFFFF;
                    background: #4EACBA;
                    float: left;
                    font-size: 16px;
                }
            }
            .address-content {
                padding: 0 10px 5px 10px;
                overflow: hidden;
                background: #ffffff;
                border-bottom: 1px solid #eeeeee;
                .btn {
                    margin-top: 5px;
                    margin-left: 5px;
                    margin-right: 5px;
                    width: 78px;
                    height: 30px;
                    float: left;
                    text-align: center;
                    line-height: 30px;
                    border-radius: 30px;
                    color: #666666;
                    background: #F5F5F5;
                    font-size: 14px;
                }
                .activebtn {
                    margin-top: 5px;
                    margin-left: 5px;
                    margin-right: 5px;
                    width: 78px;
                    height: 30px;
                    float: left;
                    text-align: center;
                    line-height: 30px;
                    border-radius: 30px;
                    color: #4EACBA;
                    background: #C3E3E7;
                    font-size: 14px;
                }
            }
        }
        .bid-content-one {
            margin-left: 15px;
            margin-top: 10px;
            width: 345px;
            border-radius: 10px;
            background: #ffffff;
            position: relative;
            box-shadow: 0 5px 10px #eaf0f1;
            padding: 20px 0;
            .bid-content-one-biaozhu {
                height: 20px;
                padding-bottom: 15px;
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
            .bid-content-one-title {
                height: 20px;
                .project-name {
                    float: left;
                    height: 20px;
                    line-height: 20px;
                    margin-left: 15px;
                    max-width: 280px;
                    font-size: 16px;
                    color: #333333;
                }
                .project-name-num {
                    float: left;
                    height: 20px;
                    line-height: 20px;
                    margin-left: 8px;
                    max-width: 280px;
                    font-size: 14px;
                    color: #4EACBA;
                }
                .project-time {
                    position: absolute;
                    right: 15px;
                    top: 19px;
                    font-size: 12px;
                    color: #cccccc;
                    height: 20px;
                    img {
                        width: 8px;
                        height: 11px;
                        display: block;
                        float: left;
                        margin-top: 6px;
                    }
                    span {
                        display: block;
                        float: left;
                        height: 20px;
                        font-size: 12px;
                        color: #cccccc;
                        line-height: 20px;
                        margin-left: 4px;
                        margin-top: 2px;
                    }
                }
            }
            .project-num2 {
                position: absolute;
                right: 68px;
                top: 20px;
                font-size: 14px;
                color: #cccccc;
                .colorActive {
                    color: #4EACBA;
                }
            }
            .project-address-remark {
                padding: 12px 0 0 0;
                width: 315px;
                margin: 0 auto;
                margin-top: 12px;
                line-height: 20px;
                font-size: 12px;
                color: #999999;
                border-top: 1px solid #eeeeee;
            }
            .project-address-warp {
                position: relative;
                padding: 0 15px;
                height: 14px;
                img {
                    display: block;
                    float: left;
                    width: 10px;
                    height: 13px;
                }
                .project-address {
                    display: block;
                    float: left;
                    font-size: 12px;
                    color: #999999;
                    margin-left: 5px;
                }
                .project-name {
                    display: block;
                    float: left;
                    font-size: 12px;
                    color: #999999;
                    margin-left: 5px;
                }
            }
            .project-time {
                position: absolute;
                right: 16px;
                bottom: 22px;
                font-size: 12px;
                color: #666666;
            }
            .project-time2 {
                position: absolute;
                right: 68px;
                bottom: 22px;
                font-size: 12px;
                color: #666666;
            }
        }
        header {
            width: 100%;
        }
        .bid-header-btn {
            height: 44px;
            padding: 0 15px 20px 15px;
            background: #ffffff;
            .btn {
                text-align: right;
                font-size: 16px;
                img {
                    width: 45px;
                    height: 44px;
                    margin-left: 9px;
                }
            }
            .title {
                font-size: 18px;
                text-align: center;
                font-family: PingFang-SC-Medium;
                font-weight: 500;
                color: rgba(51, 51, 51, 1);
            }
            .text {
                height: 44px;
                line-height: 44px;
                text-align: left;
                font-size: 16px;
                font-family: PingFang-SC-Regular;
                font-weight: 400;
                color: rgba(102, 102, 102, 1);
                img {
                    width: 12px;
                    height: 7px;
                    transform: translateY(-3px);
                }
            }
            .text1 {
                height: 44px;
                line-height: 44px;
                text-align: left;
                font-size: 16px;
                font-family: PingFang-SC-Regular;
                font-weight: 400;
                color: #4EACBA;
                img {
                    width: 12px;
                    height: 7px;
                    transform: translateY(-3px);
                }
            }
        }
        .bid-header {
            text-align: center;
            position: relative;
            .input-search {
                padding-top: 15px;
                position: relative;
                padding-bottom: 10px;
                margin-top: -30px;
                input {
                    display: block;
                    display: block;
                    height: 30px;
                    margin: 0 auto;
                    width: 345px;
                    border-radius: 3px;
                    outline: none;
                    border: none;
                    font-size: 14px;
                    color: #cccccc;
                    text-align: center;
                    box-shadow: 0 0 5px #ccc;
                    box-sizing: border-box;
                    -webkit-appearance: none;
                }
                .bid-header-searchIcon2 {
                    display: none !important;
                }
                .bid-header-searchIcon {
                    height: 30px;
                    width: 100%;
                    top: 15px;
                    left: 0px;
                    position: absolute;
                    img {
                        height: 14px;
                        width: 12px;
                        display: block;
                        float: left;
                        margin-left: 135px;
                        margin-top: 8px;
                    }
                    span {
                        height: 30px;
                        width: 100px;
                        font-size: 14px;
                        line-height: 30px;
                        display: block;
                        margin-left: 3px;
                        margin-top: 3px;
                        display: block;
                        float: left;
                        color: #cccccc;
                    }
                }
            }
            .van-cell {
                padding: 0;
            }
        }
    }
</style>
