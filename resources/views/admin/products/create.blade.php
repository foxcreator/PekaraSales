@extends('layouts.app')
@section('content')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card text-center">
                    <div class="card-header">Добавление нового товара</div>

                    <div class="card-body">
                        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Наименование товара" required>
                                <label for="name">Наименование товара</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="description" name="description" placeholder="Описание товара" required>
                                <label for="description">Описание товара</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="price" name="price" placeholder="Цена" required>
                                <label for="price">Цена(€)</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Количество товара на складе" required>
                                <label for="quantity">Количество товара на складе</label>
                            </div>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                                <label class="input-group-text" for="thumbnail">Фото продукта</label>
                            </div>

                            <button type="submit" class="btn btn-outline-success">Добавить товар</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
@endsection
