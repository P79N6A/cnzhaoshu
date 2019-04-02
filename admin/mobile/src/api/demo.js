import axios from '@/libs/api.request'
import { getAxiosData } from '@/libs/util'

export const getDragList = (res) => {
    return axios.request({
        url: 'get_drag_list',
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
