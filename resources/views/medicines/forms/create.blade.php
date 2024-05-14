@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Добавить форму</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Лекарство/Формы/Добавить</li>
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
      <form action="{{route('medicine.form.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group w-25" >
          <input type="text" class="form-control" name="name" placeholder="Наименование" value="{{ old('name') }}">
        </div>
        
  
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Добавить">
          </div>

      </form>

    </div>

  </div><!-- /.container-fluid -->
</section>
@endsection