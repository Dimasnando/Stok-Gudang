@extends('layouts.dh')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('judul')
  <h1 class="h3 mb-4 text-gray-800">Baju</h1>
@endsection

@section('konten')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Create</h6>
  </div>

  <div class="card-body">
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif
    
    <form action="{{ route('post.proses-tambah.baju') }}" method="post">
      @csrf

      <div class="form-group row">
        <label for="Merk" class="col-sm-2 col-form-label">Merk</label>

        <div class="col-sm-10">
          <input type="text" class="form-control @error('Merk') is-invalid @enderror" name="Merk" value="{{ old('Merk', '') }}">

          @error('Merk')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>
        
      </div>

      <div class="form-group row">
        <label for="Ukuran" class="col-sm-2 col-form-label">Ukuran</label>

        <div class="col-sm-10">
          <input type="text" class="form-control @error('Ukuran') is-invalid @enderror" name="Ukuran" value="{{ old('Ukuran', '') }}">

          @error('Ukuran')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>
        
      </div>
      <div class="form-group row">
        <label for="Jumlah" class="col-sm-2 col-form-label">Jumlah</label>

        <div class="col-sm-10">
          <input type="text" class="form-control @error('Jumlah') is-invalid @enderror" name="Jumlah" value="{{ old('Jumlah', '') }}">

          @error('Jumlah')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>
        
      </div>

      <div class="form-group row">
        <label for="pendiri" class="col-sm-2 col-form-label">Pendiri</label>

        <div class="col-sm-10">
          <select class="pendiri-id form-control custom-select" name="pendiri_ke">
            <option value="">Pilih Opsi</option>
            @foreach($data_pendiri as $pendiri)
              <option value="{{ $pendiri->id }}" {{ old('pendiri_id') == $pendiri->id ? 'selected' : '' }}>{{ $pendiri->Nama }}</option>
            @endforeach
          </select>

          @error('pendiri_ke')
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function() {
    $('.pendiri-id').select2();
  });
</script>
@endpush