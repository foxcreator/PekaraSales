@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                    <div class="row justify-content-center d-flex">
                        @if($search)
                            <div class="container text-center mb-4">
                                <a class="btn btn-outline-success " aria-current="page" href="{{ route('home') }}">Все товары</a>
                            </div>
                        @endif
                        @foreach($products as $product)

{{--                            @dd($product->on_sale)--}}
                            @if($product->on_sale != 0)
                                <div class="card col-md-3 me-3 mb-3" style="width: 18rem;">
                                    <img src="assets/img/PekaraLogo_1.png" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $product->name }}</h4>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Цена: {{ $product->price }}€</li>
                                            <li class="list-group-item">Остаток: {{ $product->quantity }}</li>
                                        </ul>
                                        <div class="row">
                                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                                    <input type="hidden" name="name" value="{{ $product->name }}">
                                                    <input type="hidden" name="price" value="{{ $product->price }}">
                                                    @if($product->quantity > 0)
                                                    <input type="number" class="col-md-2" name="quantity" value="1" min="1" max="{{ $product->quantity }}"> <!-- Поле для выбора количества продукта -->
                                                    <button class="btn btn-info col-md-4" type="submit">В чек</button>
                                                    @endif
                                                </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                            {{ $products->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
