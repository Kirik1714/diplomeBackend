@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Результаты поиска лекарства "{{$query }}"</h1>
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
          <div class="card-header">
            <a href="{{ route('medicine.list.index') }}" class="btn btn-warning">Вернуться</a>
           

          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Наименование</th>
                </tr>
              </thead>
              <tbody>
                @foreach($medicines as $medicine)
                <tr>
                  <td>{{$medicine->id}}</td>
                  <td><a href="{{ route('medicine.list.show', $medicine->id) }}">{{$medicine->name}}</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="card-footer clearfix">
                        <div class="pagination pagination-sm m-0 float-right">
          {{ $medicines->appends(['query' => $query])->links() }}
        </div>
          </div>

        </div>

      </div>
    </div>

  </div>
</section>
@endsection


