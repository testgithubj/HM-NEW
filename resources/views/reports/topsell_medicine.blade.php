@extends('layouts.app')
@section('title', translate('common.customer_list'))
@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        .custom-button {
            color: #000000 !important;
            background-color: #f0f0f0 !important;
            border-color: #000000 !important;
            border-radius: 4px;
            padding: 4px 20px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            margin-left: 10px;
            margin-top: 15px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .custom-button:hover {
            background-color: #000000 !important;
            color: #ffffff !important;
            border-color: #000000 !important;
        }
    </style>
@endsection

@section('content')
    <section class="app-user-list">
        <div class="card">
            <div class="card-body border-bottom">
                <h4 class="card-title">{{ translate('Top sell medicine list') }}</h4>
                <div class="row">
                    <div class="col-md-4 user_role"></div>
                    <div class="col-md-4 user_plan"></div>
                    <div class="col-md-4 user_status"></div>
                </div>
            </div>

            <div class="row px-2">
                <div class="col-lg-3">
                    <form method="get">
                        <div class="col-md-12 user_role">
                            <!-- <label class="form-label" for="UserRole">{{ translate('common.from_date') }}</label> -->
                            <input value="@php echo $from_date @endphp  - @php echo $to_date @endphp" type="text"
                                name="date" id="reportrange"
                                class="form-control invoice-edit-input date-picker flatpickr-input">
                        </div>
                    </form>
                </div>

            </div>
            <div class="mx-2 card-datatable table-responsive pt-0">
            <table class="topsell_medicine table table-bordered border-dark" id="topsell_medicine">
                <thead class="table-light">
                    <tr>
                        <th>{{ translate('common.sn') }}</th>
                        <th>Medicine</th>
                        <th>Sell</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medicines as $medicine)
                        <tr>
                            <td> {{ $loop->iteration }} </td>
                            <td> {{ $medicine['name'] }} </td>
                            <td> {{ $medicine['total_sale'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
        </div>
        <div class="mt-3 d-flex justify-content-center">
        {{ $sells->links() }}
        </div>
        </div>
    </section>
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

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    @php
        $date = date('Y-m-d', strtotime('-7 day', time()));
    @endphp
    <!-- END: Page Vendor JS-->



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
     <script type="text/javascript">
        $(document).ready(function () {
            // Initialize the DataTable with buttons
            var table = $('#topsell_medicine').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        className: 'custom-button'
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'custom-button'
                    },
                    {
                        extend: 'csvHtml5',
                        className: 'custom-button'
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'custom-button'
                    }
                ],
                responsive: true,
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                language: {
                    search: "{{ translate('Search:') }}",
                    lengthMenu: "{{ translate('Display _MENU_ records per page') }}",
                    zeroRecords: "{{ translate('No data found') }}",
                    info: "{{ translate('Showing _PAGE_ of _PAGES_') }}",
                    infoEmpty: "{{ translate('No records available') }}",
                    infoFiltered: "{{ translate('(filtered from _MAX_ total records)') }}"
                }
            });
        });

        </script>
@endsection


