@extends('layouts.app')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card text-center">
            <div class="card-header">Добавление нового товара</div>

            <div class="card-body">
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
                        <th scope="row">1</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td class="w-50">
                            <div class="row d-flex justify-content-end">
                            <form action="" class="col-md-2">
                                <button type="submit" class="btn btn-outline-info">Update</button>
                            </form>

                            <form action="" class="col-md-2">
                                <button type="submit" class="btn btn-outline-warning">Edit</button>
                            </form>

                            <form action="" class="col-md-2">
                                <button type="submit" class="btn btn-outline-danger">Remove</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
