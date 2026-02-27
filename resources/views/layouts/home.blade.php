<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Product Catalogue') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <style>
        body { margin: 0; background: #f0f2f5; font-family: 'Roboto', sans-serif; }

        /* ═══ HEADER ═══ */
        .home-header {
            background: #1B3A5C;
            box-shadow: 0 2px 12px rgba(0,0,0,0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .home-header-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 68px;
        }
        .home-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
        }
        .home-brand:hover { text-decoration: none; }
        .home-brand img {
            height: 44px;
            border-radius: 6px;
        }
        .home-brand-text h5 {
            color: #C8941A;
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .home-brand-text small {
            color: rgba(255,255,255,0.5);
            font-size: 12px;
        }
        .home-actions {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .home-actions .btn-admin {
            color: #fff;
            text-decoration: none;
            padding: 7px 18px;
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .home-actions .btn-admin:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.4);
            text-decoration: none;
            color: #fff;
        }
        .home-actions .btn-export {
            background: #C8941A;
            color: #1B3A5C;
            border: none;
            font-weight: 600;
            border-radius: 6px;
            padding: 8px 22px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .home-actions .btn-export:hover {
            background: #d9a52e;
        }
        .home-user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255,255,255,0.8);
            font-size: 14px;
        }
        .home-user-info .user-name {
            font-weight: 500;
        }
        .home-user-info .user-divider {
            width: 1px;
            height: 20px;
            background: rgba(255,255,255,0.2);
        }
        .home-user-info .btn-logout {
            color: rgba(255,255,255,0.55);
            font-size: 13px;
            text-decoration: none;
            transition: color 0.2s;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }
        .home-user-info .btn-logout:hover {
            color: #C8941A;
        }

        /* ═══ FILTER BAR ═══ */
        .filter-bar {
            background: #fff;
            border-bottom: 1px solid #e4e7eb;
            padding: 16px 0;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }
        .filter-bar-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
        }
        .filter-bar .form-control,
        .filter-bar .form-select {
            border-radius: 6px;
            border: 1.5px solid #dce0e4;
            font-size: 14px;
            height: 38px;
        }
        .filter-bar .form-control:focus,
        .filter-bar .form-select:focus {
            border-color: #1B3A5C;
            box-shadow: 0 0 0 2px rgba(27,58,92,0.1);
        }
        .filter-bar .btn {
            height: 38px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            padding: 0 18px;
        }
        .filter-bar .btn-search {
            background: #1B3A5C;
            color: #fff;
            border: none;
        }
        .filter-bar .btn-search:hover {
            background: #243f5f;
        }
        .filter-bar .btn-share {
            background: transparent;
            color: #1B3A5C;
            border: 1.5px solid #dce0e4;
        }
        .filter-bar .btn-share:hover {
            border-color: #1B3A5C;
            background: rgba(27,58,92,0.04);
        }

        /* ═══ PRODUCT GRID ═══ */
        .products-section {
            max-width: 1400px;
            margin: 0 auto;
            padding: 28px 30px 40px;
        }
        .products-count {
            font-size: 14px;
            color: #888;
            margin-bottom: 16px;
        }
        .products-count strong {
            color: #1B3A5C;
        }

        /* ═══ FOOTER ═══ */
        .home-footer {
            background: #1B3A5C;
            color: rgba(255,255,255,0.7);
            padding: 48px 0 0;
        }
        .home-footer-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 30px;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 40px;
        }
        .footer-col h5 {
            color: #C8941A;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 16px;
        }
        .footer-col p {
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 6px;
        }
        .footer-col a {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 14px;
            display: block;
            padding: 4px 0;
            transition: color 0.2s;
        }
        .footer-col a:hover {
            color: #C8941A;
        }
        .footer-contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .footer-contact-item i {
            font-size: 18px;
            color: #C8941A;
            width: 20px;
            text-align: center;
        }
        .footer-bottom {
            margin-top: 36px;
            padding: 18px 0;
            border-top: 1px solid rgba(255,255,255,0.08);
            text-align: center;
            font-size: 13px;
            color: rgba(255,255,255,0.35);
        }
        .footer-bottom-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 30px;
        }

        /* ═══ RESPONSIVE ═══ */
        @media (max-width: 768px) {
            .home-header-inner { padding: 0 16px; }
            .home-actions .btn-admin span { display: none; }
            .home-footer-inner { grid-template-columns: 1fr; gap: 28px; }
            .filter-bar-inner { padding: 0 16px; }
            .products-section { padding: 20px 16px 30px; }
        }
    </style>
</head>

<body>
    {{-- ═══ HEADER ═══ --}}
    <header class="home-header">
        <div class="home-header-inner">
            <a href="{{ url('/') }}" class="home-brand">
                @if(isset($company) && $company && $company->cover_image)
                    <img src="{{ asset('images/' . $company->cover_image) }}" alt="Logo">
                @endif
                <div class="home-brand-text">
                    <h5>{{ isset($company) && $company ? $company->company_name : config('app.name', 'Product Catalogue') }}</h5>
                    <small>Product Catalogue</small>
                </div>
            </a>

            <div class="home-actions">
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ url('products') }}" class="btn-admin">
                            <i class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">settings</i>
                            <span>Admin Panel</span>
                        </a>
                    @endif

                    <button type="button" class="btn-export" data-toggle="modal" data-target="#exportModal">
                        <i class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">picture_as_pdf</i>
                        Export PDF
                    </button>

                    <div class="home-user-info">
                        <div class="user-divider"></div>
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <a href="{{ route('logout') }}" class="btn-logout"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    {{-- ═══ MAIN CONTENT ═══ --}}
    <main>
        @yield('content')
    </main>

    {{-- ═══ FOOTER ═══ --}}
    <footer class="home-footer">
        <div class="home-footer-inner">
            <div class="footer-col">
                <h5>{{ isset($company) && $company ? $company->company_name : config('app.name', 'Product Catalogue') }}</h5>
                <p style="color: rgba(255,255,255,0.5); max-width: 360px;">
                    Your trusted source for quality products. Browse our catalogue and find exactly what you need.
                </p>
            </div>
            <div class="footer-col">
                <h5>Quick Links</h5>
                <a href="{{ url('/') }}">Browse Products</a>
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ url('products') }}">Admin Panel</a>
                        <a href="{{ url('company-settings') }}">Company Settings</a>
                    @endif
                @endauth
            </div>
            <div class="footer-col">
                <h5>Contact</h5>
                @if(isset($company) && $company)
                    @if($company->address)
                        <div class="footer-contact-item">
                            <i class="material-icons">place</i>
                            <span>{{ $company->address }}</span>
                        </div>
                    @endif
                    @if($company->phone)
                        <div class="footer-contact-item">
                            <i class="material-icons">phone</i>
                            <span>{{ $company->phone }}</span>
                        </div>
                    @endif
                    @if($company->email)
                        <div class="footer-contact-item">
                            <i class="material-icons">email</i>
                            <span>{{ $company->email }}</span>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-bottom-inner">
                &copy; {{ date('Y') }} {{ isset($company) && $company ? $company->company_name : config('app.name', 'Product Catalogue') }}. All rights reserved.
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>

</html>
