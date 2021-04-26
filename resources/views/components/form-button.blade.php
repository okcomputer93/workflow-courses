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
    <div class="{{ $class }}">
        <button
            type="submit"
        >
            {{ $slot }}
        </button>
    </div>
</form>
