@extends('layouts.dh')

@section('judul')
  <h1 class="h3 mb-4 text-gray-800">Tentang</h1>
@endsection

@section('konten')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
  </div>

  <div class="card-body">
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif
    
    <div class="col-md text-md-center">
      <i>TUGAS AKHIR WEB II</i><br>
    <i>KELOMPOK II</i><br>
    <br>
    <i>Dimas Nando Prayoga 8020200220</i><br>
    <i>Peri Sandiko Saputra 8020200039</i><br>
    <i>Clara Zuliani Syahputri 8020200089</i><br>
    <i>Muhammad Alif Putra Ramadhan 8020200242</i><br>
    <i>Muhammad Fadhil Adriyan 8020190290</i><br>
    <i>Endo Nopandi 8020190191</i><br>
    <br>
    <i>SEKIAN DAN TERIMA KASIH</i>
  </div>
  
  </div>
</div>
@endsection
