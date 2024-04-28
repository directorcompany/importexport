@extends('layouts.app')
@section('content')
<div class="container my-5">
<h2 class="text-center">Все товары</h2>
<a href="{{route('import')}}" class="btn btn-success">Импорт</a>
@if(count($stores))
<a href="{{route('export')}}" class="btn btn-primary ms-5">Экспорт</a>
@endif
    @if(session('success'))
    <div class="alert alert-success my-3" role="alert">
        {{ session('success') }}
    </div>
    @elseif($errors->any())
    <div class="form-group">
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            <ul>
                <li> {{ $error }} </li>
            </ul>
        </div>
        @endforeach
      </div>
    @endif
</div>
@if(count($stores))
<table class="table table-hover table-bordered">
  <thead>
    <tr class="text-center">
      <th scope="col">#</th>
      <th scope="col">Внешний код</th>
      <th scope="col">Наименование</th>
      <th scope="col">Описание</th>
      <th scope="col">Цена:Цена продажи</th>
      <th scope="col">Скидка</th>
      @for($i=5; $i<count($names); $i++) 
      <th scope="col"> {{$names[$i]}} </th>    
      @endfor
      <th scope="col">Действия:</th>
  </tr>
  </thead>
  <tbody>
    @for($i=0; $i<count($stores); $i++)
    <tr>
      <th scope="row">{{$i+1}}</th>
      @foreach($names as $name)
    <td>{{ $stores[$i][$name] }}</td>
    @endforeach
    <td><a href="products/{{$products[$i]->id}}" class="btn btn-primary">Показать</a></td>
  </tr>
    @endfor
  </tbody>
 </table>
 @endif
    <div>
        <!-- Дополнительные поля и изображения можно вывести здесь -->
    </div>
</div>
@endsection