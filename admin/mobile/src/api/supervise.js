import axios from '@/libs/api.request'
import { getAxiosData } from '@/libs/util'

export const getDragList = () => {
    return axios.request({
        url: 'get_drag_list',
        method: 'get'
    })
}
export const getProjectList = (res) => {
    let data = getAxiosData(res);
    return axios.request({
        url: 'admin/supervise/project_list.php',
        data : data,
        method: 'post'
    })
}
export const getContractList = (res) => {
    let data = getAxiosData(res);
    return axios.request({
        url: 'admin/supervise/project_info.php',
        data : data,
        method: 'post'
    })
}

export const getTreeSupervise = (res) => {
    let data = getAxiosData(res);
    return axios.request({
        url: 'admin/supervise/tree_list.php',
        data : data,
        method: 'post'
    })
}
export const getTreeSuperviseInfo = (res) => {
    let data = getAxiosData(res);
    return axios.request({
        url: 'admin/supervise/maps_record_list.php',
        data : data,
        method: 'post'
    })
}
//二次邦码信息拉取
export const getTwoCodeInfo = (res) => {
    let data = getAxiosData(res);
    return axios.request({
        url: 'admin/supervise/search_my_maps.php',
        method: 'post',
        data:data
    })
}
//二次邦码信息提交
export const postTreeInfo = (res) => {
    let data = getAxiosData(res);
    return axios.request({
        url: 'admin/supervise/update_tree_maps.php',
        method: 'post',
        data : data,
    })
}
//监管状态拉取
export const getSuperviseStatus = (res) => {
    let data = getAxiosData(res);
    return axios.request({
        url: 'admin/supervise/check_maps_order.php',
        method: 'post',
        data : data,
    })
}
//上传监管详情
export const postSuperviseInfo = (res) => {
    let data = getAxiosData(res);
    return axios.request({
        url: 'admin/supervise/maps_record_insert.php',
        method: 'post',
        data : data,
    })
}
//监管图片上传
export const postSuperviseImg = (res) => {
    return axios.request({
        url: 'admin/supervise/maps_uploads.php',
        method: 'post',
        data : res,
    })
}
//验收异常信息发送
export const postSuperviseUnusual = (res) => {
    let data = getAxiosData(res);
    return axios.request({
        url: 'admin/supervise/update_record_state.php',
        method: 'post',
        data : data,
    })
}
//绑定手机号, 更改手机号
export const bindPhone = (res) => {
    let data = getAxiosData(res);
    return axios.request({
        url: 'admin/supervise/binding_phone.php',
        method: 'post',
        data : data,
    })
}
