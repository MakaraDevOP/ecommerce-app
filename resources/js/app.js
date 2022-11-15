import './bootstrap';
import { createApp } from 'vue'
import App from './App.vue'

// SET HEADER WITH TOKEN 
axios.defaults.headers.common["Authorization"] = "Bearer " + JSON.parse(localStorage.getItem("token")) ?? '';
axios.defaults.headers.common["content-type"] = "application/json";
axios.defaults.headers.common["Accept"] = "application/json";
axios.defaults.baseURL = (process.env.API_PATH !== 'production') ? 'http://127.0.0.1:8000/api/v1' : '';
//________________________________

import "./dist/app.css";

import store from "./store/index"
import PrimeVue from 'primevue/config';
import router from "./router";
import Tooltip from 'primevue/tooltip';

import "primevue/resources/themes/tailwind-light/theme.css";
import 'primevue/resources/primevue.min.css'
import 'primeicons/primeicons.css'

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Menu from "primevue/menu";
import InputText from "primevue/inputtext";
import Button from 'primevue/button';
import CheckBox from 'primevue/checkbox'


const app = createApp(App)
app.component('DataTable', DataTable)
app.component('Column', Column)
app.component('Menu', Menu)
app.component('InputText', InputText)
app.component('Button', Button)
app.component('Checkbox',CheckBox)
app.directive('tooltip', Tooltip);

app.use(PrimeVue);
app.use(store);
app.use(router);
app.mount('#app')
