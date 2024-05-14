@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Обновить  об лекарстве в аптеке</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('pharmacy.index') }}">Аптеки</a></li>
          <li class="breadcrumb-item"><a href="{{ route('pharmacy.show', $pharmacy->id) }}"> {{ $pharmacy->name }}</a></li>
          <li class="breadcrumb-item active">Обновить лекарство</li>
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
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <form method="post" id="updateMedicineForm" action="{{ route('pharmacy.assortment.update', [$pharmacy->id, $assortment->id]) }}">
              @csrf
              @method('PATCH')
              <div class="form-group">
                <label for="medicine_name">Лекарство</label>
                <input type="text" class="form-control" id="medicine_name" value="{{ $assortment->medicine->name }} - {{ $assortment->medicine->price }}" readonly>
              </div>
              <div class="form-group">
                <label for="availability">Доступность</label>
                <select name="availability" class="form-control availability" data-placeholder="Выберите доступность">
                  <option value="в наличии" {{ $assortment->availability == 'в наличии' ? 'selected' : '' }}>В наличии</option>
                  <option value="под заказ" {{ $assortment->availability == 'под заказ' ? 'selected' : '' }}>Под заказ</option>
                  <option value="нет в наличии" {{ $assortment->availability == 'нет в наличии' ? 'selected' : '' }}>Нет в наличии</option>
                </select>
                @error('availability')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="quantity">Количество</label>
                <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" placeholder="Количество" value="{{ $assortment->quantity }}">
                @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <hr>
              <div class="form-group">
                <h5>Данные о цене:</h5>
              </div>
              <div class="form-group">
                <label for="markup_percentage">Процент наценки (%)</label>
                <input type="number" class="form-control @error('markup_percentage') is-invalid @enderror" name="markup_percentage" id="markup_percentage" placeholder="Процент наценки" value="{{ $assortment->markup_percentage }}">
                @error('markup_percentage')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="retail_price">Финальная цена продажи (руб.)</label>
                <input type="number" class="form-control @error('retail_price') is-invalid @enderror" name="retail_price" id="retail_price" placeholder="Финальная цена продажи" value="{{ $assortment->retail_price }}" readonly>
                @error('retail_price')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Обновить</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const markupPercentageInput = document.getElementById('markup_percentage');
    const retailPriceInput = document.getElementById('retail_price');

    // Функция для расчета цены
    function calculateRetailPrice() {
      const basePrice = parseFloat("{{ $assortment->medicine->price }}");
      const markupPercentage = parseFloat(markupPercentageInput.value);
      const retailPrice = basePrice + (basePrice * markupPercentage / 100);
      retailPriceInput.value = retailPrice.toFixed(2);
    }

    // Вызов функции расчета цены при загрузке страницы
    calculateRetailPrice();

    // Обработчик события для перерасчета цены при изменении процента наценки
    markupPercentageInput.addEventListener('input', calculateRetailPrice);
  });
</script>
@endsection
