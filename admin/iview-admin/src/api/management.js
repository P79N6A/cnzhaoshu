import axios from '@/libs/api.request'
import { getAxiosData } from '@/libs/util'
export const  getStoreList= (res) => {
    let data = getAxiosData(res);
    return axios.request({
        url: 'store_management/store_management.php',
        data : data,
        method: 'post'
    })
}
export const  getStoreBindList= (res) => {
  let data = getAxiosData(res);
  return axios.request({
    url: 'store_management/store_manage_info.php',
    data : data,
    method: 'post'
  })
}
export const  removeStore= (res) => {
  let data = getAxiosData(res);
  return axios.request({
    url: 'store_management/store_relievejoined.php',
    data : data,
    method: 'post'
  })
}

