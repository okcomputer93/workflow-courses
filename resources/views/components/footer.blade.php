<footer class="bg-white font-sans py-10">
    <div class="flex flex-col justify-center items-center">
        <div class="flex flex-col items-center sm:flex-row my-3 sm:my-6 mt-3 sm:mt-6">
            {{ $slot }}
        </div>
        <div class="flex my-3 sm:my-6">
            <a href="#">
                <i class="fab fa-facebook fa-lg text-gray-400 px-4 hover:text-indigo-500"></i>
            </a>
            <a href="#">
                <i class="fab fa-instagram fa-lg text-gray-400 px-4 hover:text-indigo-500"></i>
            </a>
            <a href="#">
                <i class="fab fa-twitter fa-lg text-gray-400 px-4 hover:text-indigo-500"></i>
            </a>
            <a href="#">
                <i class="fab fa-github-alt fa-lg text-gray-400 px-4 hover:text-indigo-500"></i>
            </a>
        </div>
        <div>
            <p class="mt-3 text-sm sm:text-base sm:mt-6 text-gray-400 font-normal">&copy; Workflow, Inc, All rights reserved</p>
        </div>
    </div>
</footer>
{{--TODO: Improve the footer look--}}
