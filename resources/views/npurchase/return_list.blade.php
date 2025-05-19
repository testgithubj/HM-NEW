@extends('layouts.app')
@section('title', __('Return History'))
@section('custom-css')
<link rel="stylesheet" type="text/css"
          href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <style>
        .table> :not(caption)>*>* {
            padding: 4px 6px !important;
        }
    </style>
@endsection
@section('content')
<x-container title="Return History">
<div class="table-responsive pt-0">
    <table class="table table-bordered my-custom-table">
        <x-table.thead :headers="['date','purchase_id','amount','Quantity','Name','invoice']"></x-table.thead>
        <tbody>
    @foreach($grouped_data as $purchase_id => $returns)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $returns->first()->date }}</td>
            <td>{{ $returns->first()->purchae_id }}</td>
            <td>{{ $returns->sum('amount') }}</td>
            <td>{{ $returns->sum('quantity') }}</td>
            <td>
                <ul>
                    @foreach($returns as $return)
                        @if ($return->batch && $return->batch->medicine)
                            <li>{{ $return->batch->medicine->name }}</li>
                        @else
                            <li>Medicine Not Found</li>
                        @endif
                    @endforeach
                </ul>
            </td>
            <td>
                <a href="{{ route('purchase.return.invoice', $returns->first()->id) }}" class="btn btn-sm btn-primary">
                    {{ translate('Invoice') }}
                </a>
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
        function changePagination(paginate) {
            var nurl = new URL('{{ route('purchase.return') }}');
            nurl.searchParams.set('paginate', paginate);
            location.href = nurl;
        }
        function updateStatus(select, id) {
            // Handle the status update here
        }
    </script>


<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>

    <script>
    $(document).ready(function () {
        // Initialize DataTable for the specific table
        $('.my-custom-table').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            language: {
                emptyTable: "No data found" // Message when no data is available
            }
        });
    });
</script>
   

    

@endsection