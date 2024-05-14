@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Лекарство</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Лекарство/{{$medicine->name}}</li>
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
      <div class="">
        <div class="card">
          <div class="card-header d-flex ">
            <div class="mr-4 flex-grow-1">
              <a href="{{route('medicine.list.edit',$medicine->id)}}" class="btn btn-primary">Редактировать</a>
              <a href="{{route('medicine.list.index')}}" class="btn btn-warning">Назад</a>

            </div>
            <form action="{{route('medicine.list.destroy',$medicine->id)}}" method="post">
              @csrf
              @method('delete')
              <input type="submit" value="Удалить" class="btn btn-danger">
            </form>
          </div>

          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-wrap">

              <tbody>
                <tr>
                  <td>ID</td>
                  <td>{{$medicine->id}}</td>

                </tr>

                <tr>
                  <td>Название</td>
                  <td>{{$medicine->name}}</td>

                </tr>
                <tr>
                  <td>Описание</td>
                  <td style="max-width: 300px;">{{ mb_strlen($medicine->description, 'UTF-8') > 30 ? mb_substr($medicine->description, 0, 30, 'UTF-8') . '...' : $medicine->description }}</td>

                </tr>
                <tr>
                  <td>Цена</td>
                  <td style="max-width: 300px;">{{$medicine->price}}</td>

                </tr>
                <tr>
                  <td>Упаковка</td>
                  <td style="max-width: 300px;">{{$medicine->packaging}}</td>

                </tr>
                <tr>
                  <td>Дозировка</td>
                  <td style="max-width: 300px;">{{$medicine->dosage}}</td>

                </tr>
                <!-- Отображение статуса, классификации и поставщика -->
                <tr>
                  <td>Статус</td>
                  <td style="max-width: 300px;">{{$medicine->status->name}}</td>
                </tr>
                <tr>
                  <td>Классификация</td>
                  <td style="max-width: 300px;">{{$medicine->classification->name}}</td>
                </tr>
                <tr>
                  <td>Форма</td>
                  <td style="max-width: 300px;">{{$medicine->form->name}}</td>
                </tr>
                <tr>
                  <td>Состав</td>
                  <td style="max-width: 300px;">{{ mb_strlen($medicine->structure, 'UTF-8') > 30 ? mb_substr($medicine->structure, 0, 30, 'UTF-8') . '...' : $medicine->structure }}</td>
                </tr>
                <tr>
                  <td>Показания к применению</td>
                  <td style="max-width: 300px;">{{ mb_strlen($medicine->indications, 'UTF-8') > 30 ? mb_substr($medicine->indications, 0, 30, 'UTF-8') . '...' : $medicine->indications }}</td>
                </tr>
                <tr>
                  <td>Противопоказания</td>
                  <td style="max-width: 300px;">{{ mb_strlen($medicine->contraindications, 'UTF-8') > 30 ? mb_substr($medicine->contraindications, 0, 30, 'UTF-8') . '...' : $medicine->contraindications }}</td>
                </tr>
                <tr>
                  <td>Способ применения и дозы</td>
                  <td style="max-width: 300px;">{{ mb_strlen($medicine->methods, 'UTF-8') > 30 ? mb_substr($medicine->methods, 0, 30, 'UTF-8') . '...' : $medicine->methods }}</td>
                </tr>
                <tr>
                  <td>Упаковка и условия отпуска из аптек</td>
                  <td style="max-width: 300px;">{{ mb_strlen($medicine->release, 'UTF-8') > 30 ? mb_substr($medicine->release, 0, 30, 'UTF-8') . '...' : $medicine->release }}</td>
                </tr>

                <tr>
                  <td>Фото</td>
                  <td style="max-width: 300px;">
                    @foreach ($medicine->medicineImages as $image)
                    <img src="{{$image->image_url }}" alt="Image" style="max-height: 100px; max-width: 100px;">
                    @if (!$loop->last)
                    &nbsp; <!-- чтобы добавить пробел после каждого изображения, кроме последнего -->
                    @endif
                    @endforeach
                  </td>
                </tr>

                <tr>
                  <td>Поставщик</td>
                  <td style="max-width: 300px;">{{$medicine->supplier->name}}</td>
                </tr>
                <!-- /Отображение статуса, классификации и поставщика -->


              </tbody>
            </table>
          </div>

        </div>

      </div>

    </div>

  </div>


</section>
@endsection