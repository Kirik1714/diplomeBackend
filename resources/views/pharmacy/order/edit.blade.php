@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Редактировать заказ #{{ $order->order_number }} для аптеки "{{ $pharmacy->name }}"</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('pharmacy.index') }}">Аптеки</a></li>
          <li class="breadcrumb-item"><a href="{{ route('pharmacy.order.index', $pharmacy) }}">Заказы</a></li>
          <li class="breadcrumb-item active">Редактировать заказ</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Информация о заказе</h3>
          </div> 
          <div class="card-body">
            <form action="{{ route('pharmacy.order.update', [$pharmacy, $order]) }}" method="post">
              @csrf
              @method('patch')
              <div class="form-group">
                <label for="status">Статус</label>
                <select name="status" id="status" class="form-control">
                  <option value="Принят в обработку" {{ old('status', $order->status) == 'Принят в обработку' ? 'selected' : '' }}>Принят в обработку</option>
                  <option value="Собран" {{ old('status', $order->status) == 'Собран' ? 'selected' : '' }}>Собран</option>
                  <option value="Готов к выдаче" {{ old('status', $order->status) == 'Готов к выдаче' ? 'selected' : '' }}>Готов к выдаче</option>
                  <option value="Выдан" {{ old('status', $order->status) == 'Выдан' ? 'selected' : '' }}>Выдан</option>
                  <option value="Отменен" {{ old('status', $order->status) == 'Отменен' ? 'selected' : '' }}>Отменен</option>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a href="{{ route('pharmacy.order.index', $pharmacy) }}" class="btn btn-secondary">Назад</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
