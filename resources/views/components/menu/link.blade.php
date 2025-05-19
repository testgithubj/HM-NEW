@props([
    'title' => 'title',
    'aclass' => 'title',
    'route' => null,
    'icon' => 'fas fa-circle',
    'activeUrl' => '',
    'spanClass' => '',
])
<li class="{{ active_if_full_match($activeUrl) }}">
    <a class="{{ $aclass }} d-flex align-items-center" href="{{ $route }}">
        <i class="{{ $icon }}"></i>
        <span class="menu-item text-truncate {{ $spanClass }}" data-i18n="List">
            {{ translate('menu.'.$title) }}
        </span>
    </a>
</li>