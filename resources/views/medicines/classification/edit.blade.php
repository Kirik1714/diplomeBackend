@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Редактировать классификацию</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Главная/Редактировать классификацию</li>
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
      <form action="{{route('medicine.classification.update', $classification->id)}}" method="post"style="width:400px" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-group">
          <input type="text" class="form-control w-50" value="{{$classification->name}}"  name="name" placeholder="Наименование">
          @error('name')
              <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <textarea class="form-control" rows="4" name="description" placeholder="Введите ..."  style="height: 250px;">{{$classification->description}}</textarea>
          @error('description')
              <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Обновить">
          <a href="{{ route('medicine.classification.index', $classification->id) }}" class="btn btn-warning">Отменить редактирование</a>
        </div>
      </form>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection
