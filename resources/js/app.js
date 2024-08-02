import './bootstrap';
import '../css/style.min.css';
import "vue-select/dist/vue-select.css";
import "./libs/jquery/dist/jquery.min.js";
import "./libs/simplebar/dist/simplebar.min.js";
import "./libs/bootstrap/dist/js/bootstrap.bundle.min.js";
import "./Moderenize/app.min.js";
import "./Moderenize/app.init.js";
import "./Moderenize/sidebarmenu.js";
import "./Moderenize/app-style-switcher.js";
// import "./Moderenize/custom.js";

import layoutMixin from './layoutMixin';


import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import vSelect from 'vue-select';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

// moment js
import moment from 'moment';

// search input package
import SearchInput from 'vue-search-input'
import 'vue-search-input/dist/styles.css'

// select list siswa filter
import SelectSiswa from './Components/SelectSiswa.vue';

// helper file
import StringManipulation from './StringManipulation';

// upload image
import ImageUpload from './Components/ImageUpload.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
     setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.mixin(layoutMixin);
        app.use(plugin)
            .use(ZiggyVue)
            .use(VueSweetalert2)
            .component("v-select", vSelect)
            .component("v-search", SearchInput)
            .component('select-siswa',SelectSiswa)
            .component('image-upload',ImageUpload);
        
        app.config.globalProperties.$Helper = StringManipulation;
        app.config.globalProperties.$moment = moment;
        
        app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
