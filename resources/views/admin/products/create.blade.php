@extends('layouts.app')
@section('content')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card text-center">
                    <div class="card-header">Добавление нового товара</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Наименование товара" required>
                                <label for="name">Наименование товара</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('description')is-invalid @enderror" id="description" name="description" value="{{ old('description') }}" placeholder="Описание товара" required>
                                <label for="description">Описание товара</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('price')is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" placeholder="Цена" required>
                                <label for="price">Цена(€)</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('quantity')is-invalid @enderror" id="quantity" name="quantity"  value="{{ old('quantity') }}" placeholder="Количество товара на складе" required>
                                <label for="quantity">Количество товара на складе</label>
                            </div>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control @error('thumbnail')is-invalid @enderror" id="thumbnail" name="thumbnail" value="{{ old('thumbnail') }}">
                                <label class="input-group-text" for="thumbnail">Фото продукта</label>
                            </div>

                            <button type="submit" class="btn btn-outline-success">Добавить товар</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
@endsection
