<template>
    <div class="supervise-warp">
        <div class="supervise">
            <header>
                <div class="supervise-header">
                    <div class="input-search">
                        <input type="text" ref="searchInput" v-model="searchStr" @blur="searchIconShow" @focus="searchIconToggle"
                               @keydown="getProjectByName">
                        <div :class="searchIcon?'supervise-header-searchIcon':'supervise-header-searchIcon2'" v-show="searchIcon" @click="searchIconToggle">
                            <img src="../../assets/img/search@2x.png" alt="">
                            <span>请输入项目名称</span>
                        </div>
                    </div>
                    <van-tabs v-model="status" color="#4EACBA" @change="changeActive" :line-width="16"
                              class="supervise-header-tab">
                        <van-tab title="进行中"></van-tab>
                        <van-tab title="已完成"></van-tab>
                    </van-tabs>
                </div>
            </header>
            <content>
                <van-list v-if="projectList.length != 0" :offset="10" @load="getMoreProject" v-model="loading"
                          :finished="finished" :finished-text="'没有更多了'">
                    <div class="supervise-content">
                        <div class="supervise-content-one" v-for="(item,index) in projectList"
                             @click="linkContract(index)" :key="item.project_id">
                            <div class="project-name" v-text="item.project_name">

                            </div>
                            <div :class="status == 0? 'project-num':'project-num2'">
                                <span :class="item.sum == 0? '':'colorActive'" v-text="item.sum+'株'"></span>
                            </div>
                            <div class="project-address-warp">
                                <img src="../../assets/img/position@2x.png" alt="">
                                <div class="project-address" v-text="item.address">

                                </div>
                            </div>
                            <div :class="status == 0? 'project-time':'project-time2'" v-text="item.project_time.split(' ')[0]">

                            </div>
                            <div v-show="status == 1" class="status">
                                <img src="../../assets/img/achieve-qian@2x.png" alt="">
                            </div>
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
            </content>
        </div>
    </div>
</template>

<script>
    import {getProjectList} from "../../api/supervise"

    export default {
        data() {
            return {
                loading: false,
                finished: false,
                searchStr: "",
                searchIcon: true,
                status: 0,
                page: 0,
                projectList: [],
                wiff: true
            }
        },
        created() {
            this.getMoreProjectList()
        },
        methods: {
            getMoreProject() {
                this.getMoreProjectList()
            },
            linkContract(index) {
                this.$router.push({
                    name: "contractList",
                    params: {
                        id: this.projectList[index].project_id
                    }
                })
            },
            changeActive() {
                this.page = 0
                this.finished = false
                this.getMoreProjectList();

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
            getProjectByName(e) {
                this.p = 1
                if (e.keyCode == 13) {
                    let data = {
                        project_name: this.searchStr,
                    }
                    this.Toast.loading({
                        message: '加载中...',
                        duration: 0
                    });
                    getProjectList(data).then(res => {
                        this.Toast.clear()
                        var projectList = res.data.data

                        this.$set(this, "projectList", projectList)
                        this.finished = true
                        this.loading = false;

                    }).catch(res => {
                        this.Toast.clear()
                        this.wiff = false;
                        this.page = 0
                    })
                }
            },
            getMoreProjectList() {
                this.page = this.page + 1
                let data = {
                    project_name: this.searchStr,
                    page: this.page,
                    status: this.status + 1
                }
                this.Toast.loading({
                    message: '加载中...',
                    duration: 0
                });
                getProjectList(data).then(res => {
                    this.Toast.clear()
                    var projectList = []
                    if (res.data.page == 1) {
                        projectList = res.data.data
                    } else {
                        projectList = this.projectList.concat(res.data.data)
                    }
                    this.$set(this, "projectList", projectList)
                    if (res.data.data.length == 0) {
                        this.finished = true
                    }
                    this.loading = false;

                }).catch(res => {
                    this.Toast.clear()
                    this.wiff = false;
                    this.page = 0
                })
            }
        }
    };
</script>

<style lang="less">
    .supervise {
        .supervise-content-one {
            margin-left: 15px;
            margin-top: 10px;
            width: 345px;
            height: 84px;
            border-radius: 10px;
            background: #ffffff;
            position: relative;
            box-shadow: 0 5px 10px #eaf0f1;
            .status{
                position: absolute;
                width: 56px;
                height: 43px;
                top: 20px;
                right: 0;
                img{
                    display: block;
                    width: 56px;
                    height: 43px;
                }
            }
            .project-name {
                position: absolute;
                left: 15px;
                top: 20px;
                max-width: 280px;
                font-size: 16px;
                color: #333333;
            }
            .project-num {
                position: absolute;
                right: 15px;
                top: 20px;
                font-size: 14px;
                color: #cccccc;
                .colorActive{
                    color: #4EACBA;
                }
            }
            .project-num2 {
                position: absolute;
                right: 68px;
                top: 20px;
                font-size: 14px;
                color: #cccccc;
                .colorActive{
                    color: #4EACBA;
                }
            }
            .project-address-warp {
                position: absolute;
                left: 15px;
                bottom: 22px;
                img {
                    position: absolute;
                    left: 0;
                    top: 0px;
                    width: 10px;
                    display: block;
                    height: 13px;
                }
                .project-address {
                    font-size: 12px;
                    color: #666666;
                    padding-left: 14px;
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
            height: 90px;
            background: #ffffff;
        }
        &-header {
            text-align: center;
            position: relative;
            height: 90px;
            .input-search{
                padding-top: 15px;
                position: relative;
                height: 50px;
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
                .supervise-header-searchIcon2{
                    display: none !important;
                }
                .supervise-header-searchIcon {
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
            .supervise-header-tab {
                position: absolute;
                left: 0px;
                top: 50px;
                width: 100%;
                height: 44px;
                .van-tab--active {
                    .van-ellipsis {
                        font-size: 16px;
                    }
                }
                .van-hairline--top-bottom::after {
                    border: none;
                }
            }
        }
    }
</style>
