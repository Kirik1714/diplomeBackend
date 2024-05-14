@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Добавить лекарство</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Лекарство/Добавить</li>
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
    
      <form action="{{ route('medicine.list.store') }}" method="post"  enctype="multipart/form-data">
        @csrf
        <div class="d-flex ">

          <div class="col-md-6 mr-5">
            <div class="form-group">
              <input type="text" class="form-control" name="name" value="{{ old('name') }}" style="width:250px" placeholder="Название">
              @error('name')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
    
            <div class="form-group">
              <label>Описание</label>
              <textarea class="form-control" rows="4" value="{{ old('description') }}" name="description" placeholder="Введите ..." style="height: 104px;"></textarea>
              @error('description')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="price" style="width:150px" value="{{ old('price') }}" placeholder="Цена">
              @error('price')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div> 
            <div class="form-group">
    
              <input type="text" class="form-control" name="packaging" value="{{ old('packaging') }}" placeholder="Кол-во препарата в упаковке">
              @error('packaging')
              <div class="text-danger">{{ $message }}</div>
              @enderror
    
            </div>
    
            <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control" name="dosage_value" value="{{ old('dosage_value') }}" placeholder="Дозировка">
                <select name="dosage_unit" class="form-control">
                  <option value="мг">мг</option>
                  <option value="г">г</option>
                  <option value="мл">мл</option>
                  <option value="мг/г">мг/г</option>
                  <option value="мг/мл">мг/мл</option>

                </select>
              </div>
              @error('dosage_value')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="atx" value="{{ old('atx') }}" placeholder="Фармакотерапевтическая группа, ATX">
              @error('atx')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
               
       
            <div class="form-group">
            <label>Изображение</label>

    <div id="image-preview1" class="form-group"></div>
    <div class="form-group">
        <div class="input-group">
            <input type="file" class="form-control" id="inputGroupFile01" name="image_url[]" multiple onchange="previewImages(event)">
        </div>
    </div>
    <!-- Кнопка для удаления всех изображений -->
    <button type="button" class="btn btn-danger" style="display: none;" id="clearImagesBtn" onclick="removeAllImages()">Удалить все изображения</button>
    @error('image_url')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

    
    
            <div class="form-group">
              <select name="status_id" class="status" data-placeholder="Выберите статус" style="width: 100%;">
                <option value=""></option>
                @foreach($statuses as $status)
                <option value="{{$status->id}}">{{$status->name}}</option>
                @endforeach
              </select>
              @error('status_id')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
    
            <div class="form-group">
              <select name="form_id" class="form" data-placeholder="Выберите форму" style="width: 100%;">
              <option value=""></option> 
              @foreach($forms as $form)
                <option value="{{$form->id}}">{{$form->name}}</option>
                @endforeach
              </select>
              @error('form_id')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
    
            <div class="form-group">
              <select name="classification_id" class="classification" data-placeholder="Выберите классификацию" style="width: 100%;">
              <option value=""></option>  
              @foreach($classifications as $classification)
                <option value="{{$classification->id}}">{{$classification->name}}</option>
                @endforeach
              </select>
              @error('classification_id')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
    
            <div class="form-group">
              <select name="supplier_id" class="supplier" data-placeholder="Выберите поставщика" style="width: 100%;">
                <option value=""></option>
                @foreach($suppliers as $supplier)
                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                @endforeach
              </select>
              @error('supplier_id')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
           </div>
  
          <div class="col-md-5">
              <!-- Аккордеон для дополнительных полей -->
              <div class="form-group">
                <div class="accordion" id="accordionExample">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Состав
                        </button>
                      </h2>
                    </div>
      
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body">
                        <textarea class="form-control" rows="4" value="{{ old('structure') }}" name="structure" placeholder="Состав ..." style="height: 104px;"></textarea>
                        @error('structure')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
      
                  <div class="card">
                    <div class="card-header" id="headingTwo">
                      <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Показания к применению
                        </button>
                      </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">
                        <textarea class="form-control" rows="4" value="{{ old('indications') }}" name="indications" placeholder="Показания к применению ..." style="height: 104px;"></textarea>
                        @error('indications')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
      
                  <!-- Поля для вставки в аккордеон -->
                  
      
                  <div class="card">
                    <div class="card-header" id="headingFour">
                      <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                          Противопоказания
                        </button>
                      </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                      <div class="card-body">
                        <textarea class="form-control" rows="4" value="{{ old('contraindications') }}" name="contraindications" placeholder="Противопоказания ..." style="height: 104px;"></textarea>
                        @error('contraindications')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
      
                  <div class="card">
                    <div class="card-header" id="headingFive">
                      <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                          Способ применения и дозы
                        </button>
                      </h2>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                      <div class="card-body">
                        <textarea class="form-control" rows="4" value="{{ old('methods') }}" name="methods" placeholder="Способ применения ..." style="height: 104px;"></textarea>
                        @error('methods')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
      
                  <div class="card">
                    <div class="card-header" id="headingSix">
                      <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                          Упаковка и условия отпуска из аптек
                        </button>
                      </h2>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                      <div class="card-body">
                        <textarea class="form-control" rows="4" value="{{ old('release') }}" name="release" placeholder="Форма выпуска ..." style="height: 104px;"></textarea>
                        @error('release')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Конец аккордеона -->
          </div >
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Добавить">
          <a href="{{ url()->previous() }}" class="btn btn-warning">Назад</a> 
        </div>
      </form>
    </div>
   
  </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<!-- Перемещаем скрипт перед закрывающимся тегом </body> -->
<script>
    function previewImages(event) {
        var preview = document.getElementById('image-preview1');
        preview.innerHTML = ''; // Очищаем содержимое элемента

        var files = event.target.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onload = function(event) {
                var img = document.createElement('img');
                img.src = event.target.result;
                img.style.maxWidth = '108px'; // Устанавливаем максимальную ширину для превью изображения
                img.style.marginRight = '5px'; // Добавляем немного отступа между изображениями
                img.style.marginBottom = '10px'; // Добавляем немного отступа между изображениями
                img.style.marginLeft = '5px'; // Добавляем немного отступа между изображениями

                preview.appendChild(img);
            }

            reader.readAsDataURL(file);
        }

        // Показываем кнопку "Удалить все изображения"
        document.getElementById('clearImagesBtn').style.display = 'block';
    }

    function removeAllImages() {
        var preview = document.getElementById('image-preview1');
        preview.innerHTML = ''; // Очищаем содержимое элемента
    }
</script>
@endsection
