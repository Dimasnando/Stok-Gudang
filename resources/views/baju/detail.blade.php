@extends('layouts.dh')

@section('judul')
  <h1 class="h3 mb-4 text-gray-800">Baju</h1>
@endsection

@section('konten')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Detail</h6>
  </div>

  <div class="card-body">
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif

    <div class="row">
      <div class="col-md text-md-right">
        <h5>Merk :</h5>
      </div>
      <div class="col">
        <label>{{ $detail_baju->Merk }}</label>
      </div>
    </div>

    <div class="row">
      <div class="col-md text-md-right">
        <h5>Ukuran :</h5>
      </div>
      <div class="col">
        <label>{{ $detail_baju->Ukuran }}</label>
      </div>
    </div>

    
    <div class="row">
        <div class="col-md text-md-right">
          <h5>Jumlah :</h5>
        </div>
        <div class="col">
          <label>{{ $detail_baju->Jumlah }}</label>
        </div>
      </div>

    <div class="row">
      <div class="col-md text-md-right">
        <h5>Pendiri :</h5>
      </div>
      <div class="col">
        <label>{{ $detail_baju->pendiri->Nama }}</label>
      </div>
    </div>

  </div>
</div>
@endsection