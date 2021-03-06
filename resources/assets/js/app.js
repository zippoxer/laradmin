import './bootstrap';
import Vue from 'vue';
import Buefy from 'buefy';
import Login from './Components/Auth/LoginForm';
import TopBar from './Components/TopBar/TopBar';
import CollapsibleMenu from './Components/CollapsibleMenu/CollapsibleMenu.vue';
import BrowseMenus from './Components/Menus/BrowseMenus';
import MenuBuilder from './Components/Menus/MenuBuilder';
import BrowseTypes from './Components/Types/BrowseTypes';
import TypeCreateEdit from './Components/Types/TypeCreateEdit';
import Crud from './Components/Crud/Crud';
import { Vue2Dragula } from 'vue2-dragula';
import VueClip from 'vue-clip'
import Multiselect from 'vue-multiselect/src/index';
import Vddl from 'vddl';
import LaIconInput from './Components/IconInput/IconInput.vue';

import './Filters/Slugify';
import './Filters/Date';

Vue.component('multiselect', Multiselect);
Vue.component('la-icon-input', LaIconInput);

Vue.use(Buefy, {
    defaultIconPack: 'fa',
});

Vue.use(Vue2Dragula, {});
Vue.use(VueClip);
Vue.use(Vddl);

const app = new Vue({
    el: '#app',

    components: {
        Login,
        TopBar,
        CollapsibleMenu,
        BrowseMenus,
        MenuBuilder,
        BrowseTypes,
        TypeCreateEdit,
        Crud
    }
});

