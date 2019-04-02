<template>
  <div>
    <div>
      <Card v-if="projectInfo">
        <div>
          <td><span
            style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">项目：{{projectInfo.project_name}}</span>
          </td>
          <td><span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">甲方：{{projectInfo.partya_info.company_name}}</span>
          </td>
          <td><span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">联系人：{{projectInfo.partya_info.contacts}}</span>
          </td>
          <td><span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">电话：{{projectInfo.partya_info.tel}}</span>
          </td>
          <td><span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">用苗地：{{projectInfo.hcity+projectInfo.hproper}}</span>
          </td>
        </div>
        <div>
          <td><span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">乙方：{{projectInfo.partyb_info.company_name}}</span>
          </td>
          <td><span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">联系人：{{projectInfo.partyb_info.contacts}}</span>
          </td>
          <td><span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">电话：{{projectInfo.partyb_info.tel}}</span>
          </td>
          <td><span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">项目时间：{{projectInfo.project_time}}</span>
          </td>
        </div>
      </Card>
      <Card style="width: 600px">
        <div>
          <div>
            <div>
              <div class="demo-upload-list" v-for="(item,index) in uploadList">
                <template>
                  <img :src="'/admin/'+item">
                  <div class="demo-upload-list-cover">
                    <Icon type="ios-eye-outline" @click.native="handleView(item)"></Icon>
                    <Icon type="ios-trash-outline" @click.native="handleRemove(index)"></Icon>
                  </div>
                </template>
              </div>
              <Upload
                v-show="uploadList.length !=1"
                ref="upload"
                :show-upload-list="false"
                :on-success="handleSuccess"
                :format="['jpg','jpeg','png']"
                multiple
                type="drag"
                action="/admin/contract_images_upload.php"
                style="display: inline-block;width:58px;">
                <div style="width: 58px;height:58px;line-height: 58px;">
                  <Icon type="ios-camera" size="20"></Icon>
                </div>
              </Upload>
              <Row style="padding: 15px 0">
                <Col span="8">
                  <Dropdown style="width: 300px;" @on-click="clickSelect">
                    <Button type="primary">
                      {{subdata.contract_attr ? subdata.contract_attr:"选择类型"}}
                      <Icon type="ios-arrow-down"></Icon>
                    </Button>
                    <DropdownMenu slot="list">
                      <DropdownItem v-for="(item ,index) in contract_attr" :name="index">{{item}}</DropdownItem>
                    </DropdownMenu>
                  </Dropdown>
                </Col>
                <Col span="16">
                  <Input v-model="subdata.remark" type="textarea" :rows="1" placeholder="图片备注"/>
                </Col>
              </Row>
              <Modal title="图片预览" v-model="visible">
                <img :src="imgName" v-if="visible" style="width: 100%">
              </Modal>
            </div>
          </div>
          <Button type="success" long @click="subimgwarpshow">上传</Button>
        </div>
      </Card>
      <Card style="width: 600px">
        <div>
          <Card v-for="(one , index) in imgList">
            <Row type="flex" justify="center" align="middle" class="code-row-bg">
              <Col span="4"><p v-text="one.img_kind"></p></Col>
              <Col span="8"><img @click="handleView(one.imgs)" style="border-radius: 5px" class="contract-img" :src="'/admin/'+one.imgs" alt=""></Col>
              <Col span="8"><p v-text="one.remark"></p></Col>
              <Col span="4" style="text-align: right"><Button type="primary" @click="tuisong(index)">推送</Button></Col>
            </Row>
          </Card>
        </div>
      </Card>
    </div>
  </div>
</template>
<script>
  import {getContract_img_attr, postContract_img,getContract_img,tuiSongContract_img} from '@/api/data'
  import {getRemoveagsNav} from '@/libs/util'
  import {mapMutations} from 'vuex'
  import expandRow from './project-info-extend'

  export default {
    components: {expandRow},
    data() {
      return {
        projectInfo: {
          project_id:""
        },
        uploadList: [],
        imgName: '',
        visible: false,
        img_remark: "",
        contract_attr: {},
        subdata: {},
        imgList:[]
      }
    },
    methods: {
      ...mapMutations([
        'setBreadCrumb',
        'setTagNavList',
        'addTag',
        'setLocal',
        'removeTag',
      ]),
      tuisong(index){
        let data = this.imgList[index];
        tuiSongContract_img(data).then(res => {
          console.log(res)
        })
      },
      clickSelect(name) {
        this.$set(this.subdata, "contract_attr", this.contract_attr[name])
        this.$set(this.subdata, "contract_index", name)
      },
      handleRemove(index) {
        let uploadList = this.uploadList;
        uploadList.splice(index, 1);
        this.uploadList = uploadList;
      },
      handleView(name) {
        this.imgName = '/admin/' + name;
        this.visible = true;
      },
      handleSuccess(res, file) {
        console.log(res, file)
        this.uploadList.push(res.data)
      },
      subimgwarpshow() {
        let data = {}
        var that = this;
        console.log(this.uploadList.length ,this.subdata.contract_index)
        if (this.uploadList.length == 0) {
          this.$Message.warning('请上传图片')
          return
        }
        data.imgs = this.uploadList;
        if (!this.subdata.contract_attr) {
          this.$Message.warning('请选择类型')
          return
        }
        data.img_kind  = this.subdata.contract_attr;
        data.project_id = this.projectInfo.project_id;
        data.remark = this.subdata.remark;
        postContract_img(data).then(res => {
          console.log(res.data)
          if(res.data.status == 0){
            this.$Message.success('上传成功');
            this.subdata = {};
            this.uploadList = [];
            data.contract_imgs_id = res.data.contract_imgs;
            console.log(that.imgList+"sssss")
            if(!that.imgList){
               let arr = [];
               arr.push(data)
               that.imgList = arr
            }else {
              that.imgList.push(data)
            }


          }
        })


      },
      getImgList(){
        getContract_img({project_id:this.projectInfo.project_id}).then(res =>{
          this.imgList = res.data.data
          console.log(this.imgList)
        })
        getContract_img_attr({}).then(res => {
          this.contract_attr = res.data
        })
      }
    },
    beforeCreate(){
      if(!this.$route.params.projectInfo){
        this.$router.push({
          name: 'contractList'
        })
      }
    },
    created() {
      this.projectInfo = this.$route.params.projectInfo
    },
    mounted() {
      this.getImgList()
    },
    beforeDestroy() {

    }
  }
</script>
<style>
  .demo-upload-list {
    display: inline-block;
    width: 60px;
    height: 60px;
    text-align: center;
    line-height: 60px;
    border: 1px solid transparent;
    border-radius: 4px;
    overflow: hidden;
    background: #fff;
    position: relative;
    box-shadow: 0 1px 1px rgba(0, 0, 0, .2);
    margin-right: 4px;
  }

  .demo-upload-list img {
    width: 100%;
    height: 100%;
  }

  .demo-upload-list-cover {
    display: none;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, .6);
  }

  .demo-upload-list:hover .demo-upload-list-cover {
    display: block;
  }

  .demo-upload-list-cover i {
    color: #fff;
    font-size: 20px;
    cursor: pointer;
    margin: 0 2px;
  }
  .contract-img{
    display: block;
    width: 100px;
  }
</style>
