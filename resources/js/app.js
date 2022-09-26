import './bootstrap';

import { createApp } from 'vue';

import app from './components/app.vue'

import VueAxios from 'vue-axios'

import router from './routes'

createApp(app).use(router, VueAxios).mount("#app")

