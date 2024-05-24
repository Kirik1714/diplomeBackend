@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Заказы для аптеки "{{ $pharmacy->name }}"</h1>
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
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex">
            <div class="flex-grow-1">
              <a href="{{ route('pharmacy.index') }}" class="btn btn-warning">Назад к списку аптек</a>
            </div>
            <div>
              <form action="{{ route('pharmacy.order.search', $pharmacy) }}" method="GET">
                <div class="input-group">
                  <input type="text" name="search" class="form-control" placeholder="Номер заказа">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Поиск</button>
                  </div>
                </div>
              </form>
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
                  @php
                    $orderStatus = 'Принят в обработку';
                    foreach (json_decode($order->products, true) as $product) {
                      if ($product['pharmacy']['id'] == $pharmacy->id) {
                        $orderStatus = $product['status'] ?? 'Принят в обработку';
                        break;
                      }
                    }
                  @endphp
                  <tr class="
                    @if ($orderStatus === 'Выдан')
                      table-success
                    @elseif ($orderStatus === 'Отменен')
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
                    <td>{{ $orderStatus }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                      @if ($orderStatus === 'Отменен')
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
            {{ $orders->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
