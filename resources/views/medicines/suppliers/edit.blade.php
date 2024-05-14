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
      <form action="{{ route('medicine.supplier.update', $supplier->id) }}" method="post" style="width:400px" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-group">
          <input type="text" class="form-control" name="name" value="{{ $supplier->name }}" style="width:250px" placeholder="Наименование организации">
          @error('name')
              <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="form-group">
          <input type="text" class="form-control" name="address" value="{{ $supplier->address }}" style="width:250px" placeholder="Адрес">
          @error('address')
              <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="form-group">
          <input type="text" class="form-control" name="city" value="{{ $supplier->city }}" style="width:250px" placeholder="Город">
          @error('city')
              <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="form-group">
          <input type="text" class="form-control" name="phone" value="{{ $supplier->phone }}" style="width:250px" placeholder="Телефон">
          @error('phone')
              <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="form-group">
          <input type="text" class="form-control" name="postal_code" value="{{ $supplier->postal_code }}" style="width:250px" placeholder="Почтовый индекс">
          @error('postal_code')
              <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Обновить">
          <a href="{{ url()->previous() }}" class="btn btn-warning">Отменить редактирование</a>
        </div>
      </form>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection
