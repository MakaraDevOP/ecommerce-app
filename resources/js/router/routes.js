export default [
    {
        name: "Master",
        component: import ('./../pages/layout/master.vue'),
        path: "/",
        redirect:'/dashboard',
        children: [
            {
                name: "Dashboard",
                component: import ('./../pages/dashboard'),
                path: "/dashboard",
            },
            {
                name: "Home",
                component: import ('./../pages/home'),
                path: "/home",
            },
            {
                name: "User",
                component: import ('./../pages/users'),
                path: "/user",
            },
        ]
    },
    {
        name: "Login",
        component: import ('./../pages/auth/login'),
        path: "/login",
    },
]