<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pekara Sales') }}</title>

    <link rel="icon" href="public/assets/img/PekaraLogo_1.png" type="image/png">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
{{--    <link href="/resources/css/app.css" rel="stylesheet">--}}

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-secondary">

<nav class="navbar navbar-expand-lg bg-warning-subtle position-fixed z-1 w-100">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img class="img-fluid" src="/assets/img/PekaraLogo_1.png" alt="Slovenska Pekara" style="max-height: 40px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @auth
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">Продажа</a>
                    </li>
                    @if(Auth::user()->role === 'admin')

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Товары
                            </a>

                            <div class="dropdown-menu dropdown-menu-end bg-warning-subtle"
                                 aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.products') }}">
                                    Все товары
                                </a>
                                <a class="dropdown-item" href="{{ route('create') }}">
                                    Добавить новый товар
                                </a>

                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Отчеты
                            </a>

                            <div class="dropdown-menu dropdown-menu-end bg-warning-subtle"
                                 aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.reports') }}">
                                    Дневной отчет
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.reports.yesterday') }}">
                                    Продажи за {{ \Carbon\Carbon::yesterday()->format('d-m-Y') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.reports.calcmonthly') }}">
                                    Месячный отчет
                                </a>
                                <a class="dropdown-item disabled" href="{{ route('admin.reports') }}">
                                    Отчет списания(в разработке)
                                </a>
                                <a class="dropdown-item disabled" href="{{ route('admin.reports') }}">
                                    Отчет о продажах сотрудников(в разработке)
                                </a>

                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Расходы
                            </a>

                            <div class="dropdown-menu dropdown-menu-end bg-warning-subtle"
                                 aria-labelledby="navbarDropdown">
                                <a class="dropdown-item disabled" href="{{ route('admin.reports') }}">
                                    Зарплата (в разработке)
                                </a>
                                <a class="dropdown-item disabled" href="{{ route('admin.reports') }}">
                                    Другие расходы (в разработке)
                                </a>

                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Склад
                            </a>

                            <div class="dropdown-menu dropdown-menu-end bg-warning-subtle"
                                 aria-labelledby="navbarDropdown">
                                <a class="dropdown-item disabled" href="{{ route('admin.reports') }}">
                                    Остатки (в разработке)
                                </a>
                                <a class="dropdown-item disabled" href="{{ route('admin.reports') }}">
                                    Поставки (в разработке)
                                </a>
                                <a class="dropdown-item disabled" href="{{ route('admin.reports') }}">
                                    Списание (в разработке)
                                </a>

                            </div>
                        </li>
                    @endif
                </ul>

                <ul class="navbar-nav ms-auto">
                    @if(request()->is('home'))

                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" name="search" placeholder="Поиск по названию"
                                   aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart') }}">Открытый чек
                            @if(session()->get('cart', []))
                                <span class="badge text-bg-info">New</span>
                            @endif
                        </a>
                    </li>


                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Выйти') }}
                            </a>
                            @if(Auth::user()->role === 'admin')
                                <a class="dropdown-item" href="{{ route('register') }}">Добавить сотрудника</a>
                            @endif

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endauth
                </ul>
        </div>
    </div>
</nav>


<main class="py-4">
    <div class="container mt-5">
        @yield('content')
    </div>
</main>
</body>
</html>
