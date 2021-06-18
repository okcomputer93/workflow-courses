<x-layout>
    <x-slot name="head">
        <title>Workflow | Home</title>
    </x-slot>
    <x-section type="clean">
        <main class="flex flex-col justify-center items-center md:flex-row md:justify-between md:items-center py-5">
            <div class="flex-1 text-center md:text-left">
                <div class="w-full md:w-4/5">
                    <h2 class="font-bold text-4xl md:text-5xl text-gray-900 leading-tight">
                        <span class="text-indigo-500">Workflow</span> te ayuda a complementar tu carrera
                    </h2>
                    <p class="pt-6 text-xl font-medium text-gray-700">Somos una plataforma con miles de profesionistas creando cursos para mejorar tus habilidades en varias tecnologías:</p>
                    <p class="pt-3 text-base font-bold text-indigo-500">Laravel, TailwindCSS, Javascript, Vue, CSS</p>
                    <x-button class="my-4" href="/register">Comienza</x-button>
                </div>
            </div>
            <div class="w-2/3 md:w-auto flex justify-center items-center md:flex-auto">
                <img class="block" src="/images/header-person.svg" alt="">
            </div>
        </main>
    </x-section>
    <x-section type="base">
        <div class="flex justify-center items-center flex-col py-10 md:py-32">
            <div class="flex flex-col justify-center flex-initial items-center pb-5 md:items-start md:flex-row " >
                <div class="flex flex-col items-center justify-center text-center md:pr-10 md:flex-1">
                    <div class="bg-indigo-500 inline-block rounded-md p-2 mb-4 text-white">
                        <x-icon.lighting-bolt></x-icon.lighting-bolt>
                    </div>
                    <h3 class="text-3xl font-extrabold text-gray-900 pb-4">Enfocados en tu aprendizaje</h3>
                    <p class="text-base font-medium text-gray-700 pb-2">En workflow tú decides qué ruta de aprendizaje seguir, crea tu propia ruta o elige entre las que han creado nuestros profesionistas para ti.</p>
                    <p class="text-base font-medium text-gray-700 pb-2">Las rutas están disponibles de acuerdo a tus intereses e historial de aprendizaje.</p>
                </div>
                <div class="flex flex-col items-center justify-center text-center mt-10 md:mt-0 md:flex-1">
                    <div class="bg-indigo-500 inline-block rounded-md p-2 mb-4 text-white">
                        <x-icon.clipboard></x-icon.clipboard>
                    </div>
                    <h3 class="text-3xl font-extrabold text-gray-900 pb-4">Crea tu perfil</h3>
                    <p class="text-base font-medium text-gray-700">Desde tu perfil puedes llevar el control de tu aprendizaje, revisa los cursos que estás tomando o algunas recomendaciones.</p>
                </div>
            </div>
            <x-button class="my-4 m-auto block text-center" href="/register">Comienza Ahora</x-button>
        </div>

    </x-section>
    <x-section type="clean">
        <div class="py-10 md:py-32">
            <div class="flex flex-col justify-center items-center text-center mb-10">
                <h3 class="font-bold text-3xl text-gray-900">
                    Una <span class="text-indigo-500">plataforma</span> que se preocupa por ti
                </h3>
                <p class="pt-4 placeholder-yellow-600 text-base font-medium text-gray-700">No somos una plataforma como cualquier otra, tenemos un trato especial con nuestros estudiantes.</p>
            </div>
            <div class="grid auto-rows-min grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2 md:grid-rows-2 md:grid-cols-4 md:gap-y-10">
                <div class="flex items-start">
                    <div class="text-green-500">
                        <x-icon.check></x-icon.check>
                    </div>
                    <div class="pl-5">
                        <h4 class="text-gray-800 text-base pb-2">Tu plataforma</h4>
                        <p class="text-gray-500 text-sm">Tú estás en control de tu aprendizaje</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="text-green-500">
                        <x-icon.check></x-icon.check>
                    </div>
                    <div class="pl-5">
                        <h4 class="text-gray-800 text-base pb-2">Rutas de aprendizaje</h4>
                        <p class="text-gray-500 text-sm">Elige una ruta o crea la tuya</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="text-green-500">
                        <x-icon.check></x-icon.check>
                    </div>
                    <div class="pl-5">
                        <h4 class="text-gray-800 text-base pb-2">Desarrolla tus habilidades</h4>
                        <p class="text-gray-500 text-sm">Incrementa tus capacidades con nuestros cursos</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="text-green-500">
                        <x-icon.check></x-icon.check>
                    </div>
                    <div class="pl-5">
                        <h4 class="text-gray-800 text-base pb-2">Notificaciones</h4>
                        <p class="text-gray-500 text-sm">Recibe anuncios de contenido a tu email</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="text-green-500">
                        <x-icon.check></x-icon.check>
                    </div>
                    <div class="pl-5">
                        <h4 class="text-gray-800 text-base pb-2">Fácil de utilizar</h4>
                        <p class="text-gray-500 text-sm">Navega fácilmente por nuestra plataforma</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="text-green-500">
                        <x-icon.check></x-icon.check>
                    </div>
                    <div class="pl-5">
                        <h4 class="text-gray-800 text-base pb-2">Intereses</h4>
                        <p class="text-gray-500 text-sm">Agrega tus tecnologías favoritas para recibir notificaciones sobre estas</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="text-green-500">
                        <x-icon.check></x-icon.check>
                    </div>
                    <div class="pl-5">
                        <h4 class="text-gray-800 text-base pb-2">Repositorios de profesores</h4>
                        <p class="text-gray-500 text-sm">Accede fácilmente al repositores de GitHub de los docentes</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="text-green-500">
                        <x-icon.check></x-icon.check>
                    </div>
                    <div class="pl-5">
                        <h4 class="text-gray-800 text-base pb-2">Repositorios de profesores</h4>
                        <p class="text-gray-500 text-sm">Accede fácilmente al repositores de GitHub de los docentes</p>
                    </div>
                </div>
            </div>
        </div>
    </x-section>
    <x-section type="dark">
        <div class="flex flex-col justify-between items-center py-10 md:flex-row">
            <div class="text-center">
                <h3 class="text-left text-4xl font-extrabold text-white pb-4 text-center md:text-left">Suena bien?</h3>
                <h4 class="text-2xl font-extrabold text-indigo-500">Únete ahora y comienza tu carrera con nosotros</h4>
            </div>
            <x-button class="my-4" href="/register">Comenzar</x-button>
        </div>
    </x-section>
</x-layout>
