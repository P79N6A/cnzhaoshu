<style scoped>
  .img-warp {
    position: fixed;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    background: rgba(1, 1, 1, .5);
    z-index: 10000;
  }

  .img-warp-inner {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    height: 667px;
  }

  .demo-carousel img {
    width: 375px;
  }

  .dengpostition {
    position: relative;
    margin: 0 auto;
    width: 375px;
    margin-top: 50px;
  }

  .left-img-warp {
    height: 60px;
  }

  .left-img-warp img {
    height: 60px;
    max-width: 120px;
    padding-left: 20px;
  }

  .bind-one span {
    margin-right: 20px;
  }

  .bind-one Card {
    height: 65px;
  }

</style>
<template>
  <div style="position: relative">
    <div class="img-warp" v-show="imgwarp" @click="closeImgWarp">
      <div class="img-warp-inner">
        <Carousel v-model="value1" loop :width="375" class="dengpostition">
          <CarouselItem v-for="item in warpImgs" :key="index">
            <div class="demo-carousel"><img :src="item" alt=""></div>
          </CarouselItem>
        </Carousel>
      </div>
    </div>
    <div v-if="bidList && bidList.length != 0" class="bind-one">
      <Tabs :animated="false">
        <TabPane :label="label1">
          <Card v-for="(item,index) in bidList" v-show="item.tender_status == 1 && item.adoption_status == 0" :key="index">
            <Row type="flex" justify="center" align="middle" class="code-row-bg">
              <Col span="3" class="left-img-warp"><img @click="showImgWarp(index)"
                                                       :src="item.tree_imgs?item.tree_imgs[0]:''"
                                                       alt=""></Col>
              <Col span="13">
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">￥{{item.tree_price}}</span>
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">{{item.tree_num}}株</span>
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">{{item.tree_address?item.tree_address:'无地址'}}</span>
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">{{item.userinfo?item.userinfo.name:'无姓名'}}</span>
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">{{item.userinfo?item.userinfo.phone:'无电话'}}</span>
              </Col>
              <Col span="8">
                <Button type="info" v-show="item.tender_status != 2" style="margin-right: 30px"
                        @click="recommend(index)">
                  推荐
                </Button>
                <Button type="error" v-show="item.tender_status != 3" @click="abandon(index)">舍弃</Button>
              </Col>
            </Row>
          </Card>
          <Card v-show="emptyTips(1) == 0">
            <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">待审核信息为空</span>
          </Card>
        </TabPane>
        <TabPane :label="label2">
          <Card v-for="(item,index) in bidList" v-show="item.tender_status != 1 && item.adoption_status == 0"
                :key="index">
            <Row type="flex" justify="center" align="middle" class="code-row-bg">
              <Col span="5" class="left-img-warp"><img @click="showImgWarp(index)"
                                                       :src="item.tree_imgs?item.tree_imgs[0]:''"
                                                       alt=""></Col>
              <Col span="11">
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">￥{{item.tree_price}}</span>
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">{{item.tree_num}}株</span>
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">{{item.tree_address?item.tree_address:'无地址'}}</span>
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">{{item.userinfo?item.userinfo.name:'无姓名'}}</span>
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">{{item.userinfo?item.userinfo.phone:'无电话'}}</span>
              </Col>
              <Col span="8">
                <Button shape="circle" disabled>{{item.tender_status == 2?"已推荐":"已舍弃"}}</Button>
              </Col>
            </Row>
          </Card>
          <Card v-show="emptyTips(2) == 0">
            <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">已审核信息为空</span>
          </Card>
        </TabPane>
        <TabPane :label="label3">
          <Card v-for="(item,index) in bidList" v-show="item.adoption_status == 1 && item.provider_status == 0"
                :key="index">
            <Row type="flex" justify="center" align="middle" class="code-row-bg">
              <Col span="3" class="left-img-warp"><img @click="showImgWarp(index)"
                                                       :src="item.tree_imgs?item.tree_imgs[0]:''"
                                                       alt=""></Col>
              <Col span="13">
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">￥{{item.tree_price}}</span>
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">{{item.tree_num}}株</span>
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">{{item.tree_address?item.tree_address:'无地址'}}</span>
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">{{item.userinfo?item.userinfo.name:'无姓名'}}</span>
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">{{item.userinfo?item.userinfo.phone:'无电话'}}</span>
              </Col>
              <Col span="8">
                <Button type="info" @click="becomeSupplier(index)">成为供应商</Button>
              </Col>
            </Row>
          </Card>
          <Card v-show="emptyTips(3) == 0">
            <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">采用信息为空</span>
          </Card>
        </TabPane>
        <TabPane :label="label4">
          <Card v-for="(item,index) in bidList" v-show="item.adoption_status == 1 && item.provider_status == 1"
                :key="index">
            <Row type="flex" justify="center" align="middle" class="code-row-bg">
              <Col span="3" class="left-img-warp"><img @click="showImgWarp(index)"
                                                       :src="item.tree_imgs?item.tree_imgs[0]:''"
                                                       alt=""></Col>
              <Col span="13">
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">￥{{item.tree_price}}</span>
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">{{item.tree_num}}株</span>
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">{{item.tree_address?item.tree_address:'无地址'}}</span>
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">{{item.userinfo?item.userinfo.name:'无姓名'}}</span>
                <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">{{item.userinfo?item.userinfo.phone:'无电话'}}</span>
              </Col>
              <Col span="8">
                <Button type="info" @click="codeListShow(index)" style="margin-right: 30px">二维码管理</Button>
                <Button type="info" @click="getContract(index)" style="margin-right: 30px">下载合同</Button>
              </Col>
            </Row>
          </Card>
          <Card v-show="emptyTips(4) == 0">
            <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">供应商信息为空</span>
          </Card>
        </TabPane>
      </Tabs>
    </div>
    <div v-else>
      <span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">无投标信息</span>
    </div>
    <Drawer title="二维码管理侧边栏" :width="50" :closable="false" v-model="codeListStatu">
      <Input v-model="codeId" @on-keydown="bindCode" icon="md-camera" placeholder="扫码枪扫码添加" style="width: 200px" :autofocus="true"/><span style="color: #ed4014;margin-left: 5px">*保证输入框处于获取焦点状态，用扫码枪添加</span>
      <div v-show="codeIdList.length != 0">
        <div style="position:relative; text-align: right;padding: 6px 0">
          <div style="font-size: 14px;color: #464c5b;position:absolute;left: 0;top: 12px">添加二维码{{codeIdList.length == 0?"":"/已添加"}}<Badge :count="codeIdList.length" type="success"></Badge></div>
          <Button @click="clearCodeIdList" type="error" style="margin-right: 10px">批量清除二维码</Button>
          <Button type="primary" @click="addCodeList">批量添加二维码</Button>
        </div>
       <Table border :columns="codeListmodel" :data="codeIdList"></Table>
      </div>
      <div>
        <div style="font-size: 14px;color: #464c5b;padding: 6px 0">需要绑定二维码<Badge :count="allCodeNum" type="success"></Badge>{{codeData.length == 0?"":"/已绑定"}}<Badge :count="codeData.length" type="success"></Badge></div>
        <Table border :columns="codemodel" :data="codeData"></Table>
      </div>
    </Drawer>
    <Drawer title="个人所在企业信息补录" :width="35" placement="right" @on-close="clearContractInfoDate"  :closable="false"  v-model="contractInfoWarp">
      <Form ref="contractInfo" :model="contractInfoDate" :rules="contractInfoRule" :label-width="80">
        <FormItem label="公司名称" prop="company_name">
          <Input v-model="contractInfoDate.company_name" placeholder="公司名称"></Input>
        </FormItem>
        <FormItem label="法人代表" prop="representative">
          <Input v-model="contractInfoDate.representative" placeholder="法人代表"></Input>
        </FormItem>
        <FormItem label="开户银行" prop="open_bank">
          <Input v-model="contractInfoDate.open_bank" placeholder="开户银行"></Input>
        </FormItem>
        <FormItem label="银行账户" prop="bank_num">
          <Input v-model="contractInfoDate.bank_num" placeholder="银行账户"></Input>
        </FormItem>
        <FormItem label="税号" prop="duty_paragraph">
          <Input v-model="contractInfoDate.duty_paragraph" placeholder="税号"></Input>
        </FormItem>
        <FormItem label="地址" prop="address">
          <Input v-model="contractInfoDate.address" placeholder="地址"></Input>
        </FormItem>
        <FormItem label="联系人" prop="contacts">
          <Input v-model="contractInfoDate.contacts" placeholder="联系人"></Input>
        </FormItem>
        <FormItem label="微信绑定手机号" prop="tel">
          <Input readonly v-model="contractInfoDate.tel" placeholder="微信绑定手机号"></Input>
        </FormItem>
        <FormItem>
          <Button type="primary" @click="handleSubmit('contractInfo')">绑定信息下载合同</Button>
        </FormItem>
      </Form>
    </Drawer>
  </div>

</template>

<script>
  import {changeBidStatus, changeProviderStatus,getContract,sendContractInfo} from '@/api/data'
  import {bindCodeList,getCodeList} from '@/api/treeCode'
  export default {
    props: {
      params: Object
    },
    data() {
      return {
        codeListStatu: false,
        contractInfoWarp:false,
        contractInfoDate:{
          company_name:"",
          representative:"",
          open_bank:"",
          bank_num:"",
          duty_paragraph:"",
          address:"",
          contacts:"",
          tel:""
        },
        contractInfoRule:{
          company_name:[
            {
              required:true,
              message:"公司名称必填"
            }
          ],
          representative:[
            {
              required:true,
              message:"法人代表必填"
            }
          ],
          open_bank:[
            {
              required:true,
              message:"开户银行必填"
            }
          ],
          bank_num:[
            {
              required:true,
              message:"银行账户必填"
            }
          ],
          duty_paragraph:[
            {
              required:true,
              message:"税号必填"
            }
          ],
          address:[
            {
              required:true,
              message:"地址必填"
            }
          ],
          contacts:[
            {
              required:true,
              message:"联系人必填"
            }
          ],
          tel:[
            {
              required:true,
              message:"微信关联手机号必填"
            }
          ]
        },
        codeListmodel: [
          {
            title: '序号',
            key: 'index',
            render: (h, params) => {
              return h('div', [
                h('Icon', {
                  props: {
                    type: 'person'
                  }
                }),
                h('strong', params.index + 1)
              ]);
            }
          },
          {
            title: '二维码序号',
            key: 'qrcode'
          }, {
            title: '操作',
            key: 'action',
            render: (h, params) => {

              return h('div', [
                h('Button', {
                  props: {
                    type: 'error',
                    size: 'small'
                  },
                  style: {
                    marginRight: '5px'
                  },
                  on: {
                    click: (e) => {
                      e.stopPropagation()
                      window.event.cancelBubble = true;
                      this.codeListRome(params.index)
                    }
                  }
                }, '删除')
              ])
            }
          }
        ],
        codemodel: [
          {
            title: '序号',
            key: 'index',
            render: (h, params) => {
              return h('div', [
                h('Icon', {
                  props: {
                    type: 'person'
                  }
                }),
                h('strong', params.index + 1)
              ]);
            }
          }, {
            title: '二维码序号',
            key: 'qrcode'
          }/*, {
            title: '操作',
            key: 'action',
            render: (h, params) => {
              if (true) {
                return h('div', [
                  h('Button', {
                    props: {
                      type: 'error',
                      size: 'small'
                    },
                    style: {
                      marginRight: '5px'
                    },
                    on: {
                      click: (e) => {
                        e.stopPropagation()
                        window.event.cancelBubble = true;

                      }
                    }
                  }, '禁用')
                ])
              } else {
                return h('div', [
                  h('Button', {
                    props: {
                      type: 'primary',
                      size: 'small'
                    },
                    style: {
                      marginRight: '5px'
                    },
                    on: {
                      click: (e) => {
                        e.stopPropagation()
                        window.event.cancelBubble = true;

                      }
                    }
                  }, '启用')
                ])
              }

            }
          }*/
        ],
        codeData: [],
        codeId: "",
        codeIdList: [],
        label1: (h) => {
          return h('div', [
            h('span', '待审核'),
            h('Badge', {
              props: {
                count: this.emptyTips(1) == 0 ? 0 : this.emptyTips(1)
              }
            })
          ])
        },
        label2: (h) => {
          return h('div', [
            h('span', '已审核'),
            h('Badge', {
              props: {
                count: this.emptyTips(2) == 0 ? 0 : this.emptyTips(2)
              }
            })
          ])
        },
        label3: (h) => {
          return h('div', [
            h('span', '已采用'),
            h('Badge', {
              props: {
                count: this.emptyTips(3) == 0 ? 0 : this.emptyTips(3)
              }
            })
          ])
        },
        label4: (h) => {
          return h('div', [
            h('span', '供应商'),
            h('Badge', {
              props: {
                count: this.emptyTips(4) == 0 ? 0 : this.emptyTips(4)
              }
            })
          ])
        },
        value1: 0,
        imgwarp: false,
        bidList: [],
        warpImgs: [],
        abandonValue: '',
        bidIndex:0,
        allCodeNum:0

      }
    },
    methods: {
      clearContractInfoDate(){
        this.contractInfoDate={
          company_name:"",
            representative:"",
            open_bank:"",
            bank_num:"",
            duty_paragraph:"",
            address:"",
            contacts:"",
            tel:""
        }
        this.$refs["contractInfo"].resetFields();
      },
      handleSubmit(refName){
        this.$refs[refName].validate((valid) => {
          if (valid) {
            let companyInfo = this.contractInfoDate;
            companyInfo.tender_order_id = this.bidList[this.bidIndex].tender_order_id
            sendContractInfo(companyInfo).then(res =>{
              if(res.data.status == 0){
                window.location.href = res.data.msg;
                this.contractInfoWarp = false
              }else {
                this.$Message.error(res.data.msg);
              }

            })
          } else {
            this.$Message.error('根据提示填写信息');
          }
        })
      },
      getContract(index){
        this.bidIndex = index
        let data = {
            tender_order_id:this.bidList[index].tender_order_id
        }

        getContract(data).then(res=>{
          if(res.data.status == 1){
            this.contractInfoWarp = true;
            this.contractInfoDate.tel = this.bidList[index].userinfo.phone
          }else if(res.data.status == 0){
              window.location.href = res.data.msg
          }
        })
      },
      codeListRome(index){
        this.codeIdList.splice(index,index+1)
      },
      addCodeList(){
        let codeList = [];
        this.codeIdList.forEach(function (item,index,arr) {
          codeList.push(item.qrcode)
        })
        let data ={
          tender_order_id:this.bidList[this.bidIndex].tender_order_id,
          qrcode:codeList
        }
        bindCodeList(data).then(res =>{
            if(res.data.status == 0 && !res.data.uninsert){
              //this.codeData = this.codeData.concat(this.codeIdList)
              this.codeListShow(this.bidIndex)
              this.codeIdList = [];
              this.$Message.success('绑定成功！');
            }else if(res.data.status == 0 && res.data.uninsert && res.data.uninsert.length != 0){
              var desc = `二维码${res.data.uninsert.join("和")}已经被绑定,请谨慎操作！`
              this.$Notice.warning({
                title: '警告！',
                desc: desc
              });
              this.codeIdList = [];
            }else{
              this.$Notice.warning({
                title: '警告！',
                desc:"服务器报错，请联系开发人员"
              });
              this.codeIdList = [];
            }
        })
      },
      clearCodeIdList(){
        this.codeIdList = [];
      },
      bindCode(e) {
        if (e.keyCode == 13 && this.codeId) {
          var qrcode = this.codeId.split("=")[1]
          var codeObj = {};
          var codeArray = this.codeIdList;
          codeObj.qrcode = qrcode;
          codeArray = codeArray.filter(function (item, index, arr) {
            return item.qrcode == qrcode
          })
          if (codeArray.length == 0) {
            this.codeIdList.unshift(codeObj)
          }
          this.codeId = ""
        }

      },
      codeListShow(index) {
        this.codeListStatu = true;
        this.bidIndex = index;
        let data ={
          tender_order_id:this.bidList[index].tender_order_id
        }
        getCodeList(data).then(res =>{
            this.codeData = res.data.data
            this.allCodeNum = res.data.count
        })

      },
      emptyTips(tableIndex) {
        //为空提示
        let bidList = this.bidList.filter(function (item, index, array) {
          if (tableIndex == 1) {
            return item.tender_status == 1 && item.adoption_status == 0;
          } else if (tableIndex == 2) {
            return item.tender_status != 1 && item.adoption_status == 0
          } else if (tableIndex == 3) {
            return item.adoption_status == 1 && item.provider_status == 0
          } else if (tableIndex == 4) {
            return item.adoption_status == 1 && item.provider_status == 1
          }

        })

        return bidList.length
      },
      closeImgWarp(e) {
        if (e.target.className != 'img-warp-inner') return
        this.imgwarp = false
      },
      showImgWarp(index) {
        let bidOne = this.bidList[index]
        if (!bidOne.tree_imgs) {
          return
        }
        this.warpImgs = bidOne.tree_imgs
        this.imgwarp = true
      },
      becomeSupplier(index) {
        //成为供应商
        let bidOne = this.bidList[index]
        let data = {
          tender_order_id: bidOne.tender_order_id
        }
        changeProviderStatus(data).then(res => {
          this.bidList[index].provider_status = 1
        })

      },
      abandon(index) {
        //舍弃
        this.abandonValue = ''
        this.$Modal.confirm({
          title: '舍弃理由',
          render: (h) => {
            return h('Input', {
              props: {
                value: this.abandonValue,
                autofocus: 'autofocus',
                placeholder: '请输入舍弃理由!'
              },
              on: {
                input: (val) => {
                  this.abandonValue = val
                }
              }
            })
          },
          onOk: () => {
            if (this.abandonValue == '') {
              this.$Message.warning({
                content: '请填写舍弃理由！'
              })
            } else {
              this.changeStatus(index, false)
            }
          }
        })
        //解决框架自行获取焦点Bug
        setTimeout(function () {
          document.getElementsByClassName('ivu-input')[0].focus()
        }, 100)

      },
      recommend(index) {
        //推荐
        this.$Modal.confirm({
          title: '推荐',
          content: '确定推荐本条投标吗？',
          'ok-text': '推荐',
          onOk: () => {
            this.changeStatus(index, true)
          }

        })
      },
      changeListOne() {
        let bidList = this.bidList
        this.$emit("changeListOne", this.params.index, this.bidList);
      },
      changeStatus(tenderIndex, is) {
        let bidOne = this.bidList[tenderIndex]
        let data = {
          tender_order_id: bidOne.tender_order_id,
          status: is ? 2 : 3,
          remark: is ? '' : this.abandonValue
        }
        changeBidStatus(data).then(res => {
          if (res.data.status == 0) {
            this.$Message.success({
              content: '操作成功',
            })
            this.$set(this.bidList[tenderIndex], "tender_status", is ? 2 : 3)
          } else {
            this.$Message.warning({
              content: '服务器繁忙'
            })
          }
        })
      }
    },
    mounted() {
      this.bidList = this.params.row.tender_info;
      this.changeListOne()
    },
    directives: {
      focus: {
        // 指令的定义
        inserted: function (el) {
          el.focus()
        }
      }
    }

  }
</script>


