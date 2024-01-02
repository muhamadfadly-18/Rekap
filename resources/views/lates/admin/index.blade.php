@extends('layouts.template')

@section('content')


        
   
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="simple-tab-0" data-bs-toggle="tab" href="#simple-tabpanel-0" role="tab"
                aria-controls="simple-tabpanel-0" aria-selected="true">Keseluruhan Data</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="simple-tab-1" data-bs-toggle="tab" href="#simple-tabpanel-1" role="tab"
                aria-controls="simple-tabpanel-1" aria-selected="false">Rekapitulasi Data</a>
        </li>
    </ul>
    <div class="tab-content pt-5" id="tab-content">
        <div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
            <div class="">
                <a href="{{ route('admin.lates.create') }}" class="btn btn-primary">Tambah Keterlambatan</i></a>
                <a href="{{ route('admin.lates.export-excel') }}" class="btn btn-info text-white">excell</i></a>
            </div>
            <table class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Informasi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1 @endphp

                    @foreach ($lates as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->student->name }}</td>
                            <td>{{ $item['date_time'] }}</td>
                            <td>{{ $item['information'] }}</td>
                            <td class="d-flex">
                                <a href="{{ route('admin.lates.edit', $item['id']) }}" class="btn btn-primary mr-4">Edit</a>
                                <form action="{{ route('admin.lates.delete', $item['id']) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Hapus Data?');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">
            <table class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Jumlah Keterlambatan</th>
                        <th>Action</th>
                        <td>pdf</td>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1 @endphp
        
                    @foreach ($groupedLates as $nis => $group)
                        @php
                            $total = $group->where('student.nis')->count();
                        @endphp
        
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $nis }}</td>
                            <td>{{ $group->first()->student->name }}</td>
                            <td>{{ $total }}</td>
                            <td><a href="{{ route('admin.lates.home') }}" class="btn btn-primary me-2">Lihat</a></td>
                            <td class="d-flex">
                                <a href="{{ route('admin.lates.download', $group->first()['id']) }}" class="btn btn-secondary">Unduh PDF</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                
            </div>
        </div>
@endsection
