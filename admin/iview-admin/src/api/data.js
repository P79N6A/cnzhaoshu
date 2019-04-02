import axios from '@/libs/api.request'
import { getAxiosData } from '@/libs/util'
export const getTableData = () => {
  return axios.request({
    url: 'bidList',
    method: 'get'
  })
}

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
    data : data,
    method: 'post'
  })
}
export const contractList = (res) => {
  let data = getAxiosData(res);
  return axios.request({
    url: 'contract_list.php',
    data : data,
    method: 'post'
  })
}
export const getBidInfo = (res) => {
  let data = getAxiosData(res);
  return axios.request({
    url: 'tree_operation.php',
    data : data,
    method: 'post'
  })
}
export const changeBidStatus = (res) => {
  let data = getAxiosData(res);
  return axios.request({
    url: 'update_tender_status.php',
    data : data,
    method: 'post'
  })
}
//修改成为供应商状态
export const changeProviderStatus = (res) => {
  let data = getAxiosData(res);
  return axios.request({
    url: 'supervise/providerUpdate.php',
    data : data,
    method: 'post'
  })
}
export const changeProjectStatus = (res) => {
  let data = getAxiosData(res);
  return axios.request({
    url: 'update_project_status.php',
    data : data,
    method: 'post'
  })
}
export const getContract_img_attr  = (res) => {
  let data = getAxiosData(res);
  return axios.request({
    url: 'contract_img_attr.php ',
    data : data,
    method: 'post'
  })
}
export const postContract_img  = (res) => {
  let data = getAxiosData(res);
  return axios.request({
    url: 'deposit_contract_imgs.php',
    data : data,
    method: 'post'
  })
}
export const getContract_img  = (res) => {
  let data = getAxiosData(res);
  return axios.request({
    url: 'atlas_list.php',
    data : data,
    method: 'post'
  })
}
export const tuiSongContract_img  = (res) => {
  let data = getAxiosData(res);
  return axios.request({
    url: 'send_img_url.php',
    data : data,
    method: 'post'
  })
}
export const getContract  = (res) => {
  let data = getAxiosData(res);
  return axios.request({
    url: 'supervise/checkoutCompany.php',
    data : data,
    method: 'post'
  })
}
export const sendContractInfo  = (res) => {
  let data = getAxiosData(res);
  return axios.request({
    url: 'supervise/contract_info.php',
    data : data,
    method: 'post'
  })
}
