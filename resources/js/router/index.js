import { createWebHistory,createRouter } from "vue-router";

import Login from  "../Pages/Login.vue";
import Register from "../Pages/Register.vue";
import Store from "../Pages/Store.vue";
import Pos from "../Pages/Pos.vue";
import report from "../Pages/report.vue";
import transfer from "../Pages/transfer.vue";

export const routes = [
    {
        name : "Login page",
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

export default router