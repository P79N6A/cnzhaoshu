import Vue from 'vue';
import Router from 'vue-router';
import Cookies from 'js-cookie'
import routes from './router'
Vue.use(Router);
// add route path
routes.forEach(route => {
    route.path = route.path || '/' + (route.name || '');
});

const router = new Router({ routes });

router.beforeEach((to, from, next) => {
    const title = to.meta && to.meta.title;
    if (title) {
        document.title = title;
    }
    if(!Cookies.get("user2") && process.env.NODE_ENV === 'production'){
        window.location.replace('http://cnzhaoshu.com/login.html?login_uri='+window.location.href);
        //window.location.href = "http://cnzhaoshu.com/admin/login.html"
    }
    next();
});

export default router

