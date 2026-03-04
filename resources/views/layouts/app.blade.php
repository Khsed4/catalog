<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - {{ config('app.name', 'Product Catalogue') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
</head>

<body>
    {{-- ═══ SIDEBAR ═══ --}}
    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            <i class="material-icons" style="font-size: 28px; color: #C8941A;">inventory_2</i>
            <div>
                <h4>Admin Panel</h4>
                <small>Catalogue Manager</small>
            </div>
        </div>

        <ul class="sidebar-nav">
            <li class="{{ Request::is('products') ? 'active' : '' }}">
                <a href="{{ url('products') }}">
                    <i class="material-icons">shopping_cart</i>
                    <span>Products</span>
                </a>
            </li>
            <li class="{{ Request::is('categories') ? 'active' : '' }}">
                <a href="{{ url('categories') }}">
                    <i class="material-icons">category</i>
                    <span>Categories</span>
                </a>
            </li>
            <li class="{{ Request::is('catalogues') ? 'active' : '' }}">
                <a href="{{ url('catalogues') }}">
                    <i class="material-icons">menu_book</i>
                    <span>Catalogues</span>
                </a>
            </li>
            <li class="{{ Request::is('users') ? 'active' : '' }}">
                <a href="{{ url('users') }}">
                    <i class="material-icons">people</i>
                    <span>Users</span>
                </a>
            </li>
            <li class="{{ Request::is('company-settings') ? 'active' : '' }}">
                <a href="{{ url('company-settings') }}">
                    <i class="material-icons">settings</i>
                    <span>Company Settings</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <a href="{{ url('/') }}" class="sidebar-footer-link">
                <i class="material-icons">arrow_back</i>
                <span>Back to Website</span>
            </a>
            @auth
            <div class="sidebar-user">
                <i class="material-icons">account_circle</i>
                <div>
                    <span class="sidebar-user-name">{{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" class="sidebar-logout"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </aside>

    {{-- ═══ MAIN CONTENT ═══ --}}
    <div class="admin-main">
        <main>
            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>

</html>
