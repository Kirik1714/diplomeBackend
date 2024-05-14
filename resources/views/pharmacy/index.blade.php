@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Аптеки</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Аптеки</li>
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
             <a href="{{ route('pharmacy.create') }}" class="btn btn-primary">Добавить</a>
             <form action="{{ route('pharmacy.search') }}" method="GET" class="form-inline float-right">
              <input class="form-control mr-sm-2" type="search" placeholder="Поиск" aria-label="Search" name="search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Найти</button>
            </form>
            </div>

            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Название</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($pharmacies as $pharmacy)
                  <tr>
                    <td>{{$pharmacy->id}}</td>
                    <td><a href="{{ route('pharmacy.show', $pharmacy->id) }}" >{{$pharmacy->name}}</a></td>
                  </tr>
                @endforeach
              
               
                </tbody>
              </table>
            </div>

            <div class="card-footer clearfix">
              <div class="pagination pagination-sm m-0 float-right">
                {{ $pharmacies->links() }}
              </div>
            </div>

          </div>

        </div>
      </div>

    </div>


</section>
@endsection
