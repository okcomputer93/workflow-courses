<x-layout header="false" footer="false">
    <x-slot name="head">
        <title>Workflow | Mi Perfil</title>
    </x-slot>
<section class="w-full bg-gray-100 h-screen flex">
    <aside class="w-1/6 bg-white shadow-md rounded-r-md h-full">
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

            <div class="w-full hover:bg-gray-100 text-gray-400 hover:text-gray-500 cursor-pointer">
                <router-link class="flex justify-start items-center pl-4 py-4 rounded-lg "
                             to="/user/profile"
                             active-class="is-dashboard-active"
                >
                    <x-icon.user></x-icon.user>
                    <span class="pl-3 text-sm">Mi Perfil</span>
                </router-link>
            </div>

            <div class="w-full hover:bg-gray-100 text-gray-400 hover:text-gray-500 cursor-pointer">
                <router-link class="flex justify-start items-center pl-4 py-4 rounded-lg "
                             to="/user/my-courses"
                             active-class="is-dashboard-active"
                >
                    <x-icon.collection></x-icon.collection>
                    <span class="pl-3 text-sm">Mis Cursos</span>
                </router-link>
            </div>

            @if (auth()->user()->role->name() === 'Professor')
                <div class="w-full hover:bg-gray-100 text-gray-400 hover:text-gray-500 cursor-pointer">
                    <router-link class="flex justify-start items-center pl-4 py-4 rounded-lg "
                                 to="/user/uploaded-courses"
                                 active-class="is-dashboard-active"
                    >
                        <x-icon.cloud-upload></x-icon.cloud-upload>
                        <span class="pl-3 text-sm">Cursos Publicados</span>
                    </router-link>
                </div>
            @endif
        </nav>
    </aside>

    <div class="w-5/6">
        <h1>Hello</h1>
        <router-view></router-view>
    </div>
</section>

</x-layout>
