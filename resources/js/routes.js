import Settings from "./components/account/Settings";
import Dashboard from "./components/account/Dashboard";
import Account from "./components/account/Account";

export default {
    mode: 'history',
    routes: [
        {
            path: '/user',
            redirect: '/user/dashboard',
            name: 'home',
            component: Account,
            children: [
                {
                    path: 'dashboard',
                    name: 'home.dashboard',
                    component: Dashboard
                },
                {
                    path: 'profile',
                    name: 'home.settings',
                    component: Settings
                }
            ]
        }
    ]
}
