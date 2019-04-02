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
    <div class="search-store-name">
        <Input v-model="store_name" placeholder="请输入主店名称" style="width:200px" />
      <Input v-model="store_tel" placeholder="请输入手机号" style="width: 200px; margin-left: 50px"/>
      <Button type="primary" style="margin-left: 40px">点我搜索</Button>
    </div>
    <div class="bid-info">
      <Table :columns="columns" :data="shopList" :class="isflex?'flextree_list':''"></Table>
    </div>
  </div>
</template>

<script>
  import {getBidInfo} from '@/api/data'
  import {geTmangement} from '@/api/management'
  import {getRemoveagsNav} from '@/libs/util'
  import {mapMutations} from 'vuex'
  import expandRow from './store-extend'
  export default {
    components: {expandRow},
    data () {
      return {
        shopList:[],
          store_name:[],
          store_tel:[],
        columns: [
          {
            type: 'expand',
            width: 50,
            render: (h, params) => {
              console.log(params)
              return h(expandRow, {
                props: {
                  params: params
                }
              })
            }
          },
          {
            title: '店铺名称',
            key: 'hcity'
          },
          {
            title: '联系电话',
            key:"Up_time"
          }
        ],
        treeList: [{
          name:"jiagongsi",
          tel:"15532322727"
        },{
          name:"jiagongsi",
          tel:"15532322727"
        },{
          name:"jiagongsi",
          tel:"15532322727"
        },{
          name:"jiagongsi",
          tel:"15532322727"
        }],
        isflex: false,
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

      getFirstAjax(){
        let prames ={
          a : 1,
          p: 2
        }
        getBidInfo(prames).then(res=>{

            console.log(res.data)
            let shopList = res.data.data;
            this.shopList = shopList

        })
      },
          getStoreList(){
          let prames ={
              shop_name: this.store_name,
              shop_phone:this.store_tel,
          }
              geTmangement(prames).then(res=>{
                  console.log(res);
                  let  storeList = res .data.data;
                  this.storeList = storeList
              })
        }
    },
    created(){
      this.getFirstAjax()
        this.getStoreList()
    },
    mounted () {

      document.getElementsByClassName('content-wrapper')[0].addEventListener('scroll', this.handleScroll)
    },
    beforeDestroy () {
      document.getElementsByClassName('content-wrapper')[0].removeEventListener('scroll', this.handleScroll)
    }
  }
</script>
