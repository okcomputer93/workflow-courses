<div x-data="onScrolling()"
     @scroll.window.passive="toggleButton('{{ $to }}')"
>
    <div class="fixed right-6 bottom-6 z-40"
         x-show="buttonVisible"
         @click="top()"
         x-transition:enter="transition duration-300 transform ease-out"
         x-transition:enter-start="scale-50 opacity-0"
         x-transition:leave="transition duration-300 transform ease-out"
         x-transition:leave-end="scale-50 opacity-0"
    >
        <div class="w-6 h-6 flex justify-center items-center bg-indigo-500 p-8 rounded-full shadow-md cursor-pointer hover:bg-indigo-700 md:p-10">
            <div class="text-white">
                <x-icon.arrow-up></x-icon.arrow-up>
            </div>
        </div>
    </div>
</div>

<script  type="application/javascript">
    function onScrolling() {
        return {
            buttonVisible: false,
            toggleButton(id) {
                const element = document.getElementById(id);
                const searchbarHeight = element.clientHeight;
                this.buttonVisible = element.getBoundingClientRect().top <= searchbarHeight * -1;
            },
            top() {
                window.scroll({
                    top: 0,
                    behavior: "smooth"
                })
            }
        }
    }
</script>
