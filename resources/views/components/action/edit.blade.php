@props([
'title' => null,
'icon' => 'fa fa-edit',
'route' => null,
'class' => 'btn btn-sm btn-info',
])
<a class="edit-button {{ $class }}" href="{{ $route }}">
    @if($title)
        <span>{{ $title }}</span>
    @else
        <i class="{{ $icon }}"></i>
    @endif
</a>