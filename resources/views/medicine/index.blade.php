@extends('layouts.app')
@section('title', translate('common.medicines'))
@section('custom-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
    <style>
        .form-control {
            display: block;
            width: 100%;
            padding: 0.571rem 1rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.45;
            color: rgb(204, 200, 200);
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #d8d6de;
            appearance: none;
            border-radius: 0.357rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
    </style>
@endsection

@section('content')
    <!-- <section class="app-user-list">
                                        <div class="card">
                                            <div class="card-body border-bottom">
                                                <h4 class="card-title">{{ translate('common.medicines') }}</h4>
                                            </div> -->
    <x-container title="medicines">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label for="filter-category">{{ translate('common.category') }}</label>
                    <select id="filter-category" class="form-control">
                        <option value="">{{ translate('common.all') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="filter-supplier">{{ translate('common.supplier') }}</label>
                    <select id="filter-supplier" class="form-control">
                        <option value="">{{ translate('common.all') }}</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="filter-shelf">{{ translate('common.shelf') }}</label>
                    <input type="text" id="filter-shelf" class="form-control"
                        placeholder="{{ translate('common.shelf') }}">
                </div>
            </div>
        </div>
        <div class="table-responsive pt-0">
            <table class="user-list-table table table-bordered border-dark">
                <thead class="x-table">
                    <tr>
                        <th>{{ translate('common.sn') }}</th>
                        <th>{{ translate('common.qr_code') }}</th>
                        <th>{{ translate('common.medicine_name') }}</th>
                        <th>{{ translate('common.generic_name') }}</th>
                        <th>{{ translate('common.supplier') }}</th>
                        <th>{{ translate('common.shelf') }}</th>
                        <th>{{ translate('common.price') }}</th>
                        <th>{{ translate('common.buy_price') }}</th>
                        <th>{{ translate('common.strength') }}</th>
                        <th>{{ translate('common.medicine_type') }}</th>
                        <th>{{ translate('common.mfg_date') }}</th>
                        <th>{{ translate('common.exp_date') }}</th>
                        <th>{{ translate('common.status') }}</th>
                        <th>{{ translate('common.image') }}</th>
                        <th>{{ translate('common.option') }}</th>
                    </tr>
                </thead>
            </table>
        </div>

    </x-container>
@endsection

@section('custom-js')
    <script>
        $(document).ready(function() {
            @if ($total_cash_in_hand == 0)
                $('#stockmodal').modal('show');
            @endif
        });
    </script>
    <!-- Modal for total_cash_in_hand == 0 -->
    @if ($total_cash_in_hand == 0)
        <div id="stockmodal" class="modal fade" role="dialog" aria-modal="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h4 class="modal-title">{{ translate('common.action required') }}</h4>
                        <button type="button" class="close btn btn-sm btn-light" data-bs-dismiss="modal">×</button>
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
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var table = $('.user-list-table').DataTable({
                processing: false,
                serverSide: true,
                ajax: {
                    url: "{{ route('medicine.list') }}",
                    data: function(d) {
                        d.category = $('#filter-category').val();
                        d.supplier = $('#filter-supplier').val();
                        d.shelf = $('#filter-shelf').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'qr_code',
                        name: 'qr_code'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'generic_name',
                        name: 'generic_name'
                    },
                    // {
                    //     data: 'category',
                    //     name: 'category'
                    // }, // Category Column Removed
                    {
                        data: 'supplier',
                        name: 'supplier'
                    },
                    {
                        data: 'shelf',
                        name: 'shelf'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'buy_price',
                        name: 'buy_price'
                    },
                    {
                        data: 'strength',
                        name: 'strength'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'mfg_date',
                        name: 'mfg_date'
                    },
                    {
                        data: 'exp_date',
                        name: 'exp_date'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'picture',
                        name: 'picture',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                dom: 'lfrtip',
            });

            // Apply filters
            $('#filter-category, #filter-supplier, #filter-shelf').on('change keyup', function() {
                table.draw();
            });
        });
    </script>
@endsection
