@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Добавить пользователя</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Пользователи/Добавить</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- User Creation Form -->
    <div class="row">
      <form action="{{ route('user.store') }}" method="post">
        @csrf
        <div class="form-group">
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Имя" value="{{ old('name') }}">
          @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}">
          @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label for="is_admin">Роль:</label>
          <select name="is_admin" class="form-control">
            <option value="0">Пользователь</option>
            <option value="1">Администратор</option>
          </select>
        </div>
        <div class="form-group">
          <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Пароль">
          @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password_confirmation" placeholder="Подтверждение пароля">
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Добавить">
        </div>
      </form>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection
