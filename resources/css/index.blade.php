@extends('layouts.template')

@section('content')
<br>
@if (Session::get('deleted'))
    <div class="alert alert-success">Data berhasil dihapus</div>
@endif

<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="#">Active</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link</a>
 </li>

</ul>



<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a href="{{ route('lates.create') }}" class="btn btn-primary me-md-2">Tambah Data</a>
</div>

<table class="table table-bordered table-striped mt-3">
    <thead>
        <tr class="text-center">
            <th>No</th>
            <th>Tanggal</th>
            <th>Informasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($lates as $item)
            <tr class="text-center">
                <td>{{ $no++ }}</td>
                <td>{{ $item->date_time }}</td>
                <td>{{ $item->information }}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{ route('lates.edit', $item->id) }}" class="btn btn-primary me-2">Edit</a>
                    <form action="{{ route('lates.delete', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">Delete</button>
                        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
                            <!-- ... your modal content ... -->
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
