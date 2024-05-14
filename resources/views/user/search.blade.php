@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Результаты поиска пользователей по запросу "{{ $searchQuery }}"</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Пользователи</a></li>
                    <li class="breadcrumb-item active">Результаты поиска</li>
                </ol> 
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Назад</a>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Имя</th>
                                    <th>Email</th>
                                    <th>Роль</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td><a href="{{ route('user.show', $user->id) }}">{{$user->name}}</a></td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->is_admin ? 'Администратор' : 'Пользователь'}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer clearfix">
                        <div class="pagination pagination-sm m-0 float-right">
                            {{ $users->appends(['search' => $searchQuery])->links() }}
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
    </div>
</section>
@endsection
