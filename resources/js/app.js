import './bootstrap';

import { createApp } from 'vue'
import welcome from './components/welcome'
const app = createApp({})

app.component('wellcome', welcome)
app.mount('#app')

