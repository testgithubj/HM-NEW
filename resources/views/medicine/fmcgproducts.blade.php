@extends('layouts.backend')
@section('title', 'Expenses')
@section('custom-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
@endsection
@section('content')

    <x-container title="FMCG Products">
        <div class="table-responsive pt-0">
            <!-- Expenses Table -->
            <table id="expenses-table" class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>{{ translate('common.sn') }}</th>
                        <th>{{ translate('common.qr_code') }}</th>
                        <th>{{ translate('common.medicine_name') }}</th>
                        {{-- <th>{{ translate('common.category') }}</th> --}}
                        <th>{{ translate('common.supplier') }}</th>
                        <th>{{ translate('common.shelf') }}</th>
                        <th>{{ translate('common.price') }}</th>
                        <th>{{ translate('common.buy_price') }}</th>
                        <th>{{ translate('common.medicine_type') }}</th>
                        <th>{{ translate('common.mfg_date') }}</th>
                        <th>{{ translate('common.exp_date') }}</th>
                        <th>{{ translate('common.status') }}</th>
                        <th>{{ translate('common.image') }}</th>
                        <th>{{ translate('common.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fmcgProducts as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->qr_code }}</td>
                            <td>{{ $product->name }}</td>
                            {{-- <td>{{ $product->category->name }}</td>
                            <td>{{ $product->supplier->name }}</td> --}}
                            {{-- <td>{{ optional($product->category)->name }}</td> --}}
                            <td>{{ optional($product->supplier)->name }}</td>
                            <td>{{ $product->shelf }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->buy_price }}</td>
                            <td>{{ $product->product_type }}</td>
                            <td>{{ $product->mfg_date }}</td>
                            <td>{{ $product->exp_date }}</td>
                            <td>{{ $product->status == 1 ? 'Active' : 'Inactive' }}</td>
                            <td>
                                @if (!empty($product->image) && file_exists(public_path('storage/images/medicine/' . $product->image)))
                                    <img src="{{ asset('storage/images/medicine/' . $product->image) }}" width="50"
                                        alt="Medicine Image">
                                @else
                                    <img src="{{ asset('images/employee/4586805.jpg') }}" height="50" width="50"
                                        alt="Default Image">
                                @endif
                            </td>
                            <td class="d-flex gap-1">
                                <x-action.edit route="{{ route('medicine.edit', $product->id) }}"></x-action.edit>
                                <form class="d-inline-block" action="{{ route('medicine.delete', $product->id) }}"
                                    method="POST" class="d-inline-block"
                                    onsubmit="return confirm('{{ translate('common.are_you_sure') }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination Links -->
            <div class="pagination d-flex justify-content-end">
                {!! $fmcgProducts->links() !!}
            </div>
        </div>
    </x-container>

@endsection

<!-- DataTables Initialization Script -->
@section('custom-js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#expenses-table').DataTable({
                searching: true,
                ordering: true,
                paging: false,
                responsive: true,
                language: {
                    search: "{{ translate('common.search') }}",
                    zeroRecords: "{{ translate('common.no_maching_records_found') }}",
                    infoEmpty: "{{ translate('common.no_data_available') }}",
                }
            });
        });
    </script>
@endsection
