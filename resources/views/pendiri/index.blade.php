@extends('layouts.dh')

@section('judul')
  <h1 class="h3 mb-4 text-gray-800">Pendiri</h1>
@endsection

@section('konten')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tabel</h6>
  </div>

  <div class="card-body">

    @if (session('status'))
      <div class="alert alert-dark" role="alert">
        {{ session('status') }}
      </div>
    @endif

    <a href="{{ route('get.tambah.pendiri') }}" class="btn btn-dark btn-icon-split">
      <span class="icon text-white-50">
          <i class="fas fa-plus"></i>
      </span>
      <span class="text">Tambah Data</span>
    </a>

    <hr>

    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jenis Kelamin</th>
              <th>Pilihan</th>
            </tr>
        </thead>
          <tbody>
            @foreach($data_pendiri as $pendiri)
              <tr>
                <td>{{ $pendiri->id }}</td>
                <td>{{ $pendiri->Nama }}</td>
                <td>{{ $pendiri->Jenkel }}</td>
                <td class="text-nowrap">
                  <!-- Detail -->
                  <a href="{{ route('get.detail.pendiri', $pendiri->id) }}" class="btn btn-dark mx-2" > 
                    <i class="fa fa-eye"></i>
                  </a>

                  <!-- Ubah -->
                  <a href="{{ route('get.ubah.pendiri', $pendiri->id) }}" class="btn btn-dark mx-2" > 
                    <i class="fa fa-edit"></i>
                  </a>

                  <!-- Delete -->
                  <form hidden action="{{ route('delete.pendiri', $pendiri->id)}}" method="post" id="data-ke-{{ $pendiri->id }}">
                    @csrf
                    @method('DELETE')
                    &nbsp;
                  </form>

                  <button class="btn btn-dark mx-2" onclick="deleteRow( {{ $pendiri->id }} )">
                    <i class="fas fa-trash"></i>
                  </button>

                  
                  &nbsp;

                </td>
              </tr>
            @endforeach
        </tbody>
      </table>
  </div>
  </div>
</div>
@endsection

@push('scripts')
<!-- Add SweetAlert 2 CDN -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Delete Row -->
<script>
  function deleteRow(id) {
    Swal.fire({
      title: 'Apa anda yakin ?',
      text: "Anda tidak dapat mengembalikan data yang telah di hapus",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Batal',
      confirmButtonColor: '#000',
      cancelButtonColor: '#505050',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        $('#data-ke-'+id).submit()
      }
    })
  }
</script>

@endpush