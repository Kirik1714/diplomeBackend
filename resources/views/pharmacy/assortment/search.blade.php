@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Результаты поиска ассортимента аптеки "{{ $pharmacy->name }}"</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('pharmacy.index') }}">Аптеки</a></li>
          <li class="breadcrumb-item"><a href="{{ route('pharmacy.show', $pharmacy->id) }}">Аптека</a></li>
          <li class="breadcrumb-item active">Результаты поиска</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Результаты поиска по "{{ $searchQuery }}"</h3>
          </div>
          <!-- /.card-header -->
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
                  <td>{{$medicine->pivot->markup_percentage}}</td>
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
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <div class="pagination pagination-sm m-0 float-right"> 
            {{ $medicines->appends(['query' => $searchQuery])->links() }}
            </div>
            <a href="{{ route('pharmacy.assortment.index', $pharmacy->id) }}" class="btn btn-default">Назад</a>
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
