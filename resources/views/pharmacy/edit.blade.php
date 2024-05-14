@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Редактировать аптеку</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('main.index') }}">Главная</a></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Edit Pharmacy Form -->
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('pharmacy.update', $pharmacy->id) }}" method="post">
              @csrf
              @method('patch')
              <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $pharmacy->name) }}" placeholder="Название">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="city">Город</label>
                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city', $pharmacy->city) }}" placeholder="Город">
                @error('city')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="address">Адрес</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $pharmacy->address) }}" placeholder="Адрес">
                @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $pharmacy->phone) }}" placeholder="Телефон">
                @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="work_hours">Часы работы</label>
                <div class="row">
                  <div class="col">
                    <input type="time" class="form-control @error('work_start') is-invalid @enderror" name="work_start" value="{{ old('work_start', substr($pharmacy->work_start, 0, -3)) }}" placeholder="Начало работы">
                    @error('work_start')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col">
                    <input type="time" class="form-control @error('work_end') is-invalid @enderror" name="work_end" value="{{ old('work_end', substr($pharmacy->work_end, 0, -3)) }}" placeholder="Окончание работы">
                    @error('work_end')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Обновить">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection