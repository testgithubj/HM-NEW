@extends('layouts.backend')
@section('title', "Already Expire Medicines")
@section('content')
    <x-container title="Already Expire Medicines">
        <div class="table-responsive pt-0">
            <form action="" class="row mb-2">
                <div class="col-lg-3">
                    <input type="date" value="{{ request('date') }}" name="date" class="form-control">
                </div>
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
                <x-table.thead :headers="['Medicine','Expire On','Action']"></x-table.thead>
                <tbody>
                @foreach($collection as $row)
                    <tr>
                        <td>{{ $row->medicine ? $loop->iteration : '' }}</td>
                        <td>{{ $row->medicine ? @$row->medicine->name : '' }}</td>
                        <!-- <td>{{ $row->name }}</td> -->
                        <td>{{ $row->medicine ? date('F d, Y', strtotime($row->expire)) : '' }}</td>
                        @if($row->medicine)
                <td>
                    <a onclick="return confirm('Are you sure?')" href="{{ route('expired.delete', $row->id) }}" class="badge bg-danger">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            @endif
                    </tr>
                @endforeach
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