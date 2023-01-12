@extends('layouts.dh')

@section('judul')
  <h1 class="h3 mb-4 text-gray-800">Baju</h1>
@endsection

@section('konten')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tabel</h6>
  </div>

  <div class="card-body">

    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif

    <a href="{{ route('get.tambah.baju') }}" class="btn btn-primary btn-icon-split">
      <span class="icon text-white-50">
          <i class="fas fa-plus"></i>
      </span>
      <span class="text">Tambah Data</span>
    </a>

    <hr>

    <!-- Filter -->
    <ul class="nav nav-tabs" id="tabFilter" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="search-tab" data-toggle="tab" data-target="#cari" type="button" role="tab" aria-controls="search" aria-selected="true">Cari</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="sort-tab" data-toggle="tab" data-target="#sort" type="button" role="tab" aria-controls="sort" aria-selected="false">Sort</button>
      </li>
    </ul>

    <!-- Filter Content -->
    <form action="{{ route('get.baju') }}" method="get">

      <div class="tab-content" id="tabFilterContent">

        <!-- Search -->
        <div class="tab-pane fade show active" id="search" role="tabpanel" aria-labelledby="search-tab">
          <div class="row">

            <div class="col-lg-2 col-md-6 col-xs-12 mt-3">
              <label for="cari_Merk">Merk</label>
              <input type="text" name="cari _Merk" class="form-control" placeholder="" value="{{ $cari_Merk }}">
            </div>

            <div class="col-lg-2 col-md-6 col-xs-12 mt-3">
              <label for="cari_Nama_pendiri">Pendiri</label>
              <input type="text" name="cari_Nama_pendiri" class="form-control" placeholder="" value="{{ $cari_Nama_pendiri }}">
            </div>

          </div>

          <div class="row">
            <div class="col-lg-2 col-md-6 col-xs-12 mt-2">
              <label for="set_pagination">Barang Per Halaman</label>

              <select name="set_pagination" class="form-control">
                <option value="1" {{ $set_pagination == "1" ? 'selected' : '' }}>1</option>
                <option value="5" {{ $set_pagination == "5" ? 'selected' : '' }}>5</option>
                <option value="15" {{ $set_pagination == "10" ? 'selected' : '' }}>15</option>
                <option value="50" {{ $set_pagination == "50" ? 'selected' : '' }}>50</option>
                <option value="80" {{ $set_pagination == "80" ? 'selected' : '' }}>80</option>
                <option value="150" {{ $set_pagination == "100" ? 'selected' : '' }}>150</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Sort -->
        <div class="tab-pane fade" id="sort" role="tabpanel" aria-labelledby="Sort-tab">
          <div class="row">
            <div class="col-lg-2 col-md-6 col-xs-12 mt-3"> 
              <label for="var_sort"><i></i> Bidang</label>
              <select name="var_sort" class="form-control">
                <option value="">Pilih Opsi</option>
                <option value="Merk" {{ $var_sort == "Merk" ? 'selected' : '' }}>Merk</option>
                <option value="created_at" {{ $var_sort == "created_at" ? 'selected' : '' }}>Dibuat</option>
                <option value="updated_at" {{ $var_sort == "updated_at" ? 'selected' : '' }}>Diperbarui</option>
              </select>
            </div>

            <div class="col-lg-2 col-md-6 col-xs-12 mt-3">
              <label for="tipe_sort"><i></i> Tipe</label>
              <select name="tipe_sort" class="form-control">
                <option value="">Pilih Opsi</option>
                <option value="desc" {{ $tipe_sort == "desc" ? 'selected' : '' }}>Menurun</option>
                <option value="asc" {{ $tipe_sort == "asc" ? 'selected' : '' }}>Naik</option>
              </select>
            </div>
          </div>
        </div>
      </div>


      <button type="submit" class="btn btn-dark mt-2">
        Cari
      </button>    

      <a href="{{ route('get.baju') }}" class="btn btn-dark mt-2">
        Segarkan
      </a>  

    </form>
    <!-- End Filter -->
    <hr>

    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Merk</th>
              <th>Ukuran</th>
              <th>Jumlah</th>
              <th>Pendiri</th>
              <th>Pilihan</th>
            </tr>
        </thead>
          <tbody>
            @foreach($data_baju as $baju)
              <tr>
                <td>{{ $loop->iteration + $data_baju->firstItem() - 1 }}</td>
                <td>{{ $baju->Merk }}</td>
                <td>{{ $baju->Ukuran }}</td>
                <td>{{ $baju->Jumlah }}</td>
                <td>{{ $baju->pendiri->Nama }}</td>
                <td class="text-nowrap">
                  <!-- Detail -->
                  <a href="{{ route('get.detail.baju', $baju->id) }}" class="btn btn-dark mx-2" > 
                    <i class="fa fa-eye"></i>
                  </a>

                  <!-- Ubah -->
                  <a href="{{ route('get.ubah.baju', $baju->id) }}" class="btn btn-primary mx-2" > 
                    <i class="fa fa-edit"></i>
                  </a>

                  <!-- Delete -->
                  <form hidden action="{{ route('delete.baju', $baju->id)}}" method="post" id="data-ke-{{ $baju->id }}">
                    @csrf
                    @method('DELETE')
                    &nbsp;
                  </form>

                  <button class="btn btn-dark mx-2" onclick="deleteRow( {{ $baju->id }} )">
                    <i class="fas fa-trash"></i>
                  </button>
                  &nbsp;

                </td>
              </tr>
            @endforeach
        </tbody>
      </table>
  </div>

  <div class="card-footer">
    <h5>Jumlah Data : <span>{{ $data_baju->total() }}</span></h5>
    {{ $data_baju->links('vendor.pagination.bootstrap-4') }}
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
      title: 'Apakah anda yakin ?',
      text: "Anda tidak dapat mengembalikan data yang telah di hapus",
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText : 'Batal',
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