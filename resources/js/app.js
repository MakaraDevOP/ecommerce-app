import './bootstrap';
import { createApp } from 'vue'
import App from './App.vue'

// SET HEADER WITH TOKEN 
axios.defaults.headers.common["Authorization"] = "Bearer " + JSON.parse(localStorage.getItem("token")) ?? '';
axios.defaults.headers.common["content-type"] = "application/json";
axios.defaults.headers.common["Accept"] = "application/json";
axios.defaults.baseURL = (process.env.API_PATH !== 'production') ? 'http://127.0.0.1:8000/api/v1' : '';
//__________________________________________________AXIOS_________________________________________________________________//

//IMPORT STYLE
import "./dist/app.css";
import "primevue/resources/themes/tailwind-light/theme.css";
import 'primevue/resources/primevue.min.css'
import 'primeicons/primeicons.css'
//IMPORT COMPONENTS
import store from "./store/index"
import PrimeVue from 'primevue/config';
import router from "./router";
import Tooltip from 'primevue/tooltip';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Menu from "primevue/menu";
import InputText from "primevue/inputtext";
import Button from 'primevue/button';
import CheckBox from 'primevue/checkbox'
import Dialog from 'primevue/dialog';
import Textarea from 'primevue/textarea';
import Dropdown from 'primevue/dropdown';
import Badge from 'primevue/badge';
import Sidebar from 'primevue/sidebar';
import Panel from 'primevue/panel';
import ScrollPanel from 'primevue/scrollpanel';
import Calendar from 'primevue/calendar';

// vue validation
import { Form, Field, ErrorMessage } from "vee-validate";
import ToastService from 'primevue/toastservice';
import Toast from 'primevue/toast';
import ConfirmationService from 'primevue/confirmationservice';
import ConfirmPopup from 'primevue/confirmpopup';

const app = createApp(App)
//COMPONENTS
app.component('DataTable', DataTable)
app.component('Column', Column)
app.component('Menu', Menu)
app.component('InputText', InputText)
app.component('Button', Button)
app.component('Checkbox', CheckBox)
app.component('Dialog', Dialog)
app.component('Textarea', Textarea)

app.component('Dropdown',Dropdown)
app.component('Badge', Badge)
app.component('Sidebar', Sidebar)
app.component('Panel', Panel)
app.component('ScrollPanel', ScrollPanel)
app.component('Calendar',Calendar)

// vue validation
app.component('Form', Form)
app.component('Field', Field)
app.component('ErrorMessage', ErrorMessage)

app.component('Dropdown', Dropdown)
app.component('Toast', Toast)
app.component('ConfirmPopup',ConfirmPopup)

app.directive('tooltip', Tooltip);
app.use(ToastService);
app.use(ConfirmationService);
app.use(PrimeVue);
app.use(store);
app.use(router);
app.mount('#app')
