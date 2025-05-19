@extends('layouts.backend')
@section('title', translate('title.Add new customer'))
@section('content')
    <x-container title="Add new customer" buttonTitle="Back to list" buttonRoute="{{ route('customer.index') }}">
        <form action="{{ route('customer.store') }}" method="post" class="row">
            @csrf
   
    <label for="name">Name <span class="text-danger">*</span></label>
    <x-form.input
        name="name"
        value="{{ @old('name') }}"
        col="col-md-6">
    </x-form.input>

    
    <label for="Email">Email <span class="text-danger">*</span></label>
            <x-form.input
                    name="email"
                    value="{{ @old('email') }}"
                    col="col-md-6">
            </x-form.input>
    <label for="Phone">Phone <span class="text-danger">*</span></label>
            <x-form.input
                    name="phone"
                    value="{{ @old('phone') }}"
                    col="col-md-6">
            </x-form.input>
            <x-form.input
                    type="number"
                    name="due"
                    label="Due"
                    value="{{ @old('due') }}"
                    col="col-md-6">
            </x-form.input>
            <x-form.textarea
                    name="address"
                    label="Address"
                    value="{{ @old('address') }}"
                    col="col-md-12">
            </x-form.textarea>
            <x-form.button></x-form.button>
        </form>
    </x-container>
@endsection

@section('custom-js')

<!-- Automatically open modal if total_cash_in_hand == 0 -->
<script>
    $(document).ready(function() {
        @if($total_cash_in_hand == 0)
            $('#stockmodal').modal('show');
        @endif
    });
</script>
    <!-- Modal for total_cash_in_hand == 0 -->
    @if($total_cash_in_hand == 0)
        <div id="stockmodal" class="modal fade" role="dialog" aria-modal="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
            <h4 class="modal-title w-100 text-center position-relative">
             {{ translate('common.action required') }}
            </h4>
            <button type="button" class="close btn btn-sm btn-light position-absolute" style="top: 10px; right: 10px;" data-bs-dismiss="modal">×</button>
            </div>
                    <div class="modal-body d-flex justify-content-center align-items-center" style="height: 100px;">
                        <p class="text-center">Please fill up the payment method</p>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                    <input type="hidden" name="is_modal_shown" id="is_modal_shown">
                    <a href="{{ route('payment.method') }}" class="btn btn-primary">Payment Method</a>
                </div>
                </div>
            </div>
        </div>
    @endif
   
@endsection