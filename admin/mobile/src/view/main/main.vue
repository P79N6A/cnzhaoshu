<template>
    <div>
        <router-view></router-view>
        <van-tabbar v-if="false">
            <van-tabbar-item icon="shop">标签</van-tabbar-item>
            <van-tabbar-item icon="chat" dot>标签</van-tabbar-item>
            <van-tabbar-item icon="records" info="5">标签</van-tabbar-item>
            <van-tabbar-item icon="gold-coin" info="20">标签</van-tabbar-item>
        </van-tabbar>
    </div>
</template>
<script>
    export default {
        data() {
            return {

            };
        },
        created(){


        },
        methods: {

        }
    };
</script>

<style lang="less">
    .goods {
        &-swipe {
            img {
                width: 100%;
                display: block;
            }
        }

        &-title {
            font-size: 16px;
        }

        &-price {
            color: #f44;
        }

        &-express {
            color: #999;
            font-size: 12px;
            padding: 5px 15px;
        }

        &-cell-group {
            margin: 15px 0;

            .van-cell__value {
                color: #999;
            }
        }

        &-tag {
            margin-left: 5px;
        }
    }
</style>
