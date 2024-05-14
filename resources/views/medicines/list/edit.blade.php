@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Редактировать лекарство</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Главная/Редактировать лекарство</li>
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
      <form action="{{ route('medicine.list.update', $medicine->id) }}" method="post" style="width:100%" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="d-flex">
          <div class="col-md-6 mr-5">
            <div class="form-group">
              <input type="text" class="form-control" name="name" value="{{ $medicine->name }}" style="width:250px" placeholder="Название">
              @error('name')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group" style="width:400px">
              <label>Описание</label>
              <textarea class="form-control" rows="4" name="description" placeholder="Введите ..." style="height: 104px;">{{ $medicine->description }}</textarea>
              @error('description')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group" style="width:500px">
              <input type="text" class="form-control" name="price" style="width:150px" value="{{ $medicine->price }}" placeholder="Цена">
              @error('price')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">

              <input type="text" class="form-control" name="packaging" value="{{ $medicine->packaging }}" placeholder="Кол-во препарата в упаковке">
              @error('packaging')
              <div class="text-danger">{{ $message }}</div>
              @enderror

            </div>

            <div class="form-group">
    <div class="input-group">
        <input type="text" class="form-control" name="dosage_value" value="{{ explode(' ', $medicine->dosage)[0] }}" placeholder="Дозировка">
        <select name="dosage_unit" class="form-control">
            <option value="мг" {{ explode(' ', $medicine->dosage)[1] == 'мг' ? 'selected' : '' }}>мг</option>
            <option value="г" {{ explode(' ', $medicine->dosage)[1] == 'г' ? 'selected' : '' }}>г</option>
            <option value="мл" {{ explode(' ', $medicine->dosage)[1] == 'мл' ? 'selected' : '' }}>мл</option>
            <option value="мг/г" {{ explode(' ', $medicine->dosage)[1] == 'мг/г' ? 'selected' : '' }}>мг/г</option>
            <option value="мг/мл" {{ explode(' ', $medicine->dosage)[1] == 'мг/мл' ? 'selected' : '' }}>мг/мл</option>
          </select>
        </div>
        @error('dosage_value')
              <div class="text-danger">{{ $message }}</div>
              @enderror 
</div>

            <div class="form-group">
              <input type="text" class="form-control" name="atx" value="{{ $medicine->atx }}" placeholder="Фармакотерапевтическая группа, ATX">
              @error('atx')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="d-flex flex-column">
              <label>Старые изображения</label>
              <div class=" d-flex flex-wrap">


                @foreach($medicine->medicineImages as $image)
                <div class="form-group d-flex flex-column align-items-center">
                  <img src="{{ $image->image_url }}" alt="Image" style="max-width: 200px; margin-right: 15px;">
                  <button type="button" class="btn btn-danger mt-2" onclick="deleteImage(event, {{ $image->id }})">Удалить</button>
                </div>
                @endforeach
              </div>

            </div>
            <!-- Показ изображений -->

            <div class="form-group">
              <label for="image_url">Добавить новые изображения</label>
              <div class="d-flex" style="width:400px">
                <input type="file" id="image_url" name="image_url[]" class="form-control" multiple onchange="previewImages(event)">
              </div>
              <div class="d-flex flex-column mt-2 " style="max-width: 670px;">
                <div id="preview-images-zone" class="d-flex flex-wrap justify-content-start"></div>
                <button type="button" class="btn btn-danger  mt-2 d-none w-25 " id="clearImagesBtn" onclick="clearImages()">Удалить все изображения</button>

              </div>

            </div>

            <input type="hidden" id="deleted_images" name="deleted_images[]" value="">
            <!-- Скрытое поле для хранения идентификаторов удаленных изображений -->

            <div class="form-group" style="width:400px">
              <select name="status_id" class="status" data-placeholder="Выберите статус" style="width: 100%;">
                <option value=""></option>
                @foreach($statuses as $status)
                <option value="{{ $status->id }}" {{ $status->id == $medicine->status_id ? 'selected' : '' }}>{{ $status->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group " style="width:400px">
              <select name="form_id" class="form" data-placeholder="Выберите форму" style="width: 100%;">
                @foreach($forms as $form)
                <option value="{{ $form->id }}" {{ $form->id == $medicine->form_id ? 'selected' : '' }}>{{ $form->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group" style="width:400px">
              <select name="classification_id" class="classification" data-placeholder="Выберите классификацию" style="width: 100%;">
                @foreach($classifications as $classification)
                <option value="{{ $classification->id }}" {{ $classification->id == $medicine->classification_id ? 'selected' : '' }}>{{ $classification->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group" style="width:400px">
              <select name="supplier_id" class="supplier" data-placeholder="Выберите поставщика" style="width: 100%;">
                <option value=""></option>
                @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ $supplier->id == $medicine->supplier_id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                @endforeach
              </select>
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
                      <textarea class="form-control" rows="4" name="structure" placeholder="Состав ..." style="height: 104px;">{{$medicine->structure}}</textarea>
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
                      <textarea class="form-control" rows="4" name="indications" placeholder="Показания к применению ..." style="height: 104px;">{{$medicine->indications}}</textarea>
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
                      <textarea class="form-control" rows="4" name="contraindications" placeholder="Противопоказания ..." style="height: 104px;">{{$medicine->contraindications}}</textarea>
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
                      <textarea class="form-control" rows="4" value="{{ old('methods') }}" name="methods" placeholder="Способ применения ..." style="height: 104px;">{{$medicine->methods}}</textarea>
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
                      <textarea class="form-control" rows="4" value="{{ old('release') }}" name="release" placeholder="Форма выпуска ..." style="height: 104px;">{{$medicine->release}}</textarea>
                      @error('release')
                      <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Конец аккордеона -->
          </div>
        </div>
        <div class="form-group" style="width:400px">
          <input type="submit" class="btn btn-primary" value="Обновить">
          <a href="{{ route('medicine.list.show',$medicine->id) }}" class="btn btn-warning">Отменить редактирование</a>
        </div>
    


      </form>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<!-- Перемещаем скрипт перед закрывающимся тегом </body> -->
<script>
  function deleteImage(event, imageId) {
    event.target.parentElement.remove(); // Удаляем родительский элемент (с изображением и кнопкой)

    // Создаем скрытое поле для передачи информации о удаленном изображении
    var deletedInput = document.createElement('input');
    deletedInput.type = 'hidden';
    deletedInput.name = 'deleted_images[]';
    deletedInput.value = imageId;

    // Проверяем, существует ли элемент с именем 'deleted_images'
    var deletedImagesInput = document.querySelector('input[name="deleted_images[]"]');
    if (!deletedImagesInput) {
      // Если элемент не существует, создаем новое скрытое поле с пустым значением
      deletedInput.value = '';
    }

    // Добавляем скрытое поле в форму
    document.querySelector('form').appendChild(deletedInput);

    // Показываем кнопку "Удалить все изображения"
    // document.getElementById('clearImagesBtn').classList.remove('d-none');
  }

  function previewImages(event) {
    var previewZone = document.getElementById('preview-images-zone');

    var files = event.target.files;
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = document.createElement('img');
            img.src = e.target.result;
            img.style.maxWidth = '200px';
            img.style.marginRight = '15px';
            img.style.marginBottom = '5px';
            previewZone.appendChild(img);
        };
        reader.readAsDataURL(file);
    }


document.getElementById('clearImagesBtn').classList.remove('d-none');
}

function clearImages() {
    var previewZone = document.getElementById('preview-images-zone');
    previewZone.innerHTML = ''; // Очищаем содержимое
    document.getElementById('image_url').value = ''; // Очищаем поле ввода файла

    // Скрываем кнопку "Удалить все изображения"
    document.getElementById('clearImagesBtn').classList.add('d-none');
}
</script>
@endsection
