import { createStore } from "vuex";
import { menu } from './menu.module'
import { customer } from './customer.module'
import { auth } from './auth.module'
import { user } from './user.module'
import { product } from './product.module'
import { contact } from './contact.module'
import { activation } from './activation.module'
import { note } from './note.module'
import { upload } from './upload.module'



const store = createStore({
    modules: {
        product,
        menu,
        customer,
        auth,
        user,
        contact,
        activation,
        note,
        upload
    },
});
export default store;

