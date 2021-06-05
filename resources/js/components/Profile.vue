<template>
    <dashboard-section>
        <template v-slot:left>
          <div class="flex flex-col justify-start items-start">
              <h1 class="text-5xl font-bold text-gray-800">
                  Editar tu perfil
              </h1>

              <update-user-form :user="user"></update-user-form>

              <form class="flex flex-col justify-start items-start w-full mt-10">

                  <div class="flex justify-start items-center w-full">
                      <h2 class="flex-initial flex-shrink-0 text-2xl font-bold text-gray-800 pr-3">Actualizar Contraseña</h2>
                      <div class="h-0.5 flex-initial w-1/3 bg-gray-200"></div>
                  </div>

                  <div class="w-1/3">
                      <div class="my-4">
                          <label class="block text-sm font-bold text-gray-400 mb-2"
                                 for="password"
                          >
                              Contraseña
                          </label>
                          <input class="w-full appearance-none relative block px-3 py-2 border border-gray-300 placeholder-gray-300 text-gray-600 rounded-md focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base"
                                 type="password"
                                 id="password"
                          >
                      </div>

                      <div class="my-4">
                          <label class="block text-sm font-bold text-gray-400 mb-2"
                                 for="password_confirmation"
                          >
                              Confirmar Contraseña
                          </label>
                          <input class="w-full appearance-none relative block px-3 py-2 border border-gray-300 placeholder-gray-300 text-gray-600 rounded-md focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base"
                                 type="password"
                                 id="password_confirmation"
                          >
                      </div>

                      <button class="text-center my-4 text-sm px-8 rounded-full py-3 bg-indigo-500 text-white hover:bg-indigo-600 transition-colors duration-300"
                      >
                          Guardar Cambios
                      </button>
                  </div>
              </form>


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
export default {
    name: 'Profile.vue',
    components: {
        DashboardSection,
        UpdateUserForm
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
