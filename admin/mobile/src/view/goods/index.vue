<template>
    <div>
        goods
    </div>
</template>

<script>
    import {getBidList} from "../../api/data"
    export default {
        data() {
            return {
                goods: {
                    title: '美国伽力果（约680g/3个）',
                    price: 2680,
                    express: '免运费',
                    remain: 19,
                    thumb: [
                        'https://img.yzcdn.cn/public_files/2017/10/24/e5a5a02309a41f9f5def56684808d9ae.jpeg',
                        'https://img.yzcdn.cn/public_files/2017/10/24/1791ba14088f9c2be8c610d0a6cc0f93.jpeg'
                    ]
                }
            };
        },
        created(){
            console.log(getBidList)
            getBidList({a:1}).then(function (res) {

            })

        },
        methods: {
            formatPrice() {
                return '¥' + (this.goods.price / 100).toFixed(2);
            },

            onClickCart() {
                this.$router.push('cart');
            },

            sorry() {
                Toast('暂无后续逻辑~');
            }
        }
    };
</script>

<style lang="less">
    .goods {
        padding-bottom: 50px;

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
