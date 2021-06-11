<template>
    <div class="relative">
        <img class="rounded-full h-44 w-44 ring-4 ring-indigo-500"
             :src="image"
             :alt="alt"
        >
       <transition name="rotate">
           <div class="absolute top-2 left-3"
                title="Remover avatar"
                v-if="newAvatar"
           >
               <button class="w-8 h-8 p-2 rounded-full bg-white ring-2 ring-indigo-500 border border-gray-200 focus:outline-black"
                       type="button"
                       @click="removeImage"
               >
                   <svg xmlns="http://www.w3.org/2000/svg" class="text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                   </svg>
               </button>
           </div>
       </transition>
        <div class="absolute bottom-0 right-0"
             title="Agregar un avatar"
        >
            <button class="w-10 h-10 border-2 p-2 rounded-full bg-indigo-600 border-gray-200 ring-2 ring-indigo-500 focus:outline-black"
                    type="button"
                    @click="selectImage"
            >
                <img class="w-5 h-5" src="/images/pencil.svg"
                     alt="edit icon"
                >
            </button>
        </div>
        <input type="file"
               accept="image/*"
               ref="fileInput"
               aria-hidden="true"
               @input="showImage"
               hidden
        >
    </div>
</template>

<script>
export default {
    name: "UpdateImage.vue",
    props: ['value', 'alt', 'default'],
    data() {
        return {
            newAvatar: null
        }
    },
    computed: {
        image() {
            return this.newAvatar ?? this.defaultImage;
        },
        defaultImage() {
            // default prop is received after component is mounted /undefined
            return this.default ? `/${this.default}` : this.default;
        }
    },
    methods: {
        selectImage() {
            this.$refs.fileInput.click();
        },
        showImage() {
            const input = this.$refs.fileInput;
            const file = input.files;
            if (file && file[0]) {
                const reader = new FileReader;
                reader.onload = (e) => {
                    this.newAvatar = e.target.result;
                }
                reader.readAsDataURL(file[0]);
                this.$emit('input', file[0]);
            }
        },
        removeImage() {
            this.newAvatar = null;
            this.$emit('input', null);
        }
    }
}
</script>

<style scoped>
.rotate-leave-active {
    transition: all 0.5s;
}

.rotate-leave-to {
    transform: rotate(-180deg);
    opacity: 0;
}
</style>
