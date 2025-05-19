@extends('layouts.app')
@section('title', translate('Returned Medicine'))
@section('content')
    @php
        $i = 0;
        $medicines = json_decode($inv->medicines, true); // Decode medicines from the invoice
    @endphp
    <section id="basic-horizontal-layouts">
        <section id="multiple-column-form">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ translate('Returned Medicine') }}</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('returned', $inv->id) }}">
                                @csrf
                                @foreach ($medicines as $index => $medicine)
                                    @php
                                        $amount = $medicine['price'] * $medicine['quantity'];
                                    @endphp
                                    <div class="medicine-return-form mb-3">
                                        <div class="row">
                                            <!-- Medicine Name -->
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="medicine-{{ $index }}">
                                                        {{ translate('Medicine Name') }}
                                                    </label>
                                                    <input type="text" class="form-control" value="{{ $medicine['name'] }} ({{ $medicine['quantity'] }} PC) - {{ priceFormat($amount) }}" disabled>
                                                    <input type="hidden" name="medicines[{{ $index }}][batch_id]" value="{{ $medicine['batch_id'] }}">
                                                </div>
                                            </div>

                                            <!-- Quantity to Return -->
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="qty-{{ $index }}">
                                                        {{ translate('Quantity') }}
                                                    </label>
                                                    <input type="number" id="qty-{{ $index }}" name="medicines[{{ $index }}][qty]" class="form-control" required min="1" max="{{ $medicine['quantity'] }}">
                                                    @error('medicines.'.$index.'.qty')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach

                                <!-- Submit Button -->
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                            {{ translate('Return Medicines') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
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
                    <div class="modal-footer">
                        <input type="hidden" name="is_modal_shown" id="is_modal_shown">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
