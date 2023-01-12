@extends('layouts.dh')

@section('judul')
  <h1 class="h3 mb-4 text-gray-800">Pendiri</h1>
@endsection

@section('konten')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Detail</h6>
  </div>

  <div class="card-body">
    @if (session('status'))
      <div class="alert alert-dark" role="alert">
        {{ session('status') }}
      </div>
    @endif

    <div class="row">
      <div class="col-md text-md-right">
        <h5>Nama :</h5>
      </div>
      <div class="col">
        <label>{{ $detail_pendiri->Nama }}</label>
      </div>
    </div>

    <div class="row">
      <div class="col-md text-md-right">
        <h5>Jenis Kelamin</h5>
      </div>
      <div class="col">
        <label>{{ $detail_pendiri->Jenkel }}</label>
      </div>
    </div>

  </div>
</div>
@endsection