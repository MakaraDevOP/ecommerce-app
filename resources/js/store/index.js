import { createStore } from "vuex";
import { menu } from './menu.module'
import { customer } from './customer.module.js'
import { auth } from './auth.module.js'
import {product} from './product.module'
const store = createStore({
    modules: {
        product,
        menu,
        customer,
        auth
    },
});

export default store;

