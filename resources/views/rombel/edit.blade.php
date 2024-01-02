@extends('layouts.template')

@section('content')
<form action="{{route('rombel.update', $rombel['id'])}}" class="card bg-light mt-3 p-5" method="POST">
    
    @csrf
    @method('PATCH')
    <div class="mb-3 row">
    <label for="rombel" class="col-sm-2 col-form-label" @error('rombel')@enderror>Nama rombel</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="rombel" name="rombel" value="{{ $rombel['rombel'] }}">
      @error('rombel')
          <div class="text-danger">{{ $message}}</div>
      @enderror
    </div>
  
    <button type="submit" class="btn btn-primary mt-5">kirim data</button>
  </div>
</form>

@endsection