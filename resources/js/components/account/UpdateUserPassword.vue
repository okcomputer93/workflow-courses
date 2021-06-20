<template>
    <form class="flex flex-col justify-start items-start w-full"
          @submit.prevent="onSubmit"
          @keydown="form.errors.clear($event.target.id)"
    >
        <div class="flex justify-center items-center w-full mt-5 md:justify-start">
            <h2 class="flex-initial flex-shrink-0 text-base text-center font-bold text-gray-800 pr-3 sm:text-xl md:text-left md:text-2xl">Actualizar Contraseña</h2>
            <div class="h-0.5 flex-initial w-1/3 bg-gray-200 hidden md:inline-block"></div>
        </div>

        <div class="w-full relative sm:w-4/5 md:w-3/5 xl:w-2/5">
            <div class="flex flex-col justify-center items-center md:items-start mt-5 md:mt-3">
                <div class="mt-10 w-full">
                    <password-input id="current_password"
                                    v-model="form.current_password"
                                    :required="true"
                                    :class-error="
                                        form.errors.get('current_password')
                                        || passwordsDidntChange
                                    "
                                    :error-message="form.errors.get('current_password')"
                    >
                        Contraseña Actual
                    </password-input>
                </div>

                <div class="mt-10 w-full">
                    <password-input id="password"
                                    v-model="form.password"
                                    :required="true"
                                    :class-error="
                                        form.errors.get('password')
                                        || passwordsDontMatch
                                        || passwordsDidntChange
                                    "
                                    :error-message="form.errors.get('password')"
                    >
                        Nueva Contraseña
                    </password-input>
                </div>

                <div class="mt-10 w-full">
                    <password-input id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    :required="true"
                                    :class-error="
                                        form.errors.get('password_confirmation')
                                        || passwordsDontMatch
                                        || passwordsDidntChange
                                    "
                                    :error-message="form.errors.get('password_confirmation')"
                    >
                        Confirmar Contraseña
                    </password-input>
                </div>

                <span class="absolute bottom-16 text-green-800 text-xs font-light" v-if="successMessage">{{ successMessage }}</span>

                <span class="absolute bottom-16 text-red-500 text-xs font-light"
                      v-if="passwordsDontMatch || passwordsDidntChange"
                >
                    {{ passwordsDontMatchError || passwordsDidntChangeError }}
                </span>

                <div class="mt-5 md:mt-14 pb-4">
                    <button class="text-center text-sm px-8 rounded-full py-3 bg-indigo-500 text-white hover:bg-indigo-600 transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                            :disabled="isNotSubmitable"
                    >
                        Actualizar
                    </button>
                </div>
            </div>

        </div>
    </form>
</template>

<script>
import {Form} from "../../form";
import PasswordInput from "./PasswordInput";

export default {
    name: "UpdateUserPassword.vue",
    components: {
        PasswordInput
    },
    data() {
        return {
            successMessage: '',
            form: new Form({
                current_password: '',
                password: '',
                password_confirmation: '',
            })
        }
    },
    methods: {
        async onSubmit() {
            try {
                if (this.isNotSubmitable) return;
                this.isLoading = true;

                await this.form.submit('put', '/user/password');

                this.form.reset();
                this.successMessage = 'Contraseña actualizada.';

                setTimeout(() => {
                    this.successMessage = '';
                }, 5000);

            } catch (error) {
                console.log(error);
            }
            this.isLoading = false;
        }
    },
    computed: {
        passwordsDontMatch() {
            return this.form.password !== this.form.password_confirmation;
        },
        passwordsDidntChange() {
            return (
                    this.form.current_password === this.form.password
                    && this.form.password === this.form.password_confirmation
                )
                && this.form.password_confirmation !== '';
        },
        areInputsEmpty() {
            return this.form.current_password === ''
                || this.form.password === ''
                || this.form.password_confirmation === '';
        },
        anyInputFilled() {
            return this.form.current_password !== ''
                || this.form.password !== ''
                || this.form.password_confirmation !== '';
        },
        isNotSubmitable() {
            return this.passwordsDontMatch
                || this.form.errors.any()
                || this.areInputsEmpty
                || this.passwordsDidntChange;
        },
        passwordsDontMatchError() {
            return this.passwordsDontMatch
                ? 'Las contraseñas no coinciden.'
                : '';
        },
        passwordsDidntChangeError() {
            return this.passwordsDidntChange
                ? 'Las contraseñas son iguales.'
                : '';
        }

    },
}
</script>

<style scoped>

</style>
