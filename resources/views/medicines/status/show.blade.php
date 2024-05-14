@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Организации</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Главная</li>
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
          <div class="card-header d-flex ">
            <div class="mr-4 flex-grow-1">
              <a href="{{route('medicine.status.edit',$status->id)}}" class="btn btn-primary">Редактировать</a>
              <a href="{{route('medicine.status.index')}}" class="btn btn-warning">Назад</a>


            </div>
            <form action="{{route('medicine.status.destroy',$status->id)}}" method="post">
              @csrf
              @method('delete')
              <input type="submit" value="Удалить" class="btn btn-danger">
            </form>

          </div>

          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-wrap">

            <tbody>
                <tr>
                  <td>ID</td>
                  <td>{{$status->id}}</td>

                </tr>

                <tr>
                  <td>Наименование статуса</td>
                  <td>{{$status->name}}</td>

                </tr>
           





            
            </table>
          </div>

        </div>

      </div>
    </div>

  </div>


</section>
@endsection