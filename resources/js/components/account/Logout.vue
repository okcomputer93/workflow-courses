<template>
    <div class="w-1/3 relative md:w-full">
        <span class="absolute text-xs font-light text-red-400 -top-24 text-center" v-if="errors">{{ errors}}</span>
       <div class="flex justify-center items-center">
           <button class="w-12 h-12 p-3 bg-gray-100 hover:bg-red-100 text-gray-400 hover:text-gray-500 rounded-full focus:outline-black"
                   @click="logout"
                   title="Cerrar Sesión"
           >
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
               </svg>
           </button>
       </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: "Logout.vue",
    data() {
        return {
            errors: '',
        }
    },
    methods: {
        async logout() {
           try {
               await axios.post('/logout');
               location.reload();
           } catch (e) {
                this.errors = e.toString();
           }
        }
    }
}
</script>

<style scoped>

</style>
