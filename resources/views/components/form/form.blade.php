{{-- Every element of the form MUST HAVE ONLY ONE root element, so the space works correctly --}}
@props([
    'method' => 'POST',
    'action' => '',
    'class' => '',
    'logo' => 'true',
    'enctype' => 'false'
])

<div {{ $attributes->merge(['class' => 'max-w-md sm:h-full w-full space-y-4 bg-white p-6 py-16 sm:p-10 rounded-md shadow-md sm:space-y-8 ' .  $class]) }}>
   <div>
       <div>
           @if($logo === 'true')
               <img class="mx-auto h-12 w-auto" src="/images/workflow-mark.svg" alt="Workflow">
           @endif

           <h2 class="mt-6 text-center text-2xl sm:text-3xl font-extrabold text-gray-900">
               {{ $title }}
           </h2>
       </div>
       <form class="mt-8" action="{{ $action }}"
             method="{{ ucwords($method) === 'GET' ? 'GET' : 'POST'  }}"
             @if ($enctype !== 'false')
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
