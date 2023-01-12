@extends('layouts.dh')

@section('judul')
<h1 class="h3 mb-4 text-gray-800">
  Profil
</h1>
@endsection

@section('konten')

<!-- Card Profile -->
<div class="row">
  <div class="col-md-4">

    <!-- Profile Image -->
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="text-center">
          @if(!empty($data_user->profile_picture))
          <img class="img-fluid img-circle" src="{{ url('/files/profile-picture/'.$data_user->profile_picture) }}" alt="User profile picture">
          @else
          <img class="img-fluid img-circle" src="{{ asset('img/default-avatar.png') }}" alt="User profile picture">
          @endif
        </div>

        <h2 class="text-center mt-2">
          {{ $data_user->name }}
        </h2>

        <ul>
          <li>
            <b>Email</b> <a class="float-right">{{ $data_user->email }}</a>
          </li>
          <li>
            <b>Di Update</b> <a class="float-right">{{ $data_user->updated_at }}</a>
          </li>
        </ul>

                

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </div>

  <!-- /.col -->
  <div class="col-md-8">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pengaturan</h6>
      </div><!-- /.card-header -->

      <div class="card-body">
        
        <form class="form-horizontal" action="{{ route('profile.update', ['id' => $data_user->id]) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PATCH')

          <!-- Nama -->
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $data_user->name ?? old('name') }}" autocomplete="name" placeholder="Name">

              @error('name')
              <span class="error invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <!-- E-Mail -->
          <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $data_user->email ?? old('email') }}" autocomplete="email" placeholder="e-Mail">

              @error('email')
              <span class="error invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <!-- Password Lama -->
          <input type="hidden" name="password_lama" id="password_lama" value="{{ $data_user->password }}">

          <!-- Password -->
          <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" autocomplete="password" placeholder="Password">
              

              @error('password')
              <span class="error invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <!-- Show Profile Picture Lama -->
          <input type="hidden" name="file_profile_picture_lama" id="file_profile_picture_lama" value="{{ $data_user->profile_picture }}">

          <!-- Profile Picture -->
          <div class="form-group row">
            <label for="profile_picture" class="col-sm-2 col-form-label">Photo Profil</label>
            <div class="col-sm-10">
               <input type="file" class="@error('profile_picture') is-invalid @enderror" id="profile_picture" name="profile_picture">

              @error('profile_picture')
              <span class="error invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror

            </div>
          </div>



          <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
              <button type="submit" class="btn btn-dark">Perbarui</button>
            </div>
          </div>
        </form>
        
      </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
@endsection