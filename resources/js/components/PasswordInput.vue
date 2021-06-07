<template>
   <div>
       <label class="block text-sm font-bold text-gray-400 mb-2"
              :for="id"
       >
           <slot>Label text here.</slot>
       </label>

      <div class="flex justify-center items-center">
          <input class="w-full appearance-none relative block px-3 py-2 border border-gray-300 placeholder-gray-300 text-gray-600 rounded-md focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base"
                 :class="classError ? 'ring-1 ring-red-600' : ''"
                 :type="inputType"
                 :id="id"
                 :required="required"
                 @input="updateInput($event)"
                 :value="value"
          >
          <button class="m-3 border-2 p-1 rounded-lg border-gray-200 bg-gray-100"
                  type="button"
                  @click="toggleType"
          >
              <img class="h-6 w-6"
                   :src="eyeIcon"
                   alt="eye icon"
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
