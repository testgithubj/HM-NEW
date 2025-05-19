@extends('layouts.app')
@section('title', 'Purchase List')
@section('custom-css')
    <style>
        .table> :not(caption)>*>* {
            padding: 4px 6px !important;
        }
    </style>
     <style>
.custom-button {
    color: #000000 !important;
    background-color: #f0f0f0 !important;
    border-color: #000000 !important;
    border-radius: 4px;
    padding: 5px 10px;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    margin-right: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.custom-button:hover {
    background-color: #000000 !important;
    color: #ffffff !important;
    border-color: #000000 !important;
}
</style>
<link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection



@section('content')
<x-container title="{{ translate('Invoice History') }}">
    <div class="row justify-content-between mb-1">
        <div class="col-lg-2">
            <select name="paginate" onchange="changePagination(this.value)" id="" class="form-select">
                <option value="10" @if (request('paginate') == 10) selected @endif>{{ translate('common.10') }}</option>
                <option value="20" @if (request('paginate') == 20) selected @endif>{{ translate('common.20') }}</option>
                <option value="50" @if (request('paginate') == 50) selected @endif>{{ translate('common.50') }}</option>
                <option value="100" @if (request('paginate') == 100) selected @endif>{{ translate('common.100') }}</option>
                <option value="200" @if (request('paginate') == 200) selected @endif>{{ translate('common.200') }}</option>
            </select>
        </div>
        <div class="col-lg-6">
            <form method="get">
                <div class="col-md-12">
                    <input type="text" name="date" id="reportrange2" value="{{ $from_date }} - {{ $to_date }}" class="form-control date-picker">
                    <input type="hidden" name="from" value="{{ $from_date }}">
                    <input type="hidden" name="to" value="{{ $to_date }}">
                </div>
            </form>
        </div>
        <div class="col-lg-4">
            <form method="get">
                <input type="text" id="search-keyword" name="keywords" value="{{ request('keywords', 'INV') }}" placeholder="{{ translate('common.Search by invoice') }}" class="form-control">
            </form>
        </div>
    </div>
    <div class="table-responsive pt-0">
        <table class="table">
            <x-table.thead :headers="['Date', 'Invoice ID', 'Customer', 'Quantity', 'Payment Method', 'Subtotal', 'Discount', 'Total', 'Due', 'Option']"></x-table.thead>
            <tbody>
                @forelse ($invoices as $invoice)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $invoice->date }}</td>
                        <td>{{ $invoice->inv_id }}</td>
                        <td>{{ $invoice->customer ? $invoice->customer->name : 'Walk In Customer' }}</td>
                        <td class="text-center">{{ $invoice->qty }}</td>
                        <td>{{ $invoice->method ? $invoice->method->name : '-' }}</td>
                        <td class="text-center">{{ number_format($invoice->total_price, 2) }}</td>
                        <td class="text-center">{{ number_format($invoice->discount, 2) }}</td>
                        <td class="text-center">{{ number_format($invoice->paid_amount, 2) }}</td>
                        <td class="text-center">{{ number_format($invoice->due_price, 2) }}</td>
                        <td class="d-flex gap-1">
                            <a href="{{ route('invoice.print', $invoice->id) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                            @if ($invoice->qty > 0)
                            <a href="{{ route('returned', $invoice->id) }}" class="btn btn-warning btn-circle">
                                <i class="fa fa-undo"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">
                            <h4 class="py-4">{{ translate('common.No data found') }}</h4>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination -flex justify-content-end">
        {!! $invoices->links() !!}
    </div>
</x-container>
@endsection


@section('custom-js')

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
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        <a href="{{ route('payment.method') }}" class="btn btn-primary">Payment Method</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
        function changePagination(paginate) {
            var nurl = new URL('{{ route('invoice.reports') }}');
            nurl.searchParams.set('paginate', paginate);
            location.href = nurl;
        }


        function searchKeyword(e) {
            e.preventDefault();
            let keyword = $('#search-keyword')
            var nurl = new URL('{{ route('invoice.reports') }}');
            nurl.searchParams.set('keywords', keyword);
            location.href = nurl;
        }
    </script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@php
        $date = date('Y-m-d', strtotime('-7 day', time()));
    @endphp
    <script type="text/javascript">
        $(function() {

            var pvlpaid = $("#total").val();
            console.log(pvlpaid)
            $('#totaldue').html(pvlpaid);
            var start = moment().subtract(29, 'days');
            var end = moment();

            var d = new Date();

            var up = function(start, end) {

                window.location.href = "?from=" + start + "&to=" + end;
            }

            $('input[name="date"]').daterangepicker({
                startDate: start,
                endDate: end,
                format: 'YYYY-MM-DD',
                timePicker: false,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, function(start, end, label) {
                var start2 = start.format("YYYY-MM-DD");
                var end2 = end.format("YYYY-MM-DD");

                window.start = start2;
                window.end = end2;

                up(start2, end2);



            });
        });
    </script>
    
@endsection
