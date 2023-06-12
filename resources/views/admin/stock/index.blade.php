@extends('layouts.app')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-header">Склад</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Наименование</th>
                                <th scope="col">Цена за кг</th>
                                <th scope="col" class="d-flex justify-content-end">Остаток (кг)</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ingridients as $ingridient)
                                <tr>
                                    <td>{{ $ingridient->name }}</td>
                                    <td>{{ $ingridient->price }}€</td>
                                    <td class="d-flex justify-content-end">{{ $ingridient->quantity }}
                                        <button class="btn btn-outline-info ms-2">+</button>
                                    </td>
                                    <td>
                                            <button type="button" class="btn btn-outline-danger ms-2" data-bs-toggle="modal" data-bs-target="#deleteIngridient">
                                                Удалить продукт
                                            </button>
                                    </td>

                                    <div class="modal fade" id="deleteIngridient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Подтверждение</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Удаление невозможно отменить. <br>
                                                    Вы уверены что хотите удалить {{ $ingridient->name }}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Отмена</button>
                                                    <form action="{{ route('admin.stock.delete', $ingridient->id) }}" method="POST">

                                                        @csrf
                                                        <button class="btn btn-danger" type="submit">Удалить безвозвратно</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>


@endsection

