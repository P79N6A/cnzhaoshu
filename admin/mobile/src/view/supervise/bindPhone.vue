<template>
    <div>

    </div>
</template>

<script>
    import {bindPhone} from "../../api/supervise"
    export default {
        data() {
            return {
                type:1
            };
        },
        created(){
            this.phone = this.$route.params.phone
            let that = this;
            let data = {
                phone:this.phone,
                type:this.type
            }
            this.Toast.loading({
                mask: true,
                message: '手机号绑定中...'
            });
            bindPhone(data).then(res =>{
                this.Toast.clear()
                if (res.data.status == 0){
                    this.Dialog.alert({
                        message: '绑定成功！'
                    }).then(() => {
                        that.$router.push({
                            name:"superviseList"
                        })
                    });
                }else {
                    this.Dialog.confirm({
                        title: '更换手机号',
                        message: res.data.phone+'修改成'+this.phone+"吗？"
                    }).then(() => {
                        let data2 = {
                            phone:this.phone,
                            type:2
                        }
                        this.Toast.loading({
                            mask: true,
                            message: '手机号更换中...'
                        });
                        bindPhone(data2).then(res =>{
                            that.Toast.clear()
                            if (res.data.status == 0){
                                that.Dialog.alert({
                                    message: this.phone+'更换手机号成功！'
                                }).then(() => {
                                    that.$router.push({
                                        name:"superviseList"
                                    })
                                });
                            }else {
                                that.Notify({
                                    message: res.data.msg,
                                    duration: 1000,
                                    background: '#BA4E4E'
                                });
                            }
                        }).catch(()=>{
                            that.Toast.clear()
                        })
                        // on confirm
                    }).catch(() => {
                        // on cancel
                    });
                }
            }).catch(()=>{
                this.Toast.clear()
            })

        },
        methods: {

        }
    };
</script>

<style lang="less">

</style>
