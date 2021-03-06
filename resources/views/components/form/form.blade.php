{{-- Every element of the form MUST HAVE ONLY ONE root element, so the space works correctly --}}
@props([
    'method' => 'POST',
    'action' => '',
    'class' => '',
    'logo' => true,
    'enctype' => false,
    'back' => false,
    'backUrl' => null
])

<div {{ $attributes->merge(['class' => 'max-w-md w-full h-full space-y-4 bg-white p-6 py-16 sm:p-10 rounded-md shadow-md sm:space-y-8 ' .  $class]) }}>
   <div>
       <div>
           @if($back)
               <div class="w-full flex justify-start items-center">
                   <a href="{{ $backUrl ?? url()->previous() }}" class="text-gray-400 transform transition-all duration-300 hover:text-gray-500 hover:scale-110"
                      title="Regresar"
                   >
                       <x-icon.arrow-narrow-left></x-icon.arrow-narrow-left>
                   </a>
               </div>
           @endif
           @if($logo)
              <div class="flex justify-center items-center w-full">
                  <a href="/" title="Home">
                      <img class="h-12 w-auto" src="/images/workflow-mark.svg" alt="Workflow">
                  </a>
              </div>
           @endif

           <h2 class="mt-6 text-center text-2xl sm:text-3xl font-extrabold text-gray-900">
               {{ $title }}
           </h2>
       </div>
       <form class="mt-8" action="{{ $action }}"
             method="{{ ucwords($method) === 'GET' ? 'GET' : 'POST'  }}"
             @if ($enctype)
                 enctype="multipart/form-data"
             @endif
       >
           @csrf
           @if (! in_array($method, ['GET', 'POST']))
               @method($method)
           @endif

           <div class="rounded-md space-y-10 sm:space-y-8">
               {{ $slot }}
           </div>
       </form>
   </div>
</div>
