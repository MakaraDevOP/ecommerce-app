import './bootstrap';
import { createApp } from 'vue'
import App from './App.vue'

import welcome from './components/welcome'
import "./dist/app.css";

import store from "./store/index"
import PrimeVue from 'primevue/config';
import router from "./router";
import Tooltip from 'primevue/tooltip';

import "primevue/resources/themes/tailwind-light/theme.css";
import 'primevue/resources/primevue.min.css'
import 'primeicons/primeicons.css'

// SET HEADER WITH TOKEN 
axios.defaults.headers.common["Authorization"] = "Bearer " + JSON.parse(localStorage.getItem("token")) ?? '';
axios.defaults.headers.common["content-type"] = "application/json";
axios.defaults.headers.common["Accept"] = "application/json";

axios.defaults.baseURL = (process.env.API_PATH !== 'production') ? 'http://127.0.0.1:8000/api/v1' : '';



const app = createApp(App)

app.component('wellcome', welcome)
app.directive('tooltip', Tooltip);

app.use(PrimeVue);
app.use(store);
app.use(router);
app.mount('#app')
