@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Результаты поиска в аптеке "{{ $pharmacy->name }}" по номеру заказа "{{ request()->get('search') }}"</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('pharmacy.index') }}">Аптеки</a></li>
          <li class="breadcrumb-item active">Заказы</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row mb-3">
      <div class="col-12">
        <form action="{{ route('pharmacy.order.search', $pharmacy) }}" method="GET" class="form-inline">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Номер заказа" value="{{ request()->get('search') }}">
            <div class="input-group-append">
              <button type="submit" class="btn btn-primary ml-2">Поиск</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex">
            <div class="flex-grow-1">
              <a href="{{ route('pharmacy.index') }}" class="btn btn-warning">Назад к списку аптек</a>
            </div>
          </div>

          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Номер заказа</th>
                  <th>Пользователь</th>
                  <th>Продукты</th>
                  <th>Общая стоимость</th>
                  <th>Статус</th>
                  <th>Дата создания</th>
                  <th>Действия</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $order)
                <tr class="
                  @if ($order->status === 'Выдан')
                    table-success
                  @elseif ($order->status === 'Отменен')
                    table-danger
                  @else
                    table-warning
                  @endif
                ">
                  <td>{{ $order->id }}</td>
                  <td>{{ $order->order_number }}</td>
                  <td>{{ $order->user->name }}</td>
                  <td>
                    @foreach (json_decode($order->products, true) as $product)
                      @if ($product['pharmacy']['id'] == $pharmacy->id)
                        <div>
                          <strong>Название:</strong> {{ $product['medicine']['name'] }}<br>
                          <strong>Количество:</strong> {{ $product['count'] }}<br>
                          <strong>Аптека:</strong> {{ $product['pharmacy']['name'] }}<br>
                          <strong>Цена:</strong> {{ $product['pharmacy']['total_price'] }}
                        </div>
                      @endif
                    @endforeach
                  </td>
                  <td>{{ $order->total_price }}</td>
                  <td>{{ $order->status }}</td>
                  <td>{{ $order->created_at }}</td>
                  <td>
                    @if ($order->status === 'Отменен')
                      Закрыт
                    @else
                      <a href="{{ route('pharmacy.order.edit', [$pharmacy, $order]) }}" class="btn btn-primary">Редактировать</a>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-center mt-3">
            {{ $orders->appends(['search' => request()->get('search')])->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
