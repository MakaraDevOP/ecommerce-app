export default [
    {
        name: "Master",
        component: import ('./../pages/layout/master.vue'),
        path: "/",
        children: [
            {
                name: "Home",
                component: import ('./../pages/home'),
                path: "/home",
            },
            {
                name: "Login",
                component: import ('./../pages/auth/login'),
                path: "/login",
            },
        ]
    },
]