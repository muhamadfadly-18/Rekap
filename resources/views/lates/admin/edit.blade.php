@extends('layouts.template')

@section('content')
<form action="{{ route('admin.lates.update', $lates['id']) }}" class="card bg-light mt-3 p-5" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <!-- Field untuk student_id -->
    <div class="mb-3 row">
        <label for="student_id" class="col-sm-2 col-form-label">Nama Siswa</label>
        <div class="col-sm-10">
            <select class="form-control" name="student_id">
                @foreach ($student as $s)
                    <option value="{{ $s->id }}" {{ $s->id == $lates->student_id ? 'selected' : '' }}>
                        {{ $s->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="date_time" class="col-sm-2 col-form-label" @error('date_time')@enderror>Tanggal</label>
        <div class="col-sm-10">
            <input type="date" class="form-control" id="date_time" name="date_time" value="{{ $lates['date_time'] }}">
            @error('date_time')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="information" class="col-sm-2 col-form-label" @error('information')@enderror>Keterangan Keterlambatan</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="information" name="information" value="{{ $lates['information'] }}">
            @error('information')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="bukti" class="col-sm-2 col-form-label" @error('bukti')@enderror>Bukti</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="bukti" name="bukti">
            @error('bukti')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Menampilkan gambar yang sudah ada -->
    @if ($lates['bukti'])
        <img src="{{ asset('uploads/' . $lates['bukti']) }}" alt="Bukti" width="100">
    @endif

    <button type="submit" class="btn btn-primary">Kirim Data</button>
</form>
@endsection
