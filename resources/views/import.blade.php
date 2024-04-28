@extends('layouts.app')
@section('content')
<a href="/public/products" class="btn btn-success my-5 ms-5"> Главная</a>
<div class="container my-5">
    <h3 class="text-center my-5">Импорт Excel(.xlsx, .xls) файла</h3>
    <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" class="form-control" name="file">
        <button type="submit" class="btn btn-primary my-3">Импорт</button>
    </form>
        @if($errors->any())
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
@endsection