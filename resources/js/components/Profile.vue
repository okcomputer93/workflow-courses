<template>
    <dashboard-section>
        <template v-slot:left>
          <div class="flex flex-col justify-start items-start">
              <h1 class="text-5xl font-bold text-gray-800">
                  Editar tu perfil
              </h1>

              <update-user-form :user="user"></update-user-form>

              <update-user-password class="mt-20"></update-user-password>

          </div>
        </template>

        <template v-slot:content-right>

        </template>
    </dashboard-section>
</template>


<script>
import axios from 'axios';
import DashboardSection from "./DashboardSection";
import UpdateUserForm from "./UpdateUserForm";
import UpdateUserPassword from "./UpdateUserPassword";
export default {
    name: 'Profile.vue',
    components: {
        DashboardSection,
        UpdateUserForm,
        UpdateUserPassword
    },
    data() {
        return {
            user: {}
        }
    },
    async created() {
        const response = await axios.get('/api/user/information');
        this.user = response.data;
    }
}
</script>
