import axios from '@/libs/api.request'
import { getAxiosData } from '@/libs/util'

export const getConfig = (res) => {
    return axios.request({
        url: '/com/wechat.jssdk.php',
        method: 'get',
        params:res
    })
}
export const getBidList = (res) => {
    let data = getAxiosData(res);
    return axios.request({
        url: 'Calculation.php',
        data : data,
        method: 'post'
    })
}
