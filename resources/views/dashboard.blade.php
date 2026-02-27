@extends('layouts.home')
@section('content')

    {{-- ═══ EXPORT MODAL ═══ --}}
    <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border: none; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.15);">
                <div class="modal-header" style="background: #1B3A5C; color: #fff; border: none; padding: 20px 24px;">
                    <h5 class="modal-title" style="font-weight: 600;">
                        <i class="material-icons" style="font-size: 20px; vertical-align: middle; margin-right: 6px; color: #C8941A;">picture_as_pdf</i>
                        Export Catalogue
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff; opacity: 0.7; text-shadow: none;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 24px;">
                    <form action="{{ url('export-product') }}" method="GET" target="_blank">
                        <div class="form-group mb-3">
                            <label style="font-weight: 500; color: #444; font-size: 13px;">Catalog Title</label>
                            <input name="cat_title" type="text" class="form-control" required placeholder="e.g. Spring Collection 2026"
                                   style="border-radius: 6px; border: 1.5px solid #dce0e4;">
                        </div>
                        <div class="form-group mb-3">
                            <label style="font-weight: 500; color: #444; font-size: 13px;">Catalogue</label>
                            <select class="form-control" name="catalogue_id" style="border-radius: 6px; border: 1.5px solid #dce0e4;">
                                <option value="All" selected>All Catalogues</option>
                                @foreach ($catalogues as $catalogue)
                                    <option value="{{ $catalogue->id }}">{{ $catalogue->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label style="font-weight: 500; color: #444; font-size: 13px;">Category</label>
                            <select class="form-control" name="category_id" style="border-radius: 6px; border: 1.5px solid #dce0e4;">
                                <option value="All" selected>All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label style="font-weight: 500; color: #444; font-size: 13px;">Layout</label>
                            <select name="print_type" class="form-control" required style="border-radius: 6px; border: 1.5px solid #dce0e4;">
                                <option value="2" selected>Four items per page (2x2 grid)</option>
                                <option value="1">One item per page (full page)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-block" style="background: #1B3A5C; color: #fff; font-weight: 600; padding: 12px; border-radius: 8px; font-size: 15px;">
                            <i class="material-icons" style="font-size: 18px; vertical-align: middle; margin-right: 6px;">download</i>
                            Export to PDF
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('share')

    {{-- ═══ FILTER BAR ═══ --}}
    <div class="filter-bar">
        <div class="filter-bar-inner">
            <select class="form-control" name="catalogue_id" id="catalogue" style="flex: 1; min-width: 140px; max-width: 200px;">
                <option value="All" selected>All Catalogues</option>
                @foreach ($catalogues as $catalogue)
                    <option value="{{ $catalogue->id }}">{{ $catalogue->name }}</option>
                @endforeach
            </select>
            <select class="form-control" name="category_id" id="category" style="flex: 1; min-width: 140px; max-width: 200px;">
                <option value="All" selected>All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <input id="searchInput" class="form-control" type="search"
                   placeholder="Search by name, SKU, or item number..."
                   aria-label="Search" style="flex: 2; min-width: 200px;">
            <button class="btn btn-search" id="searchBtn">
                <i class="material-icons" style="font-size: 18px; vertical-align: middle;">search</i>
                Search
            </button>
            <button class="btn btn-share" id="shareBtn">
                <i class="material-icons" style="font-size: 18px; vertical-align: middle;">share</i>
                Share
            </button>
        </div>
    </div>

    {{-- ═══ PRODUCTS ═══ --}}
    <div class="products-section">
        <div class="products-count">
            Showing <strong>{{ count($products) }}</strong> products
        </div>
        @include('prdouct-table')
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            function doSearch() {
                var category = $('#category').val();
                var catalogue = $('#catalogue').val();
                var search = $('#searchInput').val();

                $.ajax({
                    type: "GET",
                    url: "/search-prodcut",
                    data: {
                        'category': category,
                        'catalogue': catalogue,
                        'search': search
                    },
                    success: function(response) {
                        $('#maincontent').replaceWith(response);
                    }
                });
            }

            $(document).on('click', '#shareBtn', function() {
                var category = $('#category').val();

                $.ajax({
                    type: "GET",
                    url: "/share-product",
                    data: {
                        'category': category,
                    },
                    success: function(response) {
                        var res = $('#shareModal');
                        res.find('.modal-body').html(response);
                        res.modal('show');
                    }
                });
            });

            $(document).on('click', '#searchBtn', doSearch);
            $(document).on('change', '#category', doSearch);
            $(document).on('change', '#catalogue', doSearch);
            $(document).on('keypress', '#searchInput', function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    doSearch();
                }
            });
        });
    </script>
@endsection
