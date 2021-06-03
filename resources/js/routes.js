import Dashboard from "./components/Dashboard";
import MyCoursesList from "./components/MyCoursesList";
import Profile from "./components/Profile";
import UploadedCoursesList from "./components/UploadedCoursesList";

export default {
    mode: 'history',
    routes: [
        {
            path: '/user',
            component: Dashboard
        },
        {
            path: '/user/my-courses',
            component: MyCoursesList
        },
        {
            path: '/user/profile',
            component: Profile,
        },
        {
           path: '/user/uploaded-courses',
           component: UploadedCoursesList
        }
    ]
}
