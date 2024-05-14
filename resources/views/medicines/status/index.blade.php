@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Статусы лекарств</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Лекарство/Статус</li>
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
             <a href="{{route('medicine.status.create')}}" class="btn btn-primary">Добавить</a>
            </div>

            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Статус</th>

                  </tr>
                </thead>
                <tbody>
                @foreach($statutes as $status)
                  <tr>
                    <td>{{$status->id}}</td>
                    <td><a href="{{route('medicine.status.show',$status->id)}}">{{$status->name}}</a></td>
                  </tr>
                @endforeach
                
                 
               
                </tbody>
              </table>
            </div>

          </div>

        </div>
      </div>

    </div>


</section>
@endsection