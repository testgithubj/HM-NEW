@extends('layouts.app')
@section('title', translate('common.stock_out'))
@section('custom-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
@endsection
@section('content')
    <section class="app-user-list">
        <div class="card">
            <div class="card-body border-0">
                <h4 class="card-title">{{ translate('Emergency Stock') }}</h4>
            </div>
            <div class="mx-2 card-datatable table-responsive pt-0">
                <table class="user-list-table table table-bordered border-dark">
                    <thead class="table-light">
                        <tr>
                            <th>{{ translate('common.sn') }}</th>
                            <th>{{ translate('common.name') }}</th>
                            <th>{{ translate('common.supplier') }}</th>
                            <th>{{ translate('common.batch') }}</th>
                            <th>{{ __('COST') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Total') }}</th>
                            @if (Auth::user()->shop_id == 79)
                                <th>Update Price
                            @endif
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in"></div>
    </section>
@endsection

@section('custom-js')


    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>

    <!-- END: Page Vendor JS-->
    <script>
        $(function() {

            var table = $('.user-list-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('instock') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'supplier',
                        name: 'supplier',
                        searchable: true
                    },

                    {
                        data: 'batch',
                        name: 'batch'
                    },
                    {
                        data: 'cost',
                        name: 'cost'
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    @if (Auth::user()->shop_id == 79)
                        {
                            data: 'action',
                            name: 'action'
                        },
                    @endif
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });

        });
    </script>
@endsection
