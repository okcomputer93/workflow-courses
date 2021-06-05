<template>
    <form class="flex flex-col justify-start items-start w-full" @submit.prevent="onSubmit">
        <div class="flex justify-start items-center w-full">
            <h2 class="flex-initial flex-shrink-0 text-2xl font-bold text-gray-800 pr-3">Información Básica</h2>
            <div class="h-0.5 flex-initial w-2/3 bg-gray-200"></div>
        </div>

        <img class="rounded-full h-44 w-44 self-center mt-5 ring-4 ring-indigo-500"
             :src="user.avatar"
             :alt="`${user.name}'s avatar`"
        >

        <div class="w-1/3 space-y-10">
            <div>
                <label class="block text-sm font-bold text-gray-400 mb-2"
                       for="name"
                >
                    Nombre
                </label>
                <input class="w-full appearance-none relative block px-3 py-2 border border-gray-300 placeholder-gray-300 text-gray-600 rounded-md focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base"
                       type="text"
                       id="name"
                       v-model="form.name"
                >
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-400 mb-2"
                       for="email"
                >
                    Correo Electrónico
                </label>
                <input class="w-full appearance-none relative block px-3 py-2 border border-gray-300 placeholder-gray-300 text-gray-600 rounded-md focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base"
                       type="email"
                       id="email"
                       v-model="form.email"
                >
            </div>

            <span class="relative text-green-800 text-xs font-light" v-if="form.successMessage">{{ form.successMessage }}</span>

            <button class="text-center my-4 text-sm px-8 rounded-full py-3 bg-indigo-500 text-white hover:bg-indigo-600 transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                    :disabled="!hasInputChanged"
            >
                Guardar Cambios
            </button>
        </div>

    </form>
</template>

<script>
import { Form } from '../form';
export default {
    name: "UpdateUserForm.vue",
    props: ['user'],
    data() {
        return {
            newName: '',
            newEmail: '',
            form: new Form({
                name: '',
                email: '',
                isLoading: false,
                successMessage: '',
            })
        }
    },
    watch: {
        user(value) {
            this.form.name = value.name;
            this.form.email = value.email;
            this.newName = value.name;
            this.newEmail = value.email;
        }
    },
    computed: {
      hasInputChanged() {
          return this.form.name !== this.newName || this.form.email !== this.newEmail;
      }
    },
    methods: {
        async onSubmit() {
            try {
                this.isLoading = true;
                await this.form.submit('put', '/user/profile-information');
                this.form.successMessage = 'Se ha actualizado la información';
                this.newName = this.form.name;
                this.newEmail = this.form.email;
                setTimeout(() => {
                    this.form.successMessage = '';
                }, 5000);
            } catch (error) {
                console.log(error);
            }
            this.isLoading = false;
        }

    }
}
</script>

<style scoped>

</style>
