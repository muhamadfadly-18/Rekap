@extends('layouts.template')

@section('content')
<form action="{{ route('admin.student.store') }}" class="card bg-light border-primary mt-3 p-5" method="POST">
    @csrf
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <div class="mb-3 row">
        <label for="nis" class="col-sm-2 col-form-label" @error('nis')@enderror>NIS</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nis" name="nis" value="{{ old('nis') }}">
            @error('nis')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label" @error('name')@enderror>Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

<div class="mb-3 row">
    <label for="rombel_id" class="col-sm-2 col-form-label" @error('rombel_id')@enderror>rombel</label>
    <div class="col-sm-10">
        <select name="rombel_id" id="rombel_id" class="form-control">
            <option value="reombel_id" selected disabled hidden>-- Pilih Rombel --</option>
            @foreach ($rombels as $rombel)
                <option value="{{ $rombel->id }}">{{ $rombel['rombel'] }}</option>
            @endforeach
        </select>
        @error('rombel_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>


<div class="mb-3 row">
    <label for="rayon_id" class="col-sm-2 col-form-label" @error('rayon_id')@enderror>Rayon</label>
    <div class="col-sm-10">
        <select name="rayon_id" id="rayon_id" class="form-control">
            <option selected disabled hidden>-- Pilih Rayon --</option>
            @foreach ($rayons as $rayon)
                <option value="{{ $rayon->id }}">{{ $rayon['rayon'] }}</option>
            @endforeach
        </select>
        @error('rayon_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>



    <button type="submit" class="btn btn-primary">Kirim Data</button>
</form>
@endsection
