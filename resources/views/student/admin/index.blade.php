@extends('layouts.template')

@section('content')
<br>
@if (Session::get('deleted'))
        <div class="alert alert-success">data berhasil di hapus</div>
        
@endif


<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a href="{{route('admin.student.create')}}" class="btn btn-primary me-md-2">Tambah User</a>
</div>
<table class="table table-bordered table-striped mt-3">
    <thead>
        <tr class="text-center">
            <th>No</th>
            <th>NIS</th>
            <th>nama</th>
            <th>rombel</th>
            <th>rayon</th>
           
        </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
    @foreach ($student as $item)
        <tr class="text-center">
            <td>{{ $no++ }}</td>
            <td>{{ $item['nis'] }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item->rombel->rombel }}</td>
            <td>{{ $item->rayon->rayon }}</td>
        </tr>
    @endforeach
</tbody>

</table>
@endsection

