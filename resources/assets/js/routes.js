window.Vue = require('vue');
// import Vue from 'vue'
import Router from 'vue-router';

Vue.use(Router);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



export default new Router({
    mode: 'history',
    routes: [{
            name: 'home',
            path: '/',
            component: require('./views/Home')
        },
        {
            name: 'nosotros',
            path: '/nosotros',
            component: require('./views/About')
        },
        {
            name: 'archivo',
            path: '/archivo',
            component: require('./views/Archive')
        },
        {
            name: 'contacto',
            path: '/contacto',
            component: require('./views/Contact')
        },
        {
            name: 'login',
            path: '/login',
            component: require('./views/Login')
        },
        {
            name: 'post_show',
            path: '/reportes/:url',
            component: require('./views/PostsShow')
        },
        {
            name: 'categorias_show',
            path: '/categorias/:category',
            component: require('./views/CategoriasShow')
        },
        {
            name: 'tags_show',
            path: '/etiquetas/:tag',
            component: require('./views/TagsShow')
        },
        {
            name: 'subcategory_show',
            path: '/subcategorias/:subcategory',
            component: require('./views/SubcategoryShow')
        },
        {
            path: '*',
            component: require('./views/404')
        }
    ],
    linkExactActiveClass: 'active'
});