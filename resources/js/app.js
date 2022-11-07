import './bootstrap';


import {createApp} from 'vue/dist/vue.esm-bundler.js'
import Hi from './components/Hi.vue';
const app = createApp({});
app.component('hi',Hi);
app.mount("#app")