@extends('layouts.app')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-header">Отчет с {{ $dates['ondate'] }} по {{ $dates['todate'] }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <form class="row justify-content-end" action="{{ route('admin.reports.calcmonthly') }}" method="GET">
                            @csrf
                            <div class="col-auto">
                                <label for="ondate" class="visually-hidden">Email</label>
                                <input type="date" class="form-control" id="ondate" name="ondate" value="{{ $dates['ondate'] }}" max="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-auto">
                                <label for="todate" class="visually-hidden">Password</label>
                                <input type="date" class="form-control" id="todate" name="todate" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-dark mb-3">Выбрать даты</button>
                            </div>
                        </form>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Наименование</th>
                            <th scope="col">Цена за единицу</th>
                            <th scope="col">Продано(шт)</th>
                            <th scope="col">Сумма продаж</th>
                            <th scope="col">Валовая прибыль</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productsSold as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}€</td>
                                <td>{{ $product->total_sold }}</td>
                                <td>{{ $product->total_sold * $product->price}}€</td>
                                @endforeach
                                <td rowspan="{{ count($productsSold) }}"><h2>{{ $totalSales }}€</h2></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


