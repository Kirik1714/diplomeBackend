@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Редактировать профиль</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('main.index') }}">Главная</a></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Edit User Form -->
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="post">
              @csrf
              @method('patch')
              <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" placeholder="Имя">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" placeholder="Email">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="is_admin">Роль</label>
                <select name="is_admin" class="form-control">
                  <option value="0" {{ !$user->is_admin ? 'selected' : '' }}>Пользователь</option>
                  <option value="1" {{ $user->is_admin ? 'selected' : '' }}>Администратор</option>
                </select>
              </div>
              <div class="form-group">
                <label for="password">Новый Пароль</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Пароль">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Обновить">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection