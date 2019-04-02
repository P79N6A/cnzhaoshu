<template>
  <div>
    <div style="padding-bottom: 10px">
      <div>
        <Input v-model="partya_company_name" placeholder="甲方" clearable style="width: 170px;margin-right: 10px"/>
        <Input v-model="project_name" placeholder="项目" clearable style="width: 170px;margin-right: 10px"/>
        <Input v-model="tel" placeholder="手机" clearable style="width: 170px;margin-right: 10px"/>
        <Button @click="getList(true)" style="margin-left: 20px" type="primary">
          <Icon type="search"/>
          搜索
        </Button>
      </div>
    </div>
    <Table border :columns="columns" :data="bidList" @on-row-click="linkInfo"
           :class="isflex?'flextree_list':''"></Table>
    <div style="padding: 20px 0;text-align: center;background: #fff">
      <Page :total="totol_num" :page-size="20" :current="p" @on-change="changePage" show-elevator/>
    </div>

  </div>
</template>
<script>
  import {contractList} from '@/api/data'
  import {mapMutations} from 'vuex'
  export default {
    data () {
      return {
        isflex: false,
        partya_company_name: '',
        project_name: '',
        tel: '',
        totol_num: 1,
        columns: [
          {
            title: '序号',
            key: 'name',
            render: (h, params) => {
              return h('div', [
                h('Icon', {
                  props: {
                    type: 'person'
                  }
                }),
                h('strong', params.index + 1)
              ])
            }
          },
          {
            title: '合同号',
            key: 'order_num',
            render: (h, params) => {
              return h('div', [
                h('Icon', {
                  props: {
                    type: 'person'
                  }
                }),
                h('strong', params.row.order_num)
              ])
            }
          },
          {
            title: '项目名称',
            key: 'name',
            render: (h, params) => {
              return h('div', [
                h('Icon', {
                  props: {
                    type: 'person'
                  }
                }),
                h('strong', params.row.project_name)
              ])
            }
          },
          {
            title: '甲方',
            key: 'jindu',
            render: (h, params) => {
              return h('div', [
                h('Icon', {
                  props: {
                    type: 'person'
                  }
                }),
                h('strong', params.row.partya_info.company_name)
              ])
            }
          },
          {
            title: '联系人',
            key: 'shijian',
            render: (h, params) => {
              return h('div', [
                h('Icon', {
                  props: {
                    type: 'person'
                  }
                }),
                h('strong',params.row.partya_info.contacts)
              ])
            }
          },
          {
            title: '联系电话',
            key: 'address',
            render: (h, params) => {
              return h('div', [
                h('Icon', {
                  props: {
                    type: 'person'
                  }
                }),
                h('strong',params.row.partya_info.tel)
              ])
            }
          },
          {
            title: '乙方',
            key: 'partya',
            render: (h, params) => {
              return h('div', [
                h('Icon', {
                  props: {
                    type: 'person'
                  }
                }),
                h('strong', params.row.partyb_info.company_name)
              ])
            }
          },
          {
            title: '联系人',
            key: 'lianxi',
            render: (h, params) => {
              return h('div', [
                h('Icon', {
                  props: {
                    type: 'person'
                  }
                }),
                h('strong',  params.row.partyb_info.contacts)
              ])
            }
          },
          {
            title: '联系电话',
            key: 'tel',
            render: (h, params) => {
              return h('div', [
                h('Icon', {
                  props: {
                    type: 'person'
                  }
                }),
                h('strong', params.row.partyb_info.tel)
              ])
            }
          },
          {
            title: '操作',
            key: 'action',
            width: 150,
            align: 'center',
            render: (h, params) => {

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
                      this.goto(params.index)
                    }
                  }
                }, '上传'),
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
                      window.open("/admin"+params.row.contract_path.substring(1))
                    }
                  }
                }, '下载')
              ])
            }
          }
        ],
        bidList: [],
        p: 1
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
      goto(index){
        this.$router.push({
          name: 'contractImg',
          params: {
            projectInfo: this.bidList[index]
          }
        })
      },
      linkInfo (row, index) {
        //合同详情待开发
       /* this.$router.push({
          name: 'contractImg',
          params: {
            projectInfo: row
          }
        })*/
      },
      getList (first) {
        if (first) {

          this.p = 1
        }
        let res = {
          p: this.p,
          partya_company_name: this.partya_company_name,
          project_name: this.project_name,
          tel: this.tel,
        }
        this.$Message.loading({
          content: '加载中',
          duration: 0
        })
        contractList(res).then(res => {

          this.$Message.destroy()
          this.bidList = res.data.data
          this.totol_num = res.data.totol_num
        })
      },
      changePage (p) {
        this.p = p
        this.getList()
      },
      handleScroll (e) {
        var scrollTop = e.target.scrollTop
        var topHeight = document.getElementsByClassName('ivu-table-wrapper')[0].offsetTop - 64
        if (scrollTop > topHeight) {
          this.isflex = true
        } else {
          this.isflex = false
        }
      },

    },
    created(){
    },
    mounted () {
      this.getList(true)
      document.getElementsByClassName('content-wrapper')[0].addEventListener('scroll', this.handleScroll)
    },
    beforeDestroy () {
      document.getElementsByClassName('content-wrapper')[0].removeEventListener('scroll', this.handleScroll)
    }
  }
</script>
