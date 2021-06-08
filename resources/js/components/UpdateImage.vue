<template>
    <div class="relative">
        <img class="rounded-full h-44 w-44 ring-4 ring-indigo-500"
             :src="image"
             :alt="alt"
        >
        <div class="absolute bottom-0 right-0">
            <button class="w-10 h-10 border-2 p-2 rounded-full bg-indigo-600 border-gray-200 ring-2 ring-indigo-500"
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
        }
    }
}
</script>

<style scoped>

</style>
