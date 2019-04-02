import 'amfe-flexible';
import Vue from 'vue';
import App from './App';
import router from './router/index';
import {wxConfig,wxGetLocation} from './libs/wxConfig/index'
Vue.prototype.wxConfig = wxConfig;
wxConfig();
Vue.prototype.wxGetLocation = wxGetLocation;
import config from '@/config';
import { Tabbar, TabbarItem ,Field ,Icon, Tab, Tabs,List,Toast,Row, Col,Notify,ImagePreview,Uploader,Dialog,Popup,Area } from 'vant';
Vue.use(Tabbar).use(TabbarItem).use(Field).use(Icon).use(Tab).use(Tabs).use(List).use(Toast);
Vue.use(Toast).use(Row).use(Col).use(Notify).use(ImagePreview).use(Uploader).use(Dialog).use(Popup).use(Area)
Vue.prototype.$config = config;
Vue.prototype.Toast = Toast;
Vue.prototype.ImagePreview = ImagePreview;
Vue.prototype.Dialog = Dialog;
Vue.prototype.Notify = Notify;


new Vue({
    router,
    el: '#app',
    render: h => h(App)
});
