@extends('layouts.dh')


@section('judul')
  <h1 class="h3 mb-4 text-gray-800">Pendiri</h1>
@endsection

@section('konten')
<div class="card shadow mb-4">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
  </div>

  <div class="card-body">
    @if (session('status'))
      <div class="alert alert-dark" role="alert">
        {{ session('status') }}
      </div>
    @endif

    <form action="{{ route('post.proses-ubah.pendiri', $detail_pendiri->id) }}" method="post">
      @csrf
      @method('PATCH')

      <div class="form-group row">
        <label for="Nama" class="col-sm-2 col-form-label">Nama</label>

        <div class="col-sm-10">
          <input type="text" class="form-control @error('Nama') is-invalid @enderror" name="Nama" value="{{ old('Nama', $detail_pendiri->Nama) }}">

          @error('Nama')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>
        
      </div>

      <div class="form-group row">
        <label for="Jenkel" class="col-sm-2 col-form-label">Jenis Kelamin</label>

        <div class="col-sm-10">
          <input type="text" class="form-control @error('Jenkel') is-invalid @enderror" name="Jenkel" value="{{ old('Jenkel', $detail_pendiri->Jenkel) }}">

          @error('Jenkel')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>
        
      </div>


      <button type="submit" class="btn btn-dark">
        Simpan
      </button>

    </form>
  </div>

</div>
@endsection