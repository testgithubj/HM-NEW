@props([
    'method' => 'delete',
    'title' => null,
    'icon' => 'fas fa-trash',
    'route' => null,
    'formClass' => 'delete',
    'class' => 'btn btn-sm btn-danger',
])

<form  onclick="return confirm('Are you sure?')" class="{{ $formClass }}" action="{{ $route  }}" method="POST">
    @method($method)
    @csrf
    <button type="submit" class="delete-button {{ $class  }}">
        @if($title)
            <span>{{ $title }}</span>
        @else
            <i class="{{ $icon }}"></i>
        @endif
    </button>
</form>