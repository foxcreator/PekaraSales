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
                    <h1>Добавление нового ингредиента</h1>
                        <form action="{{ route('admin.stock.store') }}" method="POST">
                            @csrf
                            <div id="input-container">
                                <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Наименование" name="name[]" aria-label="Title">
                                        <span class="input-group-text">@</span>
                                        <input type="text" class="form-control" placeholder="Цена" aria-label="Price" name="price[]">
                                        <span class="input-group-text">@</span>
                                        <input type="text" class="form-control" placeholder="Количество" aria-label="Quantity" name="quantity[]">
                                        <button class="btn btn-outline-info" type="button" onclick="addInput()">Добавить еще</button>
                                </div>
                            </div>
                            <button class="btn btn-outline-info" type="submit">Отправить</button>

                        </form>

                </div>
            </div>
        </div>
        <script>

            var counter = 1; // Счетчик для уникальных идентификаторов

            function addInput(event) {
                // event.preventDefault(); // Предотвращаем отправку формы

                var inputContainer = document.getElementById("input-container");

                if (inputContainer) {
                    var newInputGroup = document.createElement("div");
                    newInputGroup.classList.add("input-group", "mb-3");

                    // Создание инпутов и кнопки с одинаковыми name атрибутами
                    var nameInput = createInput("Наименование", "name[]");
                    var atSymbol1 = createSpan("@");
                    var priceInput = createInput("Цена", "price[]");
                    var atSymbol2 = createSpan("@");
                    var quantityInput = createInput("Количество", "quantity[]");
                    var addButton = createButton("Добавить еще");

                    newInputGroup.appendChild(nameInput);
                    newInputGroup.appendChild(atSymbol1);
                    newInputGroup.appendChild(priceInput);
                    newInputGroup.appendChild(atSymbol2);
                    newInputGroup.appendChild(quantityInput);
                    newInputGroup.appendChild(addButton);

                    inputContainer.appendChild(newInputGroup);

                    counter++; // Увеличение счетчика
                }
            }

            function createInput(placeholder, name) {
                var input = document.createElement("input");
                input.type = "text";
                input.classList.add("form-control");
                input.placeholder = placeholder;
                input.name = name;
                return input;
            }

            function createSpan(text) {
                var span = document.createElement("span");
                span.classList.add("input-group-text");
                span.textContent = text;
                return span;
            }

            function createButton(text) {
                var button = document.createElement("button");
                button.type = "button";
                button.classList.add("btn", "btn-outline-info");
                button.textContent = text;
                button.addEventListener("click", addInput);
                return button;
            }


        </script>
@endsection


