@extends('layouts.backend')
@section('title', "Add new expense categories")
@section('content')
    <x-container title="Add new expense categories" buttonTitle="Back" buttonRoute="{{ route('expense-categories.index') }}">
        <form action="{{route('expense-categories.store')}}" method="post" class="row">
            @csrf
            <x-form.input
                    :required="true"
                    name="name"
                    label="Name"
                    value="{{ @old('name') }}"
                    col="col-md-6">
            </x-form.input>
            <x-form.select
    :required="true"
    name="status"
    label="Status"
    value="{{ @old('status') }}"
    col="col-md-6">
    <!-- <option value="" disabled selected>Choose</option> -->
    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
        {{ translate('common.Active') }}
    </option>
    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
        {{ translate('common.Inactive') }}
    </option>
</x-form.select>


            <x-form.textarea
                    name="description"
                    label="Description"
                    value="{{ @old('description') }}">
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