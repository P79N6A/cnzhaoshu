import axios from '@/libs/api.request'
import {getAxiosData} from '@/libs/util'

export const getDragList = () => {
    return axios.request({
        url: 'get_drag_list',
        method: 'get'
    })
}
export const getBidList = (res) => {
    let data = getAxiosData(res);
    return axios.request({
        url: 'Calculation.php',
        data: data,
        method: 'post'
    })
}


