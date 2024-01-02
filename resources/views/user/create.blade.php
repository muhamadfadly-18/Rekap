@extends('layouts.template')

@section('content')
<form action="{{route('user.store')}}" class="card bg-light border-primary mt-3 p-5" method="POST">
    @if (Session::get('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        
    @endif
 
    @csrf
<div class="mb-3 row">
    <label for="name" class="col-sm-2 col-form-label" @error('name')@enderror>Nama</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="name" name="name" value="{{old('name') }}">
      @error('name')
          <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
<div class="mb-3 row">
    <label for="email" class="col-sm-2 col-form-label" @error('email')@enderror>email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="email" name="email" value="{{old('email') }}">
      @error('email')
          <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
   <div class="mb-3 row">
    <label for="type" class="col-sm-2 col-form-label" @error('type')@enderror>role</label>
    <div class="col-sm-10">
      <select name="role" id="role" class="form-control">
        <option selected disabled hidden>--Pilih penguna--</option>
        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>admin</option>
        <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>guru</option>
    </select>    
      @error('role')
          <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
 
        <button type="submit" class="btn btn-primary">kirim data</button>
        
</form>

<div class="kembali">
  <!-- Tombol kembali yang mengarah ke halaman indeks pengguna -->
  <a href="{{ route('user.index') }}" class="btn btn-secondary" style="margin-top: 30px">Kembali</a>
</div>
@endsection