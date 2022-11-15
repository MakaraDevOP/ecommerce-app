import { createStore } from "vuex";
import { menu } from './menu.module'
import { customer } from './customer.module.js'
import { auth } from './auth.module.js'

const store = createStore({
    modules: {
        menu,
        customer,
        auth
    },
});

export default store;

