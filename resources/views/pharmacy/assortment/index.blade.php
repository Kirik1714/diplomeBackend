@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Ассортимент аптеки "{{ $pharmacy->name }}"</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('pharmacy.index') }}">Аптеки</a></li>
          <li class="breadcrumb-item active">Ассортимент</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Search Form -->
    <div class="row mb-3">
      <div class="col-md-6">
        <form action="{{ route('pharmacy.assortment.search', $pharmacy->id) }}" method="GET">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Поиск по названию лекарства">
            <div class="input-group-append">
              <button type="submit" class="btn btn-primary">Поиск</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Assortment Table -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex">
            <div class="flex-grow-1">
              <a href="{{ route('pharmacy.index') }}" class="btn btn-primary">К списку аптек</a>
              <a href="{{ route('pharmacy.show', $pharmacy->id) }}" class="btn btn-warning">Назад </a>

            </div>
            <a href="{{ route('pharmacy.assortment.create', $pharmacy->id) }}" class="btn btn-success">Добавить лекарство</a>
          </div>

          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Название</th>
                  <th>Оптовая стоимость</th>
                  <th>Процент наценки</th>
                  <th>Финальная стоимость</th>
                  <th>Статус</th>
                  <th>Количество</th>
                  <th>Действия</th> 
                </tr>
              </thead>
              <tbody>
                @foreach ($medicines as $medicine)
                <tr>
                  <td>{{$medicine->id}}</td>
                  <td><a href="{{ route('medicine.list.show', $medicine->id) }}">{{$medicine->name}}</a></td>
                  <td>{{$medicine->price}}</td>
                  <td>{{$medicine->pivot->markup_percentage}}</td> <!-- Отображение процента наценки -->
                  <td>{{ number_format($medicine->price + ($medicine->price * $medicine->pivot->markup_percentage / 100), 2) }}</td>
                  <td>{{$medicine->pivot->availability}}</td>
                  <td>{{$medicine->pivot->quantity}}</td>
                  <td class="d-flex gap-4">
                    <a href="{{ route('pharmacy.assortment.edit', [$pharmacy->id, $medicine->id]) }}" class="btn btn-primary">Редактировать</a>
                    <form action="{{ route('pharmacy.assortment.destroy', [$pharmacy->id, $medicine->id]) }}" method="post">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-center mt-3">
            {{ $medicines->links() }}
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection
