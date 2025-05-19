@props([
'title' => null,
'icon' => 'fa fa-eye',
'route' => null,
'class' => 'btn btn-sm btn-warning ',
])
<a class="show-button {{ $class }}" href="{{ $route }}">
    @if($title)
        <span>{{ $title }}</span>
    @else
        <i class="{{ $icon }}"></i>
    @endif
</a>