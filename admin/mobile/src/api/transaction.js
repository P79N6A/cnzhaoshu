import axios from '@/libs/api.request'
import { getAxiosData } from '@/libs/util'

export const getDragList = () => {
    return axios.request({
        url: 'get_drag_list',
        method: 'get'
    })
}
//推送配置
export const getMsg = (res) => {
    return axios.request({
        url: '/com/get_msg.php',
        method: 'get',
        params:res
    })
}
//获取投标列表
export const getBidList = (res) => {
    let data = getAxiosData(res);
    return axios.request({
        url: 'admin/bidding_list.php',
        data : data,
        method: 'post'
    })
}
//获取苗圃信息
export const getNurseryName= (res) => {
    let data = getAxiosData(res);
    return axios.request({
        url: 'admin/nursery_name.php',
        data : data,
        method: 'post'
    })
}
//获取投标项相关的苗圃信息
export const getBidNurseryInfo= (res) => {
    let data = getAxiosData(res);
    return axios.request({
        url: 'admin/tree_info.php',
        data : data,
        method: 'post'
    })
}
//投标图片上传
export const postBidImg = (res) => {
    return axios.request({
        url: 'admin/bidpicture_upload.php',
        method: 'post',
        data : res,
    })
}
//投标图片上传
export const subBidInfo = (res) => {
    let data = getAxiosData(res);
    return axios.request({
        url: 'admin/tender_order.php',
        method: 'post',
        data : data,
    })
}
