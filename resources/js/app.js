import './bootstrap';
import { createApp } from 'vue'
import App from './App.vue'

import welcome from './components/welcome'
import "./dist/app.css";

import PrimeVue from 'primevue/config';
import router from "./router";
import Tooltip from 'primevue/tooltip';

import "primevue/resources/themes/tailwind-light/theme.css";
import 'primevue/resources/primevue.min.css'
import 'primeicons/primeicons.css'

const app = createApp(App)
app.component('wellcome', welcome)
app.directive('tooltip', Tooltip);

app.use(PrimeVue);
app.use(router);
app.mount('#app')
