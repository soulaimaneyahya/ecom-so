import './bootstrap';


import {createApp} from 'vue/dist/vue.esm-bundler.js'

import Hi from './components/Hi.vue';
import ReviewInput from './components/admin/reviews/ReviewInput.vue';
import StarRated from './components/shared/StarRated.vue';

const app = createApp({});
app.component('review-input',ReviewInput);
app.component('star-rated', StarRated);

app.component('hi', Hi);

app.mount("#app")
