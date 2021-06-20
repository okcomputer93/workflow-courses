<template>
   <div>
       <label class="block text-sm font-bold mb-2"
              :class="classError ? 'text-red-500' : 'text-gray-400'"
              :for="id"
       >
           <slot>Label text here.</slot>
       </label>

      <div class="flex justify-center items-center">
          <input class="w-full appearance-none relative block px-3 py-2 border border-gray-300 placeholder-gray-300 text-gray-600 rounded-md focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base"
                 :class="classError ? 'ring-1 ring-red-500' : ''"
                 :type="inputType"
                 :id="id"
                 :required="required"
                 @input="updateInput"
                 :value="value"
          >
          <button class="m-3 w-8 h-8 p-1 rounded-full hover:bg-indigo-200 transition duration-500 focus:outline-none"
                  :title="titleInput"
                  type="button"
                  @click="toggleType"
                  tabindex="-1"
          >
              <img class="h-6 w-6"
                   :src="eyeIcon"
                   alt="show/hide password icon"
              >
          </button>
      </div>
       <span class="text-xs font-light text-red-500 absolute mt-2">{{ errorMessage }}</span>
   </div>
</template>

<script>
export default {
    name: "PasswordInput.vue",
    props: ['id', 'value', 'required', 'classError', 'errorMessage'],
    data() {
      return {
          isPasswordHidden: true
      }
    },
    computed: {
        eyeIcon() {
          return this.isPasswordHidden ? '/images/eye-off.svg' : '/images/eye.svg';
      },
        inputType() {
          return this.isPasswordHidden ? 'password' : 'text';
      },
        titleInput() {
          return `${this.isPasswordHidden ? 'Mostrar' : 'Ocultar'} contraseña`;
        }
    },
    methods: {
        toggleType() {
           this.isPasswordHidden = !this.isPasswordHidden;
        },
        updateInput(event) {
            this.$emit('input', event.target.value);
        }
    }
}
</script>

<style scoped>

</style>
