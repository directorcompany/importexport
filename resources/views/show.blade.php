@extends('layouts.app')
@section('content')
<!-- Дополнительные поля и изображения можно вывести здесь -->
<div class="row my-5 ms-5">
<div class="col-4">
    <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
    <div class="carousel-inner">
      @foreach($images as $key=>$value)
    <div class="carousel-item {{$key==0 ? 'active' :''}} w-100 h-75">
      <img src="/public/storage/{{$value->path}}" class="d-block w-100" alt="">
    </div>
      @endforeach
    </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
  </div>
</div>

 <div class="col">
<div class="main">
<div class="accordion" id="accordionPanelsStayOpenExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
       Главная
      </button>
    </h2>
    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
      <div class="accordion-body">
          <h4>Наименование: {{$products->name}}</h4>
  <div class="col-group">
    <h5 class="">Описание:</h5>
    <p>{{$products->description}}</p>  
  </div>
  <h5>
    Цена:
    <span class="text-primary">{{$products->price}}</span> 
  </h5>
  <h5>Внешний код: <span class="text-secondary">{{$products->external_code}}</span></h5>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
   Дополнительные
      </button>
    </h2>
    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
      <div class="accordion-body">
         <div class="row">
    
    @foreach($fields as $key=>$value)
    <div class="col-6 my-2">
      <h5>{{$key}}:</h5>
      <span class="fs-6">{{$value}}</span>
    </div>
    @endforeach
  </div>
      </div>
    </div>
  </div> 
</div>
</div>
</div>
@endsection