@extends('layouts.backend')
@section('title', "Add new account type")
@section('content')
    <x-container title="Add new account type" buttonTitle="Back" buttonRoute="{{ route('account-types.index') }}">
        <form action="{{route('account-types.store')}}" method="post" class="row">
            @csrf
            @include('accounts.account-type.form')
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
                    <div class="modal-header d-flex justify-content-between">
                        <h4 class="modal-title">{{ translate('common.expired_medicine') }}</h4>
                        <button type="button" class="close btn btn-sm btn-light" data-bs-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body d-flex justify-content-center align-items-center" style="height: 100px;">
                        <p class="text-center">Please fill up the payment method</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="is_modal_shown" id="is_modal_shown">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection