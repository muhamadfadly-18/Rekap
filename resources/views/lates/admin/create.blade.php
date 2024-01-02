@extends('layouts.template')

@section('content')
<form action="{{ route('admin.lates.store') }}" class="card bg-light border-primary mt-3 p-5" method="POST" enctype="multipart/form-data">
    @csrf
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <div class="mb-3 row">
        <label for="student_id" class="col-sm-2 col-form-label" @error('student_id')@enderror>siswa</label>
        <div class="col-sm-10">
            <select name="student_id" id="student_id" class="form-control">
                <option selected disabled hidden>pilih</option>
                @foreach ($student as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('student_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="date_time" class="col-sm-2 col-form-label" @error('date_time')@enderror>Tanggal</label>
        <div class="col-sm-10">
            <input type="date" class="form-control" id="date_time" name="date_time" value="{{ old('date_time') }}">
            @error('date_time')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="information" class="col-sm-2 col-form-label" @error('information')@enderror>Keterangan Keterlambatan</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="information" name="information" value="{{ old('information') }}">
            @error('information')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <div class="input-group mb-3">
            <input type="file" class="form-control" id="bukti" name="bukti">
            @error('bukti')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Kirim Data</button>
</form>
@endsection
