@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Лекарства</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Главная</li>
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

      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a href="{{ route('medicine.list.create') }}" class="btn btn-primary">Добавить</a>
            <form id="search-form" action="{{ route('medicine.list.search') }}" method="GET" class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input id="search-input" type="text" name="query" class="form-control float-right" placeholder="Search" value="{{ $query ?? '' }}">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>

          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Наименование</th>
                </tr>
              </thead>
              <tbody>
                @foreach($medicines as $medicine)
                <tr>
                  <td>{{$medicine->id}}</td>
                  <td><a href="{{ route('medicine.list.show', $medicine->id) }}">{{$medicine->name}}</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">

              {{ $medicines->links() }}
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>
</section>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const searchForm = document.getElementById('search-form');
    
    // Сохраняем значение поиска при отправке формы
    searchForm.addEventListener('submit', function() {
      searchInput.value = searchInput.value.trim();
    });

    // После загрузки страницы устанавливаем значение в поле ввода
    searchInput.value = "{{ $query ?? '' }}";
  });
</script>
@endsection
