import Main from "../view/main/main"

export default [
    {
        name: 'error_404',
        component: () => import('../view/error-page/error_404'),
        meta: {
            title: '会员中心'
        }
    },
    {
        name: 'user',
        component: () => import('../view/user/index'),
        meta: {
            title: '会员中心'
        }
    },
    {
        name: 'cart',
        component: () => import('../view/cart/index'),
        meta: {
            title: '购物车'
        }
    },
    {
        name: 'bindPhone/:phone',
        component: () => import('../view/supervise/bindPhone'),
        meta: {
            title: '绑定手机号'
        }
    },
    {
        name: 'goods',
        component: Main,
        meta: {
            title: '商品详情'
        },
        children: [
            {
                path: '/goods',
                name: 'goodsinner',
                meta: {
                    title: '招标列表'
                },
                component: () => import('../view/cart/index')
            },
        ]

    },
    {
        name: 'transaction',
        component: Main,
        meta: {
            title: '找树网'
        },
        children: [
            {
                path: '/bid',
                name: 'bid',
                meta: {
                    title: '投标大厅'
                },
                component: () => import('../view/transaction/bid')
            },
        ]

    },
    {
        name: 'supervise',
        component: Main,
        meta: {
            title: '交易监管'
        },
        children: [
            {
                path: '/supervise',
                name: 'superviseList',
                meta: {
                    title: '交易监管'
                },
                component: () => import('../view/supervise/index')
            },
        ]

    },
    {
        name: 'contract',
        component: Main,
        meta: {
            title: '交易监管'
        },
        children: [
            {
                path: '/contract/:id',
                name: 'contractList',
                meta: {
                    title: '交易监管'
                },
                component: () => import('../view/supervise/contract')
            },
        ]

    },
    {
        name: 'treeSupervise',
        component: Main,
        meta: {
            title: '交易监管'
        },
        children: [
            {
                path: '/treeSupervise/:id/:yc',
                name: 'treeSupervise',
                meta: {
                    title: '交易监管'
                },
                component: () => import('../view/supervise/treeSupervise')
            },
        ]

    },
    {
        name: 'treeInfo',
        component: Main,
        meta: {
            title: '交易监管'
        },
        children: [
            {
                path: '/treeInfo/:id',
                name: 'treeInfo',
                meta: {
                    title: '交易监管'
                },
                component: () => import('../view/supervise/treeInfo')
            },
        ]

    },
    {
        name: 'treeUnusual',
        component: Main,
        meta: {
            title: '交易监管'
        },
        children: [
            {
                path: '/treeUnusual/:id',
                name: 'treeUnusual',
                meta: {
                    title: '交易监管'
                },
                component: () => import('../view/supervise/treeUnusual')
            },
        ]

    },
    {
        name: 'confirmSupervise',
        component: Main,
        meta: {
            title: '交易监管'
        },
        children: [
            {
                path: '/confirmSupervise/:id',
                name: 'confirmSupervise',
                meta: {
                    title: '交易监管'
                },
                component: () => import('../view/supervise/confirmSupervise')
            },
        ]

    },
    {
        name: 'postSuperviseInfo',
        component: Main,
        meta: {
            title: '交易监管'
        },
        children: [
            {
                path: '/postSuperviseInfo/:id',
                name: 'postSuperviseInfo',
                meta: {
                    title: '交易监管'
                },
                component: () => import('../view/supervise/postSuperviseInfo')
            },
        ]

    },
    {
        path: '*',
        redirect: '/supervise'
    }
]
