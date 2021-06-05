<x-layout header="false" footer="false">
    <x-slot name="head">
        <title>Workflow | Mi Perfil</title>
    </x-slot>
<section class="w-full bg-gray-100 h-full flex">
    <aside class="w-1/6 bg-white shadow-md rounded-r-md fixed left-0 top-0 h-screen">
        <nav class="flex flex-col justify-start items-start h-full space-y-6 p-6">

            <img class="h-10 w-auto mt-8 mb-2" src="/images/workflow-logo-inverse.svg" alt="Workflow Logo">

            <div class="w-full hover:bg-gray-100 text-gray-400 hover:text-gray-500 cursor-pointer">
               <router-link class="flex justify-start items-center pl-4 py-4 rounded-lg "
                            to="/user"
                            active-class="is-dashboard-active"
                            exact
               >
                   <x-icon.board></x-icon.board>
                   <span class="pl-3 text-sm">Dashboard</span>
               </router-link>
            </div>

            <div class="w-full hover:bg-gray-100 text-gray-400 hover:text-gray-500 cursor-pointer rounded-lg">
                <router-link class="block flex justify-start items-center pl-4 py-4 rounded-lg"
                             to="/user/profile"
                             active-class="is-dashboard-active"
                >
                    <x-icon.user></x-icon.user>
                    <span class="pl-3 text-sm">Mi Perfil</span>
                </router-link>
            </div>

        </nav>
    </aside>

    <div class="flex-1 ml-72">
        <keep-alive>
            <router-view></router-view>
        </keep-alive>
    </div>
</section>

</x-layout>
