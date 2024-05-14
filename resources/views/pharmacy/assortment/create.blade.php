@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Добавить лекарство в аптеку</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Аптеки/Добавить/Лекарства</li>
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
            <!-- Ошибка -->
        

            <form action="{{ route('pharmacy.assortment.store', $pharmacy->id) }}" method="post" id="addMedicineForm">
              @csrf       
              <div class="form-group">
                <input type="hidden" name="pharmacy_id" value="{{ $pharmacy->id }}">
              </div>
              <div class="form-group">
              <label for="medicine_id">Лекарство</label>

                <select name="medicine_id" class="form-control medicine" data-placeholder="Выберите лекарство">
                  <option value=""></option>
                  @foreach($medicines as $medicine)
                  <option value="{{ $medicine->id }}" data-price="{{ $medicine->price }}">{{ $medicine->name }} - {{ $medicine->price }} руб.</option>
                  @endforeach
                </select>
                @error('medicine_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="availability">Доступность</label>
                <select name="availability" class="form-control availability" data-placeholder="Выберите доступность">
                  <option value=""></option>
                  <option value="в наличии">В наличии</option>
                  <option value="под заказ">Под заказ</option>
                  <option value="нет в наличии">Нет в наличии</option>
                </select>
                @error('availability')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="quantity">Количество</label>
                <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" placeholder="Количество" value="{{ old('quantity') }}">
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
                <input type="number" class="form-control @error('markup_percentage') is-invalid @enderror" name="markup_percentage" id="markup_percentage" placeholder="Процент наценки" value="{{ old('markup_percentage') }}">
                @error('markup_percentage')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="retail_price">Финальная цена продажи (руб.)</label>
                <input type="number" class="form-control @error('retail_price') is-invalid @enderror" name="retail_price" id="retail_price" placeholder="Финальная цена продажи" value="{{ old('retail_price') }}" readonly>
                @error('retail_price')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Добавить</button>
                <a href="{{ route('pharmacy.assortment.index', $pharmacy->id) }}" class="btn btn-secondary">Назад</a>
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
<script >
  
 document.addEventListener('DOMContentLoaded', function() {
    const medicineSelect = document.querySelector('.medicine');
    const markupPercentageInput = document.getElementById('markup_percentage');
    const retailPriceInput = document.getElementById('retail_price');

    medicineSelect.addEventListener('change', function() {
      const selectedOption = this.options[this.selectedIndex];
      const basePrice = selectedOption.getAttribute('data-price');
      const markupPercentage = markupPercentageInput.value;
      const retailPrice = parseFloat(basePrice) + (parseFloat(basePrice) * parseFloat(markupPercentage) / 100);
      retailPriceInput.value = retailPrice.toFixed(2);
    });

    markupPercentageInput.addEventListener('input', function() {
      const selectedOption = medicineSelect.options[medicineSelect.selectedIndex];
      const basePrice = selectedOption.getAttribute('data-price');
      const markupPercentage = this.value;
      const retailPrice = parseFloat(basePrice) + (parseFloat(basePrice) * parseFloat(markupPercentage) / 100);
      retailPriceInput.value = retailPrice.toFixed(2);
    });
  });
  
</script>
@endsection
