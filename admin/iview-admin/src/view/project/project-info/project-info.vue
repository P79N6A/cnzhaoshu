<style scoped>
  .bid-info span {
    margin-right: 30px;
  }

  .bid-info div:last-of-type {
    margin-top: 10px;
  }
</style>
<template>
  <div>
    <div class="bid-info" style="position: relative">
      <Card>
        <div>
          <td><span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">订单编号：{{projectInfo.project_info.order_num}}</span>
          </td>
          <td><span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">项目名称：{{projectInfo.project_info.project_name}}</span></td>
          <td><span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">甲方：{{projectInfo.company_info.company_name}}</span></td>
          <td><span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">用苗地：{{projectInfo.project_info.hcity+projectInfo.project_info.hproper}}</span></td>
        </div>
        <div>
          <td><span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">招标进度：{{projectInfo.project_info.project_progress+"%"}}</span></td>
          <td><span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">剩余时间：{{projectInfo.project_info.Up_time | remainingTime}}</span></td>
          <td><span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">联系人：{{projectInfo.company_info.contacts}}</span></td>
          <td><span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">联系电话：{{projectInfo.company_info.tel}}</span></td>
          <td><span style="font-size: 14px; font-weight: bold; color: rgb(70, 76, 91);">待审核：{{projectInfo.project_info.audits_num}}</span></td>
        </div>
      </Card>
      <div style="position: absolute;right: 10px;top: 10px">
        <Button type="info" @click="getInfo">
          刷新
        </Button>
      </div>
      <Table :columns="columns" :data="treeList" :class="isflex?'flextree_list':''"></Table>
    </div>
  </div>
</template>
<script>
  import {getBidInfo} from '@/api/data'
  import {getRemoveagsNav} from '@/libs/util'
  import {mapMutations} from 'vuex'
  import expandRow from './project-info-extend'
  export default {
    components: {expandRow},
    data () {
      return {
        columns: [
          {
            type: 'expand',
            width: 50,
            render: (h, params) => {
              return h(expandRow, {
                props: {
                  params: params
                },
                on: {
                  changeListOne:this.changeListOne
                },
              })
            }
          },
          {
            title: '苗木',
            key: 'tree_name'
          },
          {
            title: '规格',
            render: (h, params) => {
              let str = ''
              let dbh = params.row.dbh ? `胸径:${params.row.dbh}cm` : ''
              let plant_height = params.row.plant_height ? `株高:${params.row.plant_height}cm` : ''
              let crown = params.row.crown ? `冠幅:${params.row.crown}cm` : ''
              let ground_diameter = params.row.ground_diameter ? `地径:${params.row.ground_diameter}cm` : ''
              str = dbh + plant_height + crown + ground_diameter
              return h('div', [
                h('Icon', {
                  props: {
                    type: 'person'
                  }
                }),
                h('strong', str)
              ])
            }
          },
          {
            title: '备注',
            key: 'remarks'
          },
          {
            title: '数量',
            key: 'tree_num'
          },
          {
            title: '招标进度',
            key: 'percent'
          },
          {
            title: '已审核',
            key: 'totol_order',
            render: (h, params) => {
              return h('div', [
                h('Icon', {
                  props: {
                    type: 'person'
                  }
                }),
                h('strong', params.row.tree_oked_audits)
              ])
            }
          },
          {
            title: '待审核',
            key: 'tree_un_audits'
          }
        ],
        treeList: [],
        isflex: false,
        projectInfo:{}
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
      changeListOne(treeIndex,tender_info){
        //接受子组件关于tender_info的状态改变刷新
          console.log(treeIndex, tender_info,"sadsadasdas")
        //todo  子组件状态传值改变
        /*this.$set(this.treeList[treeIndex].tender_info[tenderIndex],"tender_status",status);*/
      },
      getInfo () {
        this.$Message.loading({
          content: '加载中',
          duration: 0
        })
        let res = {project_id: this.projectInfo.project_info.project_id}
        getBidInfo(res).then(res => {
          this.$Message.destroy()
          this.treeList = res.data.data
        })
      },
      extendRow (row, index) {
        //点击不刷新数据
        //this.$set(this.treeList[index], '_expanded', !this.treeList[index]._expanded)
      },
      handleScroll (e) {
        //todo
        var scrollTop = e.target.scrollTop
        var topHeight = document.getElementsByClassName('ivu-table-wrapper')[0].offsetTop - 64
        if (scrollTop > topHeight) {
          this.isflex = true
        } else {
          this.isflex = false
        }
      }
    },
    created(){
      this.projectInfo = this.$route.params.projectInfo;
      if(!this.projectInfo){
        this.$router.go(-1)
      }
    },
    mounted () {
      this.getInfo()
      document.getElementsByClassName('content-wrapper')[0].addEventListener('scroll', this.handleScroll)
    },
    beforeDestroy () {
      document.getElementsByClassName('content-wrapper')[0].removeEventListener('scroll', this.handleScroll)
    }
  }
</script>
