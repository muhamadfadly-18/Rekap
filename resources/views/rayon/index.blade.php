@extends('layouts.template')

@section('content')
<br>
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('deleted'))
    <div class="alert alert-success">Data berhasil dihapus</div>
@endif

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a href="{{ route('rayon.create') }}" class="btn btn-primary me-md-2">Tambahkan</a>
</div>

<table class="table table-bordered table-striped mt-3">
    <thead>
        <tr class="text-center">
            <th>No</th>
            <th>Nama</th>
            <th>Pembimbing</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($rayon as $item)
            <tr class="text-center">
                <td>{{ $no++ }}</td>
                <td>{{ $item['rayon'] }}</td>
                <td>{{$item->user->name}}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{ route('rayon.edit', $item['id']) }}" class="btn btn-primary mr-4">Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
