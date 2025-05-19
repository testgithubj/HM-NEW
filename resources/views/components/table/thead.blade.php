@props([
'headers' => [],
])

<thead class="table-light">
<tr>
    <th>#</th>
    @foreach($headers as $header)
        <th>{{ translate('heading.'.$header) }}</th>
    @endforeach
</tr>
</thead>