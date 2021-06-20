<template>
    <form class="flex flex-col justify-start items-start w-full"
          @submit.prevent="onSubmit"
          @keydown="form.errors.clear($event.target.id)"
    >
        <div class="flex justify-center items-center w-full mt-5 md:justify-start">
            <h2 class="flex-initial flex-shrink-0 text-base text-center font-bold text-gray-800 pr-3 sm:text-xl md:text-left md:text-2xl">Información Básica</h2>
            <span class="h-0.5 flex-initial w-2/3 bg-gray-200 hidden md:inline-block"></span>
        </div>

        <update-image class="self-center mt-5"
                      :default="user.avatar"
                      v-model="form.avatar"
                      :alt="`${user.name}'s avatar`"
        ></update-image>

        <div class="w-full relative sm:w-4/5 md:w-3/5 xl:w-2/5">
            <div class="flex flex-col justify-center items-center md:items-start mt-5 md:mt-3 w-full">
                <div class="w-full">
                    <label class="block text-sm font-bold text-gray-400 mb-2"
                           for="name"
                    >
                        Nombre
                    </label>
                    <input class="w-full appearance-none relative block px-3 py-2 border border-gray-300 placeholder-gray-300 text-gray-600 rounded-md focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base"
                           :class="form.errors.get('name') ? 'ring-1 ring-red-500' : ''"
                           type="text"
                           id="name"
                           v-model="form.name"
                           required
                    >
                    <span class="text-xs font-light text-red-500 absolute mt-2">{{ form.errors.get('name') }}</span>
                </div>

                <div class="mt-10 w-full">
                    <label class="block text-sm font-bold text-gray-400 mb-2"
                           for="email"
                    >
                        Correo Electrónico
                    </label>
                    <input class="w-full appearance-none relative block px-3 py-2 border border-gray-300 placeholder-gray-300 text-gray-600 rounded-md focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base"
                           :class="form.errors.get('email') ? 'ring-1 ring-red-600' : ''"
                           type="email"
                           id="email"
                           v-model="form.email"
                           required
                    >
                    <span class="text-xs font-light text-red-500 absolute mt-2">{{ form.errors.get('email') }}</span>
                </div>

                <span class="absolute bottom-16 text-green-800 text-xs font-light" v-if="successMessage">{{ successMessage }}</span>

                <div class="mt-8 md:mt-14 pb-4">
                    <button class="text-center text-sm px-8 rounded-full py-3 bg-indigo-500 text-white hover:bg-indigo-600 transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                            :disabled="isNotSubmitable || isLoading"
                    >
                        Guardar Cambios
                    </button>
                </div>
            </div>

        </div>

    </form>
</template>

<script>
import { Form } from '../../form';
import UpdateImage from "./UpdateImage";
export default {
    name: "UpdateUserForm.vue",
    components: {
        UpdateImage
    },
    props: {
        user: Object
    },
    data() {
        return {
            newName: '',
            newEmail: '',
            newAvatar: null,
            isLoading: false,
            successMessage: '',
            form: new Form({
                name: '',
                email: '',
                avatar: null,
            })
        }
    },
    watch: {
        user(value) {
            this.form.name = value.name;
            this.form.email = value.email;
            this.newName = value.name;
            this.newEmail = value.email;
        },
    },
    computed: {
        haveInputsChanged() {
             return this.form.name.trim() !== this.newName
                || this.form.email.trim() !== this.newEmail
                || this.form.avatar !== this.newAvatar;
        },
        areInputsEmpty() {
            return this.form.name === ''
                || this.form.email === '';
        },
        isNotSubmitable() {
            return !this.haveInputsChanged
                || this.form.errors.any()
                || this.areInputsEmpty;
        }
    },
    methods: {
        async onSubmit() {
            if (this.isNotSubmitable) return

            this.isLoading = true;

            await this.form.submit('put', '/user/profile-information');
            this.successMessage = 'Se ha actualizado la información';

            this.updateUserInfo();

            setTimeout(() => {
                this.successMessage = '';
            }, 5000);
            this.isLoading = false;
        },
        updateUserInfo() {
            this.newName = this.form.name.trim();
            this.newEmail = this.form.email.trim();
            this.newAvatar = this.form.avatar;
        }
    },
    mounted() {
        this.form.name = this.user.name;
        this.form.email = this.user.email;
        this.newName = this.user.name;
        this.newEmail = this.user.email;
    }
}
</script>

<style scoped>

</style>
