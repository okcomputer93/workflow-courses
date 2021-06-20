<template>
    <div class="my-2 flex flex-row-reverse justify-end items-center">
        <button class="h-8 w-8 p-1 focus:outline-none text-gray-500 rounded-full bg-transparent"
                :class="`${starClass} ${readOnlyClass}`"
                type="button"
                v-for="(starClass, index) in starsClasses"
                @click="newRating($event,max - index)"
                :aria-label="`Rating ${max - index} of ${max}`"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" role="img" fill="currentColor" aria-hidden="true">
                <path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path>
            </svg>
        </button>
    </div>
</template>

<script>
export default {
  name: "Rating",
  props: {
    readOnly: Boolean,
    value: Number,
    max: Number,
  },
  emits: ['input'],
  computed: {
      starsClasses() {
          return Array(this.max)
              .fill('')
              .map((_, index) => {
                  if (index <= this.value - 1) return 'text-yellow-400';
                  return '';
              })
              .reverse();
      },
      readOnlyClass() {
          if (!this.readOnly) {
              return 'star cursor-pointer';
          }
          return 'cursor-default';
      }
  },
  methods: {
      animateStar(event) {
          const button = event.target.closest('.star');
          button.animate([
              { backgroundColor: 'transparent' },
              { backgroundColor: 'rgba(238,203,120,0.37)' }
          ], { easing: 'ease-in', duration: 500 });
      },
      newRating(event, value) {
          this.animateStar(event);
          this.$emit('input', value);
      }
  }
}
</script>

<style scoped>
.star:hover,
.star:hover ~ .star {
    color: #fbbf24;
    transition: color 0.3s ease-in;
}

.star--pulse {
    animation: pulse 1s;
}

@keyframes pulse {
    from {
        background-color: transparent;
    }

    to {
        background-color: rebeccapurple;
    }
}

</style>
