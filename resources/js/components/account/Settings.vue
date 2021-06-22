<template>
    <div>
        <div v-if="isLoading"
             class="w-full h-screen flex justify-center items-center"
        >
            <loading-spinner></loading-spinner>
        </div>
        <transition name="fade">
            <account-section v-if="!isLoading">
                <template v-slot:title>
                    <h1 class="text-2xl text-center font-bold text-gray-800 sm:text-3xl md:text-5xl md:text-left">
                        Editar tu perfil
                    </h1>
                </template>
                <template v-slot:left>
                    <div class="flex flex-col justify-start items-start px-3 md:px-0">
                        <update-user-form ref="updateUser"
                                          :user="user"
                        ></update-user-form>
                        <update-user-password ref="updatePassword"
                                              class="mt-20"
                        ></update-user-password>
                    </div>
                </template>
            </account-section>
        </transition>

        <modal name="invitation"
               classes="p-10 bg-white flex flex-col justify-center items-center rounded-lg"
               :width="500"
               :height="400"
               :adaptive="true"
        >
            <img class="h-12 w-12" src="/images/workflow-mark.svg" alt="Workflow Logo">

            <h2 class="text-2xl text-center font-bold mt-4">
                <span class="text-indigo-500">Workflow</span> te invita a formar parte como profesor en nuestra
                plataforma
            </h2>
            <h4 class="text-gray-500 text-xl font-light mt-3">Postúlate como candidato</h4>

            <button
                class="text-center text-sm px-8 rounded-full py-3 bg-indigo-500 text-white hover:bg-indigo-600 transition-colors duration-300 focus-within:outline-black mt-2"
                @click="redirectProfessorRegistration()"
            >
                Postularme
            </button>
        </modal>

        <floating-button v-if="!isProfessor"
                         position="right-top"
                         @click="openInvitation()"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
            </svg>
            <span class="ml-2 font-bold text-sm hidden xl:block">
                Sé Profesor
            </span>
        </floating-button>
    </div>
</template>


<script>
import axios from 'axios';
import AccountSection from "./AccountSection";
import UpdateUserForm from "./UpdateUserForm";
import UpdateUserPassword from "./UpdateUserPassword";
import LoadingSpinner from "../core/LoadingSpinner";
import FloatingButton from "../core/FloatingButton";

export default {
    name: 'Settings.vue',
    components: {
        AccountSection,
        UpdateUserForm,
        UpdateUserPassword,
        LoadingSpinner,
        FloatingButton
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
        },
        isProfessor() {
            if (this.user) {
                return this.user.role === 'Professor';
            }
        }
    },
    methods: {
        openInvitation() {
            this.$modal.show('invitation');
        },
        redirectProfessorRegistration() {
            window.location.assign('/user/register-professor');
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
