import Vue from 'vue';
import VueX from 'vuex';
import User from './modules/user';
import Title from './modules/title';
import Profile from './modules/profile';
import Posts from './modules/posts';

Vue.use(VueX);

export default new VueX.Store({
    modules: {
        User,
        Title,
        Profile,
        Posts,
    }
});
