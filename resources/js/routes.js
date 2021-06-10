import Settings from "./components/Settings";
import Dashboard from "./components/Dashboard";
import Profile from "./components/Profile";

export default {
    mode: 'history',
    routes: [
        {
            path: '/user',
            redirect: '/user/dashboard',
            name: 'home',
            component: Settings,
            children: [
                {
                    path: 'dashboard',
                    name: 'home.dashboard',
                    component: Dashboard
                },
                {
                    path: 'profile',
                    name: 'home.profile',
                    component: Profile
                }
            ]
        }
    ]
}
