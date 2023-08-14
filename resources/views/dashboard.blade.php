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
                            <div class="mb-3">


                                <select class="form-select form-select-sm" name="cataloge_id" id="mcatalog">
                                    <option selected>Choose A Cateloge</option>
                                    @for ($i = 0; $i < count($cataloges); $i++)
                                        <option value="{{ $cataloges[$i]->id }}">{{ $cataloges[$i]->name }}</option>
                                    @endfor

                                </select>
                                <label> Cateloges </label>
                            </div>
                            <div class="mb-3">

                                <select name="pr_category_id" class="form-select form-select-sm" id="mcategory" required>

                                    <option selected>Choose A Category</option>

                                    @for ($i = 0; $i < count($categories); $i++)
                                        <option value="{{ $categories[$i]->id }}">{{ $categories[$i]->name }}</option>
                                    @endfor


                                </select>
                                <label class="form-lable"> Category </label>
                            </div>



                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-lg">Export To PDF</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center container py-5">
            <div class="d-flex" style="gap: 10px;margin-bottom: 20px">
                <select class="form-select form-select-sm" name="cataloge_id" id='cataloge' required>
                    <option selected>All</option>
                    @for ($i = 0; $i < count($cataloges); $i++)
                        <option value="{{ $cataloges[$i]->id }}">{{ $cataloges[$i]->name }}</option>
                    @endfor

                </select>
                <select class="form-select form-select-sm" name="category_id" id='category' required>
                    <option selected>All</option>
                    @for ($i = 0; $i < count($categories); $i++)
                        <option value="{{ $categories[$i]->id }}">{{ $categories[$i]->name }}</option>
                    @endfor

                </select>


                <input id="searchInput" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" id='searchBtn'>Search</button>
            </div>

            @include('prdouct-table')
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
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
                        window.print();


                    }
                })


            });
        })
    </script>
@endsection
