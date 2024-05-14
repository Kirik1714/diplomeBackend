@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Добавить аптеку</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Аптеки/Добавить</li>
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
      <form action="{{route('pharmacy.store')}}" method="post">
        @csrf
        <div class="form-group">
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Название" value="{{ old('name') }}">
          @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" placeholder="Город" value="{{ old('city') }}">
          @error('city')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Адрес" value="{{ old('address') }}">
          @error('address')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Телефон" value="{{ old('phone') }}">
          @error('phone')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label for="work_hours">Часы работы:</label>
          <div class=" d-flex f-row gap-4">
            <div class="  ">
              <div class="d-flex align-items-center">

                <label for="work_start " class="mr-2">С:</label>
                <input type="time" class="form-control w-125" name="work_start" placeholder="Начало работы" value="{{ old('work_start') }}">
              </div>
              @error('work_start')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <!-- Поле для окончания работы -->
            <div class="  ">
              <div class="d-flex align-items-center">

                <label for="work_end" class="mr-2">До:</label>
                <input type="time" class="form-control w-125" name="work_end" placeholder="Окончание работы" value="{{ old('work_end') }}">
              </div>
              @error('work_end')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Добавить">
        </div>
      </form>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection