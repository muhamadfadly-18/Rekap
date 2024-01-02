@extends('layouts.template')

@section('content')
<form action="{{route('user.update', $user['id'])}}" class="card bg-light mt-3 p-5" method="POST">
    
    {{-- token syarat kirim data (agar sistem membaca bahwa data ini berasal dari sumber yang sah ) --}}
    @csrf
    {{--menimpa nilai dari attr method di from , agar sama ka ayang di routenya --}}
    @method('PATCH')
<div class="mb-3 row">
    <label for="name" class="col-sm-2 col-form-label" @error('name')@enderror>Nama</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="name" name="name" value="{{ $user['name'] }}">
      @error('name')
          <div class="text-danger">{{ $message}}</div>
      @enderror
    </div>
  </div>
<div class="mb-3 row">
    <label for="email" class="col-sm-2 col-form-label" @error('email')@enderror>email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="email" name="email" value="{{ $user['email'] }}">
      @error('email')
          <div class="text-danger">{{ $message}}</div>
      @enderror
    </div>
  </div>
  <div class="mb-3 row">
    <label for="type" class="col-sm-2 col-form-label" @error('type')@enderror>role</label>
    <div class="col-sm-10">
      <select name="role" id="role" class="form-control">
        <option selected disabled hidden>--Pilih penguna--</option>
        <option value="admin" {{$user['role'] == 'admin' ? 'selected' : ''}}>admin</option>
        <option value="guru" {{$user['role'] == 'guru' ? 'selected' : ''}}>guru</option>
      </select>
      @error('role')
          <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
  <div class="mb-3 row">
    <label for="password" class="col-sm-2 col-form-label" @error('password')@enderror>password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name="password" value="{{old('password') }}">
      @error('password')
          <div class="text-danger">{{ $message}}</div>
      @enderror
    </div>
  </div>
  <button type="submit" class="btn btn-primary">kirim data</button>
</div>

        
        
</form>
@endsection