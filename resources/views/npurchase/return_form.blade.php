@extends('layouts.app')
@section('title', __('Return History'))
@section('custom-css')
    <style>
        .table> :not(caption)>*>* {
            padding: 4px 6px !important;
        }
        .medicine-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .medicine-info {
            flex: 1;
        }
        .medicine-qty {
            width: 100px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h4 class="card-title mb-0">{{ translate('Return Medicine') }}</h4>
                    <a href="{{ route('purchase.index') }}" class="btn btn-primary">{{ translate('common.Back') }}</a>
                </div>
                <div class="card-body">
                    <form class="form" method="POST" action="{{ route('purchase.return.process', $inv->id) }}">
                        @csrf
                        <div class="row">
                            @foreach ($medicines as $batch)
                                <div class="col-md-12 col-12">
                                    <div class="medicine-row">
                                        <!-- Medicine Info -->
                                        <div class="medicine-info">
                                            
                                            <strong>{{ $batch->medicine->name }} ({{ $batch->qty }} PC)</strong> - 
                                            {{ priceFormat($batch->buy_price * $batch->qty) }}
                                        </div>

                                        <!-- Quantity Input -->
                                        <div class="medicine-qty">
                                            <h4>quantity</h4>
                                            <input type="number" name="medicines[{{ $loop->index }}][qty]" class="form-control" value="0" min="0" max="{{ $batch->qty }}" required>
                                            <input type="hidden" name="medicines[{{ $loop->index }}][medicine]" value="{{ $batch->medicine_id }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">{{ translate('common.submit') }}</button>
                                <button type="reset" class="btn btn-outline-secondary waves-effect">{{ translate('common.reset') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')

@endsection
