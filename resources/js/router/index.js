import { createRouter, createWebHistory } from "vue-router";
import routes from "./routes";

const router = Router();
export default router;

function Router() {
    const router = new createRouter({
        history: createWebHistory(),
        routes,
    });
    return router;
}
router.beforeEach(async (to, from) => {
    // make sure the user is authenticated
    const isAuthenticated = JSON.parse(localStorage.getItem('logined')) ?? false;
    if (to.name?.includes('Master')) {

        // ❗️ Avoid an infinite redirect
        if (!isAuthenticated && to.name !== 'Master.Login') {
            // redirect the user to the login page
            return { name: 'Master.Login' }
        }
    }
    if (to.name?.includes('Client')) {

        // // ❗️ Avoid an infinite redirect
        // if (!isAuthenticated && to.name !== 'Login') {
        //     // redirect the user to the login page
        // }
        // return { name: 'Client.Store' }
    }
    if (isAuthenticated && to.name == 'Login') {
        return { name: 'Master' }
    }

})