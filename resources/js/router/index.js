import { createWebHistory,createRouter } from "vue-router";
import { useStorage } from "vue3-storage";
const storage = useStorage();

import Login from  "../Pages/Login.vue";
import Register from "../Pages/Register.vue";
import Store from "../Pages/Store.vue";
import Pos from "../Pages/Pos.vue";
import report from "../Pages/report.vue";
import transfer from "../Pages/transfer.vue";

export const routes = [
    {
        name : "Login page1",
        path : "/",
        component : Login,
    },
    {
        name : "Login page",
        path : "/login",
        component : Login,
    },
    {
        name : "Register page",
        path : "/Register",
        component : Register,
    },
    {
        name : "Store page",
        path : "/store",
        component : Store,
    },
    {
        name : "Pos page",
        path : "/pos",
        component : Pos
    },
    {
        name : "Transfer Page",
        path : "/transfer",
        component : transfer
    },
    {
        name : "Report Page",
        path : "/report",
        component : report
    }
]

const router = createRouter({
    history : createWebHistory(),
    routes : routes,
    scrollBehavior(){
        window.scrollTo(0,0)
    }

})

router.beforeEach((to , from, next)=>{
    if(to.path=='/register'){
        next();
    }else{

    if(to.path!='/login' && !storage.getStorageSync('isLoggin') && !window.Laravel.isLoggin){
        next({
            path: '/login',
            replace : true
        })
    }else{
        if(to.path=='/login' && storage.getStorageSync('isLoggin') && window.Laravel.isLoggin){
            next({
                path: '/store',
                replace : true
            })
        }else{
            next();
        }
    }
}
})

export default router