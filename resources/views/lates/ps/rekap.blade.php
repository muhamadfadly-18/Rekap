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
                    <a href="{{ route('ps.lates.create1') }}" class="btn btn-primary">Tambah Keterlambatan</i></a>
                    <a href="{{ route('ps.lates.export-excel1') }}" class="btn btn-info text-white">excell</i></a>
                </div>
                <form action="{{ route('ps.lates.search1') }}" method="get" class="mt-5">
                    <div class="input-group mb-3" style="max-width: 400px; float:right; margin-top:-80px" >
                        <input type="date" name="search" class="form-control" placeholder="Cari pembelian...">
                        <button type="submit" class="btn btn-primary">Cari</button>
                        <a href="/lates/rekap" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
                
                <table class="table table-bordered table-striped mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Informasi</th>
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
                                <td><a href="{{ route('ps.lates.home1') }}" class="btn btn-primary me-2">Lihat</a></td>
                                <td class="d-flex">
                                    <a href="{{ route('ps.lates.download1', $group->first()['id']) }}" class="btn btn-secondary">Unduh PDF</a>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                <div>
                    
                </div>
            </div>
      
@endsection
