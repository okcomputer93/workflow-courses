@props([
    'method' => 'POST',
    'action' => '',
    'class' => '',
])

<form action="{{ $action }}"
      method="{{ ucwords($method) === 'GET' ? 'GET' : 'POST'  }}"
>
    @csrf
    @if (! in_array($method, ['GET', 'POST']))
        @method($method)
    @endif
    <button class="{{ $class }}"
        type="submit"
    >
        {{ $slot }}
    </button>
</form>
