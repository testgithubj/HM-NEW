@extends('layouts.backend')

@section('title', "Low Stock Medicine")

@section('content')
    <x-container title="Low Stock Medicine">
        <div class="table-responsive pt-0">
            <form action="" class="row mb-2">
                <div class="col-lg-4">
                <input 
                        type="text" 
                        value="{{ request('keyword') }}" 
                        placeholder="Enter keyword" 
                        name="keyword" 
                        class="form-control" 
                        oninput="document.getElementById('live-search-form').submit()">
                </div>
            </form>

            <table class="table">
                <x-table.thead :headers="['Medicine', 'supplier','Expire Date','quantity']"></x-table.thead>
                <tbody>
                    @forelse($collection as $row)
                        @php $batches = $row->batch @endphp
                        @foreach($batches as $batch)
                            <tr>
                                <td>{{ $loop->parent->iteration }}</td> {{-- Use parent loop for numbering --}}
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->supplier->name ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($batch->expire)->format('d-M-Y') }}</td>
                                <td>{{ $batch->qty }}</td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No medicines in low stock  found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="pagination">
                {!! $collection->links() !!}
            </div>
        </div>
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
