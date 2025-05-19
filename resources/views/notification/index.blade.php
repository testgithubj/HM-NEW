@extends('layouts.app')
@section('title', translate('common.customer_list'))
@section('content')
    <div class="card border-0 bg-white">
        <div class="card-header bg-transparent mb-0">
            <h3 class="mb-0">{{ translate('Notifications') }}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-items-center">
                    <tbody>
                        @foreach ($collection ?? [] as $row)
                            <tr>
                                <td width="10">
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <a href="{{ route('notification.show', $row->id) }}">
                                        <span
                                            class="{{ $row->seen ? 'text-muted' : 'text-dark' }}">{{ $row->title }}</span>
                                        <p class="text-dark">
                                            {{ $row->description }}
                                        </p>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                {!! $collection->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('custom-js')

@endsection
