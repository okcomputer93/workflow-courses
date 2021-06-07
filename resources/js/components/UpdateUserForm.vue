<template>
    <form class="flex flex-col justify-start items-start w-full"
          @submit.prevent="onSubmit"
          @keydown="form.errors.clear($event.target.id)"
    >
        <div class="flex justify-start items-center w-full">
            <h2 class="flex-initial flex-shrink-0 text-2xl font-bold text-gray-800 pr-3">Información Básica</h2>
            <div class="h-0.5 flex-initial w-2/3 bg-gray-200"></div>
        </div>

        <img class="rounded-full h-44 w-44 self-center mt-5 ring-4 ring-indigo-500"
             :src="user.avatar"
             :alt="`${user.name}'s avatar`"
        >

        <div class="w-2/5 relative">
            <div class="flex flex-col justify-center items-start">
                <div class="w-full">
                    <label class="block text-sm font-bold text-gray-400 mb-2"
                           for="name"
                    >
                        Nombre
                    </label>
                    <input class="w-full appearance-none relative block px-3 py-2 border border-gray-300 placeholder-gray-300 text-gray-600 rounded-md focus:outline-none focus:border-indigo-500 ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base"
                           :class="form.errors.get('name') ? 'ring-red-600' : ''"
                           type="text"
                           id="name"
                           v-model="form.name"
                           required
                    >
                    <span class="text-xs font-light text-red-800 absolute mt-2">{{ form.errors.get('name') }}</span>
                </div>

                <div class="mt-10 w-full">
                    <label class="block text-sm font-bold text-gray-400 mb-2"
                           for="email"
                    >
                        Correo Electrónico
                    </label>
                    <input class="w-full appearance-none relative block px-3 py-2 border border-gray-300 placeholder-gray-300 text-gray-600 rounded-md focus:outline-none focus:border-indigo-500 ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base"
                           :class="form.errors.get('email') ? 'ring-red-600' : ''"
                           type="email"
                           id="email"
                           v-model="form.email"
                           required
                    >
                    <span class="text-xs font-light text-red-800 absolute mt-2">{{ form.errors.get('email') }}</span>
                </div>

                <span class="absolute bottom-16 text-green-800 text-xs font-light" v-if="form.successMessage">{{ form.successMessage }}</span>

                <div class="mt-14">
                    <button class="text-center text-sm px-8 rounded-full py-3 bg-indigo-500 text-white hover:bg-indigo-600 transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                            :disabled="isSubmitable"
                    >
                        Guardar Cambios
                    </button>
                </div>
            </div>

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
        haveInputsChanged() {
            return this.form.name.trim() !== this.newName
                || this.form.email.trim() !== this.newEmail;
        },
        areInputsEmpty() {
            return this.form.name === ''
                || this.form.email === '';
        },
        isSubmitable() {
            return !this.haveInputsChanged
                || this.form.errors.any()
                || this.areInputsEmpty;
        }
    },
    methods: {
        async onSubmit() {
            try {
                this.isLoading = true;

                await this.form.submit('put', '/user/profile-information');
                this.form.successMessage = 'Se ha actualizado la información';

                this.newName = this.form.name.trim();
                this.newEmail = this.form.email.trim();

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
