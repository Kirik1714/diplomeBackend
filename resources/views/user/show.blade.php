@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Информация о пользователе</h1>
      </div><!-- /.col --> 
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('main.index') }}">Главная</a></li>
          <li class="breadcrumb-item active">Пользователь</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- User Info -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex">
            <div class="mr-4 flex-grow-1">
              <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Редактировать</a>
              <a href="{{ route('user.index') }}" class="btn btn-warning">Назад</a>
            </div>
            <form action="{{ route('user.destroy', $user->id) }}" method="post">
              @csrf
              @method('delete')
              <input type="submit" value="Удалить" class="btn btn-danger">
            </form>
          </div>

          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <tbody>
                <tr>
                  <td>ID</td>
                  <td>{{ $user->id }}</td>
                </tr>
                <tr>
                  <td>Имя</td>
                  <td>{{ $user->name }}</td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>{{ $user->email }}</td>
                </tr>
                <tr>
                  <td>Права</td>
                  <td>{{ $user->is_admin ? 'Администратор' : 'Пользователь' }}</td>
                </tr>
                <!-- Добавьте дополнительные поля пользователя здесь, если они есть -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
