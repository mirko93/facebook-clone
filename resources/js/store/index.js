import Vue from 'vue';
import VueX from 'vuex';
import User from './modules/user';
import Title from './modules/title';

Vue.use(VueX);

export default new VueX.Store({
    modules: {
        User,
        Title,
    }
});