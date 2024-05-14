@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Редактировать продукт</h1>
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
      <form action="{{route('medicine.form.update', $form->id)}}" method="post" class="w-25" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-group">
          <input type="text" class="form-control" value="{{$form->name}}" name="name" placeholder="Наименование">
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Обновить">
        </div>

      </form>

    </div>

  </div><!-- /.container-fluid -->
</section>
@endsection