import Vue from "vue";
import VueRouter from "vue-router";
import NewsFeed from "./views/NewsFeed";
import UserShow from "./views/Users/Show";

Vue.use(VueRouter);

export default new VueRouter({
   mode: 'history',
    routes: [
        {
            path: '/',
            component: NewsFeed,
            name: 'home',
            meta: {
                title: 'News Feed'
            }
        },
        {
            path: '/users/:userId',
            component: UserShow,
            name: 'user.show',
            meta: {
                title: 'Profile'
            }
        },
    ]
});
