import { createStore } from "vuex";
import { menu } from './menu.module'
import { customer } from './customer.module.js'
import { auth } from './auth.module.js'
import { user } from './user.module'
const store = createStore({
    modules: {
        menu,
        customer,
        auth,
        user
    },
});

export default store;

