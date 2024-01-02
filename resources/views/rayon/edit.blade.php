@extends('layouts.template')

@section('content')
<form action="{{route('rayon.update', $rayon['id'])}}" class="card bg-light mt-3 p-5" method="POST">
    
    @csrf
    @method('PATCH')
    <div class="mb-3 row">
    <label for="rayon" class="col-sm-2 col-form-label" @error('rayon')@enderror>Nama rayon</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="rayon" name="rayon" value="{{ $rayon['rayon'] }}">
      @error('rayon')
          <div class="text-danger">{{ $message}}</div>
      @enderror
    </div>
    <div class="mb-3 row mt-3">
        <label for="user_id" class="col-sm-2 col-form-label" @error('user_id')@enderror>pembingbing siswa</label>
        <div class="col-sm-10">
            <select name="user_id" id="user_id" class="form-control">
                <option selected disabled hidden>pilih</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-primary">kirim data</button>
  </div>
</form>

@endsection