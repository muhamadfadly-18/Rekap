@extends('layouts.template')

@section('content')
<br>
@if (Session::get('deleted'))
        <div class="alert alert-success">data berhasil di hapus</div>
        
@endif


<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a href="{{route('user.create')}}" class="btn btn-primary me-md-2">Tambah User</a>
</div>
<table class="table table-bordered table-striped mt-3">
    <thead>
        <tr class="text-center">
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($user as $item)
        <tr class="text-center">
            <td>{{ $no++ }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['email'] }}</td>
            <td>{{ $item['role'] }}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{route('user.edit', $item['id'])}}" class="btn btn-primary me-2">Edit</a>
                    
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

