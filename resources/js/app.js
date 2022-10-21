import './bootstrap';

import {createApp} from 'vue/dist/vue.esm-bundler.js';
import { createPinia } from 'pinia';
import AddComment from './components/AddComment.vue';
import CommentsCount from './components/CommentsCount.vue';
import Comments from './components/Comments.vue';
import Search from './components/Search.vue';
import SearchCanvas from './components/SearchCanvas.vue';

const app = createApp({});
const pinia = createPinia();

app.component('comments-component', Comments);
app.component('add-comment', AddComment);
app.component('comments-count', CommentsCount);
app.component('search-component', Search);
app.component('search-canvas', SearchCanvas);

app.use(pinia);
app.mount("#app");