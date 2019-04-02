import wx from 'weixin-js-sdk'
import {getConfig} from '@/api/wxApi'

export const wxConfig = (config) => {
    var data = {
        url: window.location.href.split("#")[0]
    }
    function getTitle() {
        return config ? config.title : "找树网"
    }

    function getImageUrl() {
        return config ? config.imgUrl : 'http://cnzhaoshu.com/img/hall.jpg'
    }

    function getLink() {
        return config ? config.link : window.location.href
    }

    function getDescription() {
        return config ? config.description : "精准投标，快捷交易，只在找树网"
    }

    function desconfig() {
        // 在这里调用 API
        wx.onMenuShareAppMessage({
            title: getTitle(),
            desc: getDescription(),
            link: getLink(),
            imgUrl: getImageUrl()
        });

        wx.onMenuShareTimeline({
            title: getTitle() + "\n" + getDescription(),
            link: getLink(),
            imgUrl: getImageUrl()
        });

        wx.onMenuShareQQ({
            title: getTitle(),
            desc: getDescription(),
            link: getLink(),
            imgUrl: getImageUrl()
        });

        wx.onMenuShareWeibo({
            title: getTitle(),
            desc: getDescription(),
            link: getLink(),
            imgUrl: getImageUrl()
        });
    }

    getConfig(data).then(res => {
        setTimeout(function () {
            wx.config({
                debug: false,
                appId: res.data.appId,
                timestamp: res.data.timestamp,
                nonceStr: res.data.nonceStr,
                signature: res.data.signature,
                jsApiList: [
                    'onMenuShareTimeline',
                    'onMenuShareAppMessage',
                    'onMenuShareQQ',
                    'onMenuShareQZone',
                    'onMenuShareWeibo',
                    'hideMenuItems'
                ]
            });
            wx.ready(() =>{
                desconfig()
            });
        },500)
    })
}
export const wxGetLocation = () => {
    if(process.env.NODE_ENV !== 'production'){
        return new Promise(function (resolve, reject) {
            resolve({})
            reject({})
        })
    }
    return new Promise(function (resolve, reject ) {
        var data = {
            url: window.location.href.split("#")[0]
        }
        getConfig(data).then(res => {
            wx.config({
                debug: false,
                appId: res.data.appId,
                timestamp: res.data.timestamp,
                nonceStr: res.data.nonceStr,
                signature: res.data.signature,
                jsApiList: [
                    'onMenuShareTimeline',
                    'onMenuShareAppMessage',
                    'onMenuShareQQ',
                    'onMenuShareQZone',
                    'onMenuShareWeibo',
                    'hideMenuItems',
                    'getLocation'
                ]
            });


            wx.getLocation({
                "type": 'wgs84',
                "success": function (res) {
                    resolve(res);
                    reject(res)
                }
            })

            wx.ready(function () {
                wx.hideMenuItems({
                    menuList: ['menuItem:copyUrl'] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
                });
            });
        })
    })
    /*if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((res)=>{
            console.log(res.latitude)
            alert(res.latitude)
        }, ()=>{});
    }*/

}
