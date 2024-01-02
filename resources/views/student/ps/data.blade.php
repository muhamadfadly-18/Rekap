@extends('layouts.template')

@section('content')
<br>

<table class="table table-bordered table-striped mt-3">
    <thead>
        <tr class="text-center">
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Rombel</th>
            <th>Rayon</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
    @foreach ($siswa as $item)
        <tr class="text-center">
            <td>{{ $no++ }}</td>
            <td>{{ $item->nis }}</td>
            <td>{{ $item->name }}</td> 
            <td>{{ $item->rombel->rombel}}</td> 
            <td>{{ $item->rayon->rayon}}</td> 
        </tr>
    @endforeach
    </tbody>
</table>

@endsection
