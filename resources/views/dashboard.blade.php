@extends('layouts.home')
@section('content')
    <section style="background-color: #eee;">

        <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Filter The Catelog</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('export-product') }}" method="GET">
                            <div class="col-xs-2 ">
                                <input name="cat_title" type="text" class="form-control" required>
                                <label class="form-lable" for="name">Cataloge Title</label>
                            </div>
                            <div class="mb-3">
                                <select class="form-select form-select-sm" name="cataloge_id" id="shareCateloge">
                                    <option selected>All</option>
                                    @for ($i = 0; $i < count($cataloges); $i++)
                                        <option value="{{ $cataloges[$i]->id }}">{{ $cataloges[$i]->name }}</option>
                                    @endfor
                                </select>
                                <label> Main Category </label>
                            </div>
                            <div class="mb-3">
                                @include('filter-export-category')

                            </div>
                            <div class="mb-3">

                                <select name="print_type" class="form-select form-select-sm" id="mcategory" required>

                                    <option value="2" selected>two Items per a page</option>


                                    <option value="1">One item per a page</option>



                                </select>
                                <label class="form-lable"> Sort </label>
                            </div>



                            <div class="modal-footer" style="justify-content: center;">
                                <button type="submit" class="btn btn-primary btn-lg">Export To PDF</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('share')
        <div class="text-center container py-5">
            <div class="d-flex" style="gap: 10px;margin-bottom: 20px">
                <select class="form-select form-select-sm" name="cataloge_id" id='cataloge' required>
                    <option selected>All</option>
                    @for ($i = 0; $i < count($cataloges); $i++)
                        <option value="{{ $cataloges[$i]->id }}">{{ $cataloges[$i]->name }}</option>
                    @endfor

                </select>
                @include('filter-category')

                <input id="searchInput" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" id='searchBtn'>Search</button>
                <button class="btn btn-outline-success" id='shareBtn'>Share</button>
            </div>

            @include('prdouct-table')
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('change', '#cataloge', function(event) {
                console.log(event.target.value);
                if (event.target.value == 'All')
                    $("#category").prop("disabled", true);
                else {
                    $.ajax({
                        type: 'GET',
                        url: '/filter-category',
                        data: {
                            'id': event.target.value
                        },
                        success: function(response) {
                            $("#category").prop("disabled", false);
                            $("#category").html(response);



                        }
                    })
                }
            });
            $(document).on('change', '#shareCateloge', function(event) {
                console.log(event.target.value);
                if (event.target.value == 'All')
                    $("#category").prop("disabled", true);
                else {
                    $.ajax({
                        type: 'GET',
                        url: '/filter-category',
                        data: {
                            'id': event.target.value
                        },
                        success: function(response) {
                            $("#fCategory").prop("disabled", false);
                            $("#fCategory").html(response);



                        }
                    })
                }
            });

            $(document).on('click', '#shareBtn', function() {
                var catelog = $('#cataloge').val();
                var category = $('#category').val();


                $.ajax({
                    type: "GET",
                    url: "/share-product",
                    data: {
                        'catalog': catelog,
                        'category': category,
                    },
                    success: function(response) {
                        console.log(response);
                        var res = $('#shareModal');
                        res.find('.modal-body').html(response);
                        res.modal('show');

                    }
                })


            });
            $(document).on('click', '#searchBtn', function() {
                var catelog = $('#cataloge').val();
                var category = $('#category').val();
                var search = $('#searchInput').val();


                $.ajax({
                    type: "GET",
                    url: "/search-prodcut",
                    data: {
                        'catalog': catelog,
                        'category': category,
                        'search': search

                    },
                    success: function(response) {

                        console.log(response);
                        $('#maincontent').html(response);
                    }
                })


            });

        })
    </script>
@endsection
