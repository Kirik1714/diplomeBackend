@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Информация об аптеке</h1>
      </div><!-- /.col --> 
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('main.index') }}">Главная</a></li>
          <li class="breadcrumb-item active">Аптека</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Pharmacy Info -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex">
            <div class="mr-4 flex-grow-1">
              <a href="{{ route('pharmacy.edit', $pharmacy->id) }}" class="btn btn-primary">Редактировать</a>
              <a href="{{ route('pharmacy.index') }}" class="btn btn-warning">Назад</a>
            </div>
            <form action="{{ route('pharmacy.destroy', $pharmacy->id) }}" method="post">
              @csrf
              @method('delete')
              <input type="submit" value="Удалить" class="btn btn-danger">
            </form>
          </div>

          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <tbody>
                <tr>
                  <td>ID</td>
                  <td>{{ $pharmacy->id }}</td>
                </tr>
                <tr>
                  <td>Название</td>
                  <td>{{ $pharmacy->name }}</td>
                </tr>
                <tr>
                  <td>Город</td>
                  <td>{{ $pharmacy->city }}</td>
                </tr>
                <tr>
                  <td>Адрес</td>
                  <td>{{ $pharmacy->address }}</td>
                </tr>
                <tr>
                  <td>Телефон</td>
                  <td>{{ $pharmacy->phone }}</td>
                </tr>
                <tr>
                  <td>Часы работы</td>
                  <td>{{ $pharmacy->work_start }} - {{ $pharmacy->work_end }}</td>
                </tr>
              </tbody>
      
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Add Assortment Button -->
    <div class="row mt-4">
      <div class="col-6">
        <a href="{{ route('pharmacy.assortment.index', $pharmacy->id) }}" class="btn btn-success btn-block">Ассортимент</a>
      </div>
      <div class="col-6">
        <a href="{{ route('pharmacy.order.index', $pharmacy->id) }}" class="btn btn-primary btn-block">Заказы</a>
      </div>
    </div>

    <!-- Pharmacy Statistics -->
    <div class="card-body mt-4">
      <div class="text-center mb-3"><h3>Статистика</h3></div>
      <canvas id="ordersChart" width="400" height="200"></canvas>
    </div>

  </div>
</section>
@endsection

@section('scripts')
  <script>
    var orderData = @json($orderData);
    var months = Object.keys(orderData);
    var totalOrdersData = months.map(function(month) {
        return orderData[month]['total_orders'];
    });
    var cancelledOrdersData = months.map(function(month) {
        return orderData[month]['cancelled_orders'];
    });

    var ctx = document.getElementById('ordersChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Количество заказов',
                    data: totalOrdersData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Отмененные заказы',
                    data: cancelledOrdersData,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
  </script>
@endsection
