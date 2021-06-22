<template>
    <div>
        <modal name="comment-form"
               classes="p-10 bg-white flex justify-center items-center rounded-lg"
               :width="500"
               :height="400"
               :adaptive="true"
        >
            <form class="flex flex-col justify-start items-center">
                <h2 class="text-2xl text-center font-bold">Cuéntanos sobre tu experiencia</h2>
                <span class="mt-4 inline-block text-sm text-gray-400">Tu calificación:</span>
                <rating :max="5"
                        :read-only="false"
                        v-model="form.rate"
                ></rating>
                <textarea class="border border-gray-400 text-sm focus:outline-black mt-4 p-2 w-full h-32"
                          name="content"
                          id="content"
                          required
                          placeholder="Tu comentario."
                          maxlength="120"
                          v-model="form.content"
                ></textarea>
                <div class="flex justify-between items-center mt-6 w-full">
                    <button class="text-center text-sm px-8 rounded-full py-3 bg-indigo-500 text-white hover:bg-indigo-600 transition-colors duration-300 focus-within:outline-black"
                            type="submit"
                            @click.prevent="submitForm()"
                    >
                        Enviar
                    </button>
                    <button class="text-center text-sm px-6 rounded-full py-2 bg-white text-indigo-500 border border-indigo-500 hover:bg-indigo-100 transition-colors duration-300 focus:outline-black"
                            type="button"
                            @click="hideModal()"
                    >
                        Cancelar
                    </button>
                </div>
            </form>
        </modal>
        <floating-button position="left-bottom"
                         v-if="canAddComments"
                         @click="openModal"
        >
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-6 w-6" fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
            >
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"
                />
            </svg>
            <span class="ml-2 font-bold text-sm hidden md:block">
                    Deja un comentario
                </span>
        </floating-button>
    </div>
</template>

<script>
import Rating from './Rating';
import { Form } from "../../form";
import CommentsEventBus from '../../comments-event-bus';
import FloatingButton from "../core/FloatingButton";
export default {
    name: "AddComment",
    props: {
        canComment: String,
        courseId: Number,
    },
    components: {
        Rating,
        FloatingButton
    },
    data() {
        return {
            commented: false,
            form: new Form({
                content: '',
                rate: 1,
            })
        }
    },
    computed: {
        canAddComments() {
            return this.canComment && !this.commented;
        }
    },
    methods: {
        openModal() {
            this.$modal.show('comment-form');
        },
        hideModal() {
            this.$modal.hide('comment-form');
        },
        async submitForm() {
            if (!this.canAddComments) return;
            this.hideModal()
            const response = await this.form.submit('post', `/api/courses/${this.courseId}/comments`);
            CommentsEventBus.fire('commented', response);
            this.form.reset();
            this.commented = true;
        }
    }
}
</script>

<style scoped>

</style>
