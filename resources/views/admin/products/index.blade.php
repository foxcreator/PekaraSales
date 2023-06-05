@extends('layouts.app')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card text-center">
            <div class="card-header">Все товары</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Thumbnail</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col" colspan=""></th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                    <tr>
                        <form action="/product/update/{{ $product->id }}" method="POST">
                            @csrf
                        <th scope="row">1</th>
                        <td>{{ $product->name }}</td>
                        <td>
                            <input class="form-control text-center" type="text" name="price" value="{{ $product->price }}">
                        </td>
                        <td>
                            <input type="text" class="form-control text-center" name="quantity" value="{{ $product->quantity }}">
                        </td>
                        <td class="w-50">
                        <div class="row d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-info col-md-2 me-2">Update</button>

                            <button type="submit" class="btn btn-outline-warning col-md-2 me-2">Edit</button>
                            <form action="">
                                <button type="submit" class="btn btn-outline-danger col-md-2">Remove</button>
                            </form>
                        </div>
                        </td>
                        </form>
                    </tr>
                    @endforeach
                    </tbody>
                    {{ $products->links() }}
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
