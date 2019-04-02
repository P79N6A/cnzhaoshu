import Main from '@/view/main'
import parentView from '@/components/parent-view'

/**
 * iview-admin中meta除了原生参数外可配置的参数:
 * meta: {
 *  hideInMenu: (false) 设为true后在左侧菜单不会显示该页面选项
 *  notCache: (false) 设为true后页面不会缓存
 *  access: (null) 可访问该页面的权限数组，当前路由设置的权限会影响子路由
 *  icon: (-) 该页面在左侧菜单、面包屑和标签导航处显示的图标，如果是自定义图标，需要在图标名称前加下划线'_'
 * }
 */

export default [
  {
    path: '/login',
    name: 'login',
    meta: {
      title: 'Login - 登录',
      hideInMenu: true
    },
    component: () => import('@/view/login/login.vue')
  },
  {
    path: '/project',
    name: 'project',
    meta: {
      title: '项目管理',
      icon: 'ios-book',
      access:[]
    },
    component: Main,
    children: [
      {
        path: 'projectList',
        name: 'projectList',
        meta: {
          title: '招标列表',
          icon: 'ios-book'
        },
        component: () => import('@/view/project/project-list/project-list.vue')
      },
      {
        path: 'contractList',
        name: 'contractList',
        meta: {
          title: '合同列表',
          icon: 'ios-book'
        },
        component: () => import('@/view/project/project-list/contract-list.vue')
      },
      {
        path: 'projectInfo',
        name: 'projectInfo',
        meta: {
          title: '招标详情',
          icon: 'ios-book',
          notCache: true,
          hideInMenu:true
        },
        component: () => import('@/view/project/project-info/project-info.vue')
      },
      {
        path: 'contractImg',
        name: 'contractImg',
        meta: {
          title: '合同图集',
          icon: 'ios-book',
          notCache: true,
          hideInMenu:true
        },
        component: () => import('@/view/project/project-info/contract-img.vue')
      },
      {
        path: 'excelSub',
        name: 'excelSub',
        meta: {
          title: '发布excel',
          icon: 'ios-book',
          notCache: true
        },
        component: () => import('@/view/project/excel-sub/excel-sub.vue')
      }
    ]
  },
  {
    path: '/',
    name: '_home',
    redirect: '/home',
    component: Main,
    meta: {
      hideInMenu: true,
      notCache: true
    },
    children: [
      {
        path: '/home',
        name: 'home',
        meta: {
          hideInMenu: true,
          title: '首页',
          notCache: true
        },
        component: () => import('@/view/single-page/home')
      }
    ]
  },
  {
    path: '/401',
    name: 'error_401',
    meta: {
      hideInMenu: true
    },
    component: () => import('@/view/error-page/401.vue')
  },
  {
    path: '/500',
    name: 'error_500',
    meta: {
      hideInMenu: true
    },
    component: () => import('@/view/error-page/500.vue')
  },
  {
    path: '*',
    name: 'error_404',
    meta: {
      hideInMenu: true
    },
    component: () => import('@/view/error-page/404.vue')
  }
]
