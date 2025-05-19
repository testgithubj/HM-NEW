@extends('layouts.app')
@section('title', translate('common.customer_list'))
@section('content')
    <div class="card border-0 bg-white">
        <div class="card-header bg-transparent mb-0">
            <h3 class="mb-0">{{ translate('Notification') }}</h3>
            <a href="{{ route('notification.index') }}">
                <i class="ficon" data-feather="corner-down-left"></i> Back
            </a>
        </div>
        <div class="card-body">
            <h4>{{ $notification->title }}</h4>
            <p>
                <span class="text-muted">
                    <i class="ficon" data-feather="user"></i>
                    {{ @$notification->sender->name }}
                </span>
                <span class="ms-2">{{ $notification->created_at }}</span>
            </p>
            <div class="description">
                {!! $notification->description !!}
            </div>
        </div>
    </div>
@endsection

@section('custom-js')

@endsection
