<template>
    <div>
        <div v-if="isLoading"
             class="w-full h-screen flex justify-center items-center"
        >
            <loading-spinner></loading-spinner>
        </div>
       <transition name="fade">
           <dashboard-section v-if="!isLoading">
               <template v-slot:title>
                   <h1 class="text-5xl font-bold text-gray-800">
                       Editar tu perfil
                   </h1>
               </template>
               <template v-slot:left>
                   <div class="flex flex-col justify-start items-start">
                       <update-user-form ref="updateUser"
                                         :user="user"
                       ></update-user-form>
                       <update-user-password ref="updatePassword"
                                             class="mt-20"
                       ></update-user-password>
                   </div>
               </template>
           </dashboard-section>
       </transition>
    </div>
</template>


<script>
import axios from 'axios';
import DashboardSection from "./DashboardSection";
import UpdateUserForm from "./UpdateUserForm";
import UpdateUserPassword from "./UpdateUserPassword";
import LoadingSpinner from "../core/LoadingSpinner";
export default {
    name: 'Profile.vue',
    components: {
        DashboardSection,
        UpdateUserForm,
        UpdateUserPassword,
        LoadingSpinner
    },
    data() {
        return {
            user: {},
            isLoading: null,
        }
    },
    computed: {
        pendingInfo() {
            return this.$refs.updateUser.haveInputsChanged
                || this.$refs.updatePassword.anyInputFilled;
        }
    },
    async created() {
        try {
            this.isLoading = true;
            const response = await axios.get('/api/user/information');
            this.user = response.data;
        } catch (e) {

        } finally {
            this.isLoading = false;
        }
    }
}
</script>

<style scoped>
.fade-enter-active {
    transition: all 1.5s ease-in-out;
}
.fade-enter {
    opacity: 0;
    transform: scale(1.1);
}
</style>
