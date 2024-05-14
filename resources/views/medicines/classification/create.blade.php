@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Добавить классификацию</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Лекарство/Классификация/Добавить</li>
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
    <form action="{{ route('medicine.classification.store') }}" method="post" style="width:400px" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" style="width:250px" placeholder="Наименование">
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>Описание</label>
        <textarea class="form-control" rows="4" name="description" placeholder="Введите ..." style="height: 104px;"></textarea>
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Добавить">
        <a href="{{url()->previous() }}" class="btn btn-warning">Отменить добавление</a>
    </div>
</form>
    </div>

  </div><!-- /.container-fluid -->
</section>
@endsection