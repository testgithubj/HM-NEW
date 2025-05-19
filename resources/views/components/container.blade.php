@props([
'title' => 'Page title',
'buttonRoute' => null,
'buttonTitle' => 'Button title',
])

<section class="page-wrapper">
    <div class="card border-0">
        <div class="card-header bg-transparent">
            <div class="">
                <h3 class="card-title">{{ translate('menu.'.$title) }}</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{ translate('menu.Dashboard') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ translate('menu.'.$title) }}</li>
                    </ol>
                </nav>
            </div>
            @if(isset($buttonRoute))
                <a class="btn btn-primary" href="{{ $buttonRoute }}">{{ $buttonTitle }}</a>
            @endif
        </div>
        <div class="card-body">
            {!! $slot !!}
        </div>
    </div>
</section>