@extends('layouts.app')
@section('title', 'Ecommerce Settings')

@section('content')
    <!-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h4 class="card-title mb-0">{{ translate('common.Export & Import') }}</h4>
                </div> -->
                <x-container title="Export & Import">
                <!-- <div class="table-responsive pt-0"> -->
                <!-- <div class="card-body">
                    <div class="col-lg-12">
                        <div class="card border-warning"> -->
                            <!-- <div class="card-body"> -->
                                <div class="row">
                                    <div class="col-lg-4 border-right">
                                        <h4>{{ translate('common.Product CSV Uploder') }}</h4>
                                        <form action="{{ route('medicines.import.process') }}" id="contentForm"
                                            enctype="multipart/form-data" method="post">
                                            @csrf
                                            <div class="mt-2">
                                                <input type="file" name="medicines" accept="text/csv">
                                                <button type="submit" class="btn btn-success mt-2 w-100">
                                                    <i class="fas fa-cloud-upload"></i>{{ translate('common.Upload Now') }}
                                                </button>
                                                @error('medicines')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-8">
                                        <h6>{{ translate('common.Important Notes:') }}</h6>
                                        <ol>
                                            <li>{{ translate('common.Click here to') }} <code><a download="medicines"
                                                        href="{{ asset('medicine_sample.csv') }}"><i
                                                            class="fas fa-download"></i>
                                                        {{ translate('common.Download Sample') }}
                                                        {{ translate('common.CSV') }}</a></code></li>
                                            <li>{{ translate('common.The sample') }}
                                                <code>{{ translate('common.CSV') }}</code>
                                                {{ translate('common.file will download to your computer') }}.</li>
                                            <li>
                                                {{ translate('common.Open the downloaded') }}
                                                <code>{{ translate('common.CSV') }}</code>{{ translate('common.file in a spreadsheet program (such as Microsoft Excel or Google Sheets) to view its format') }}
                                                .
                                            </li>
                                            <li>{{ translate('common.Upload or list your product data and upload the file') }}.
                                            </li>
                                            <li>{{ translate('common.The uploaded file extension must be') }}<code>.{{ translate('common.csv') }}</code>
                                            </li>
                                            <p class="mt-1"><b>{{ translate('common.Notes') }}:
                                                </b>{{ __('Before uploading your medicine list you need
                                                                                                to know Supplier’s id, Unit’s id, leaf’s id to put into
                                                                                                main CSV file to upload perfectly. Please click bellow and download
                                                                                                following CSV files to know your existing ids') }}
                                            </p>

                                            <li>{{ __('Click here to') }} <code><a
                                                        href="{{ route('medicines.csv.exporter', 'categories') }}"><i
                                                            class="fas fa-download"></i>
                                                        {{ translate('common.Download Categories CSV') }} </a></code>
                                            </li>
                                            <li>{{ __('Click here to') }} <code>
                                                    <a href="{{ route('medicines.csv.exporter', 'suppliers') }}">
                                                        <i class="fas fa-download"></i>
                                                        {{ translate('common.Download Suppliers CSV') }}</a>
                                                </code>
                                            </li>

                                            <li>{{ __('Click here to') }} <code><a
                                                        href="{{ route('medicines.csv.exporter', 'units') }}"><i
                                                            class="fas fa-download"></i>
                                                        {{ translate('common.Download Units CSV') }}</a></code></li>
                                            <li>{{ __('Click here to') }} <code>
                                                    <a href="{{ route('medicines.csv.exporter', 'leaves') }}"><i
                                                            class="fas fa-download"></i>{{ translate('common.Download Leaf CSV') }}
                                                    </a></code>
                                            </li>
                                            <li>{{ __('Click here to') }} <code>
                                                    <a href="{{ route('medicines.csv.exporter', 'types') }}"><i
                                                            class="fas fa-download"></i>{{ translate('common.Download Types CSV') }}
                                                    </a></code>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                                </div>
                </x-container>

            <!-- </div>
        </div>
    </div> -->
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
