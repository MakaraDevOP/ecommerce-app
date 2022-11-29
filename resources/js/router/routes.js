export default [
    {
        name: "Master",
        component: import('./../pages/layout/master.vue'),
        path: "/",
        redirect: '/dashboard',
        children: [
            {
                name: "Dashboard",
                component: import('./../pages/dashboard'),
                path: "/dashboard",
            },
            {
                name: "User",
                component: import('./../pages/users'),
                path: "/user",
            },
            {
                name: "Product",
                component: import('./../pages/product'),
                path: "/product",
            },
            {
                name: "Contact",
                component: import('./../pages/contact'),
                path: "/contact",
            },
            {
                name: "Customer",
                component: import('./../pages/customer'),
                path: "/customer",
            },
            {

                name: "Activation",
                component: import('./../pages/activation'),
                path: "/activation",
            }
        ]
    },
    {
        name: "Login",
        component: import('./../pages/auth/login'),
        path: "/login",
    },
    {

        name: "preview",
        component: import('./../pages/preview'),
        path: "/preview",
        props: true,
    }
]