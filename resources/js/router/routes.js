export default [
    {
        name: "Master",
        component: import('./../pages/layout/master.vue'),
        path: "/backend",
        redirect: '/backend/dashboard',
        children: [
            {
                name: "Master.Dashboard",
                component: import('./../pages/dashboard'),
                path: "/backend/dashboard",
            },
            {
                name: "Master.User",
                component: import('./../pages/users'),
                path: "/backend/user",
            },
            {
                name: "Master.Product",
                component: import('./../pages/product'),
                path: "/backend/product",
            },
            {
                name: "Master.Contact",
                component: import('./../pages/contact'),
                path: "/backend/contact",
            },
            {
                name: "Master.Customer",
                component: import('./../pages/customer'),
                path: "/backend/customer",
            },
            {

                name: "Master.Activation",
                component: import('./../pages/activation'),
                path: "/backend/sales",
            }
        ]
    },
    {
        name: "Master.Login",
        component: import('./../pages/auth/login'),
        path: "/backend/login",
    },
    {

        name: "preview",
        component: import('./../pages/preview'),
        path: "/preview",
        props: true,
    },
    {
        name: "Client",
        component: import('./../pages/layout/client.vue'),
        path: "/",
        children: [
            {
                name: "Client.Store",
                component: import('./../pages/store'),
                path: "/",
            },
            {
                name: "Client.card",
                component: import('./../pages/store/card'),
                path: "/cart",
            },
        ]
    }
]