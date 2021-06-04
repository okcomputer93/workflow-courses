import Dashboard from "./components/Dashboard";
import Profile from "./components/Profile";

export default {
    mode: 'history',
    routes: [
        {
            path: '/user',
            component: Dashboard
        },
        {
            path: '/user/profile',
            component: Profile,
        },
    ]
}
