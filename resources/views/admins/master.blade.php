@php

$customers_count = 0 ;
$deleted_customers_count = 0 ;
$customers_invoices = 0 ;
$employees = 0 ;
$deleted_employees = 0 ;
$deleted_customers_invoices = 0 ;
$logs_count = 0 ;

if( auth()->user()->id == 1 ){
$customers_count = App\Models\Customer::count() ;
$customers_invoices = App\Models\CustomerInvoice::count() ;
$employees = App\Models\User::where("id", "!=", auth()->user()->id)->count();
$deleted_employees = App\Models\User::onlyTrashed()->count();
$deleted_customers_count = App\Models\Customer::onlyTrashed()->count();
$deleted_customers_invoices = App\Models\CustomerInvoice::onlyTrashed()->count();
$logs_count = App\Models\Logs::count();
}else{
$customers_count = App\Models\Customer::where("created_by", auth()->user()->id)->count() ;
$customers_invoices = App\Models\CustomerInvoice::where("created_by", auth()->user()->id)->count() ;
$logs_count = App\Models\Logs::where("user_id", auth()->user()->id)->count();
}

$user = auth()->user();

@endphp

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="/docs/5.3/assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Product example · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/product/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#712cf9">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="product.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>


    <nav class="navbar navbar-expand-md bg-dark sticky-top border-bottom" data-bs-theme="dark">
        <div class="container-fluid">

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
                <div class="offcanvas-body">
                    <ul class="navbar-nav flex-grow-1 justify-content-between">

                        <span class="btn btn-primary" style="padding: 0px">
                            <img src="{{ auth()->user()->image }}"
                                style="width: 20px; height: 20px; border-radius: 50%;">
                            Hi, {{ auth()->user()->name }}</span>


                        @if ( $user->id == 1 || $user->can('show customer') )
                        <li class="nav-item"><a class="nav-link" style="color: #fff !important;"
                                href="{{ route('customers.index') }}">Customer <span class="badge text-bg-danger">{{
                                    $customers_count }}</span></a></li>
                        @endif

                        @if ( $user->id == 1 || $user->can('restore customer') )
                        <li class="nav-item"><a class="nav-link" style="color: #fff !important;"
                                href="{{ route('deleted_customers') }}">Restore
                                Customers <span class="badge text-bg-danger">{{ $deleted_customers_count }}</span></a>
                        </li>
                        @endif

                        @if ( $user->id == 1 || $user->can('show invoice') )
                        <li class="nav-item"><a class="nav-link" style="color: #fff !important;"
                                href="{{ route('invoices.index') }}">Invoices <span class="badge text-bg-danger">{{
                                    $customers_invoices }}</span></a>
                        </li>
                        @endif

                        @if ( $user->id == 1 || $user->can('restore invoice') )
                        <li class="nav-item"><a class="nav-link" style="color: #fff !important;"
                                href="{{ route('deleted_invoices') }}">Restore Invoices <span
                                    class="badge text-bg-danger">{{
                                    $deleted_customers_invoices }}</span></a>
                        </li>
                        @endif

                        @if ($user->id == 1)
                        <li class="nav-item"><a class="nav-link" style="color: #fff !important;"
                                href="{{ route('employee.index') }}">Employees<span class="badge text-bg-danger">{{
                                    $employees }}</span></a>
                        </li>

                        <li class="nav-item"><a class="nav-link" style="color: #fff !important;"
                                href="{{ route('deleted_employee') }}">Restore Employees<span
                                    class="badge text-bg-danger">{{
                                    $deleted_employees }}</span></a>
                        </li>
                        @endif



                        @if ($user->id == 1)
                        <li class="nav-item"><a class="nav-link" style="color: #fff !important;"
                                href="{{ route('logs.index') }}">System
                                Logs <span class="badge text-bg-danger">{{
                                    $logs_count }}</span></a></li>

                        <li class="nav-item"><a class="nav-link" style="color: #fff !important;"
                                href="{{ route('invoice_search') }}">Invoice Advanced Search</a>
                        </li>
                        @endif

                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link" style="color: #fff;">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div style="width: 80%; margin: auto; margin-top: 40px; padding: 20px;">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @yield('content')
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>