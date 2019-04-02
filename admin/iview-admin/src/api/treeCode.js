import axios from '@/libs/api.request'
import { getAxiosData } from '@/libs/util'
export const bindCodeList = (res) => {
  let data = getAxiosData(res);
  return axios.request({
    url: 'supervise/insert_tree_maps.php',
    data : data,
    method: 'post'
  })
}
export const getCodeList = (res) => {
  let data = getAxiosData(res);
  return axios.request({
    url: 'supervise/codeList.php',
    data : data,
    method: 'post'
  })
}
