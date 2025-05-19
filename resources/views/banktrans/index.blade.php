@extends('layouts.backend')

@section('title', "Bank Transactions")

@section('content')
<link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!-- DataTables Styles -->
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">

<x-container title="Bank Transactions" buttonTitle="Add New" buttonRoute="{{ route('banktrans.form') }}">
    <div class="table-responsive pt-0">
    <form method="get">
    <div class="row">
        <div class="col-md-4">
            <label for="date">{{ translate('common.date_range') }}</label>
            <input type="text" name="date" id="reportrange2"
                value="{{ $from_date }} - {{ $to_date }}"
                class="form-control date-picker">
            <input type="hidden" name="from" value="{{ $from_date }}">
            <input type="hidden" name="to" value="{{ $to_date }}">
        </div>
       
        <div class="col-md-4 align-self-end">
            <!-- <button type="submit" class="btn btn-primary">{{ translate('common.filter') }}</button> -->
            <a href="{{ route('banktrans.index') }}" class="btn btn-secondary">{{ translate('common.reset') }}</a>
        </div>
       
    </div>
</form>
<br>

        <!-- Transactions Table -->
        <table id="transactions-table" class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Payment Method</th>
                    <th>Bank</th>
                    <th>Amount</th>
                    <th>Serial Number</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banktrans as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->date }}</td>
                    <td>{{ $transaction->method ? $transaction->method->name : 'N/A' }}</td>
                    <td>{{ $transaction->bank ? $transaction->bank->account_holder_name : 'N/A' }}</td>
                    <td>{{ number_format($transaction->amount, 2) }}</td>
                    <td>{{ $transaction->serialnumber }}</td>
                    <td> <x-action.edit route="{{ route('banktrans.edit', $transaction->id) }}"></x-action.edit>
                    <x-action.delete route="{{ route('banktrans.delete', $transaction->id) }}"></x-action.delete>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
                        <a href="{{ route('payment.method') }}" class="btn btn-primary">Payment Method</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#transactions-table').DataTable({
            responsive: true,
            autoWidth: false,
        });
    });
</script>

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
        $date = date('Y-m-d', strtotime('+1 day', time()));
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

