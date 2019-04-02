<template>
  <div>
    <div style="padding-bottom: 10px">
      <div>
        <Input v-model="company_name" placeholder="甲方" clearable style="width: 170px;margin-right: 10px" />
        <Input v-model="projext_name" placeholder="项目" clearable style="width: 170px;margin-right: 10px" />
        <Input v-model="company_tel" placeholder="手机" clearable style="width: 170px;margin-right: 10px" />
        <Button @click="getList(true)"style="margin-left: 20px" type="primary"><Icon type="search"/>搜索</Button>
        <div style="float: right;padding-right: 20px">
          <Select v-model="bid_status" @on-change="getList(true)" style="width:100px">
            <Option :value="1" >招标中</Option>
            <Option :value="2" >招标结束</Option>
          </Select>
          <Select v-model="screen_status" @on-change="getList(true)" style="width:100px;margin-left: 20px">
            <Option :value="1" >待审核</Option>
            <Option :value="2" >已审核</Option>
          </Select>
        </div>

      </div>
    </div>
    <Table border :columns="columns" :data="bidList"></Table>
    <div style="padding: 20px 0;text-align: center;background: #fff">
      <Page :total="100" :page-size="20" :current="p" @on-change="changePage" show-elevator />
    </div>

  </div>
</template>
<script>
  import { getBidList ,getTableData} from '@/api/data'
  import { login} from '@/api/user'
  export default {
    data () {
      return {
        bid_status:1,
        screen_status:1,
        company_name:"",
        projext_name:"",
        company_tel:"",
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
                h('strong', params.index+1)
              ]);
            }
          },
          {
            title: '订单编号',
            key: 'order_num'
          },
          {
            title: '项目名称',
            key: 'name'
          },
          {
            title: '招标进度',
            key: 'jindu'
          },
          {
            title: '剩余时间',
            key: 'shijian'
          },
          {
            title: '用苗地',
            key: 'address'
          },
          {
            title: '甲方',
            key: 'partya'
          },
          {
            title: '联系人',
            key: 'lianxi'
          },
          {
            title: '联系电话',
            key: 'tel',
          },
          {
            title: '待审核数',
            key: 'daishenhe',
            sortable: true
          },
          {
            title: 'Action',
            key: 'action',
            width: 150,
            align: 'center',
            render: (h, params) => {
              if(params.row.status == 1){
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
                      click: () => {
                        this.show(params.index)
                      }
                    }
                  }, '启用')]);
              }else {
                return h('div', [
                  h('Button', {
                    props: {
                      type: 'error',
                      size: 'small'
                    },
                    on: {
                      click: () => {
                        this.remove(params.index)
                      }
                    }
                  }, '禁用')
                ]);
              }


            }
          }
        ],
        bidList: [],
        p:1
      }
    },
    methods: {
      show (index) {
        this.$Modal.info({
          title: 'User Info',
          content: `Name：${this.data6[index].name}<br>Age：${this.data6[index].age}<br>Address：${this.data6[index].address}`
        })
      },
      remove (index) {
        this.data6.splice(index, 1);
      },
      handleSearch(){

      },
      getList(first){
        if(first){
          this.p = 1;
        }
        let res = {
          p:this.p,

        }
        this.$Message.loading({
          content: '加载中',
          duration: 0
        });
        getBidList(res).then(res =>{
          this.$Message.destroy()
          this.bidList = res.data.data
        })
      },
      changePage(p){
        this.p = p;
        this.getList();
      }
    },
    mounted(){
      this.getList(true);
    }
  }
</script>
