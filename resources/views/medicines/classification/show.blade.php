@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Классификации</h1>
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
              <a href="{{route('medicine.classification.edit',$classification->id)}}" class="btn btn-primary mr-2">Редактировать</a>
              <a href="{{route('medicine.classification.index')}}" class="btn btn-warning">Назад</a>
            </div>
            <form  class="float-right" action="{{route('medicine.classification.destroy',$classification->id)}}" method="post">
              @csrf
              @method('delete')
              <input type="submit" value="Удалить" class="btn btn-danger ">
            </form>

          </div>

          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-wrap">

              <tbody>
                <tr>
                  <td>ID</td>
                  <td>{{$classification->id}}</td>

                </tr>

                <tr>
                  <td>Название</td>
                  <td>{{$classification->name}}</td>

                </tr>
                <tr>
                  <td>Описание</td>
                  <td style="max-width: 300px;" >{{$classification->description}}</td>

                </tr>





              </tbody>
            </table>
          </div>

        </div>

      </div>
    </div>

  </div>


</section>
@endsection