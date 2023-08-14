@extends('layouts.app')

@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::has('failed'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('failed') }}
        </div>
    @endif
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6 position-relative">
                        <div class="position-absolute top-0 start-0">
                            <a href="#addEmployeeModal" class="btn btn-success " data-toggle="modal"><i
                                    class="material-icons">&#xE147;</i> <span>Categorie</span></a>
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
                                    class="material-icons">&#xE147;</i> <span>catalogues</span></a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
                                class="material-icons">&#xE147;</i> <span>Add New Product</span></a>

                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover table-condensed ">
                <thead>

                    <tr>

                        <th>Name</th>
                        <th>SKU</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @foreach ( $products as $product)

                <tbody>



                    <tr>

                        <td>{{$product->name}}</td>
                        <td>{{$product->SKU}}</td>
                        <td>{{$product->price}}</td>


                        @foreach ( $categories as $category)


                            @if ($category->id==$product->category_id)
                            <td>{{$category->name}}</td>
                            @endif

                            @endforeach


                            <td>
                                {{-- <img src="{{url('/images/{{$product->image}}')}}" alt="Image" alt="apple" width="80"> --}}
                                <img src='{{ url('images/' . $product->image) }}'  alt="apple" style = "width:90px; height:90px">
                            </td>
                           <td>
                            <div class="btn-group">
                                <button value={{ $product->id }}
                                    class="btn btn-primary editButton btn-sm slide_start_button action_button_class">Edit</button>
                                <button value={{ $product->id }}
                                    class="btn btn-danger deleteButton btn-sm slide_stop_button action_button_class">Delete</button>

                            </div>
                        </td>
                    </tr>

                </tbody>
                @endforeach
            </table>
            <div class="clearfix">
                <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Add new Product -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content ">
                <form action="{{ url('store-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Product</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xs-2">


                            <select class="form-select form-select-sm" name="cataloge_id" required>
                                <option selected>Choose A Cateloge</option>
                                @for ($i = 0; $i < count($cataloges); $i++)
                                    <option value="{{ $cataloges[$i]->id }}">{{ $cataloges[$i]->name }}</option>
                                @endfor

                            </select>
                            <label> Cateloges </label>
                        </div>
                        <div class="col-xs-2 ">

                            <input name="name" type="text" class="form-control" required>
                            <label class="form-lable" for="name">Name</label>
                        </div>
                        <div class="col-xs-2">

                            <input name="SKU" type="text" class="form-control" required>
                            <label class="form-lable" for="SKU">SKU</label>
                        </div>
                        <div class="col-xs-2">

                            <input name="Item_Number" type="text" class="form-control">
                            <label for="Item_Number">Item Number</label>
                        </div>
                        <div class="col-xs-2">

                            <input name="price" step="any" type="number" class="form-control" required>
                            <label class="form-lable" for="price">Price</label>
                        </div>

                        <div class="col-xs-2">

                            <select class="form-select form-select-sm" name="category_id" required>

                                <option selected>Choose A Category</option>

                                @for ($i = 0; $i < count($categories); $i++)
                                    <option value="{{ $categories[$i]->id }}">{{ $categories[$i]->name }}</option>
                                @endfor


                            </select>
                            <label class="form-lable"> Category </label>
                        </div>
                        <div class="form-group">
                            <label for="mImage">Choose Image</label>
                            <input type="file" name="mImage" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Product -->
    <div id="editEmployeeModal" class="modal fade" >
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('update-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" name="pr_id" id="pr_id">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLable">Edit Product</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xs-2">


                            <select class="form-select form-select-sm" name="cataloge_id" required>
                                <option selected>Choose A Cateloge</option>
                                @for ($i = 0; $i < count($cataloges); $i++)
                                    <option value="{{ $cataloges[$i]->id }}">{{ $cataloges[$i]->name }}</option>
                                @endfor

                            </select>
                            <label> Cateloges </label>
                        </div>
                        <div class="col-xs-2 ">

                            <input name = "pr_name" id = "pr_name" type="text" class="form-control" required>
                            <label class="form-lable" for="name">Name</label>
                        </div>
                        <div class="col-xs-2">

                            <input id="pr_SKU" name="pr_SKU" type="text" class="form-control" required>
                            <label class="form-lable" for="SKU">SKU</label>
                        </div>
                        <div class="col-xs-2">

                            <input id="pr_Item_Number" name="pr_Item_Number" type="text" class="form-control">
                            <label for="Item_Number">Item Number</label>
                        </div>
                        <div class="col-xs-2">

                            <input id="pr_price"  name="pr_price" step="any" type="number" class="form-control" required>
                            <label class="form-lable" for="price">Price</label>
                        </div>

                        <div class="col-xs-2">

                            <select name="pr_category_id" class="form-select form-select-sm" id="pr_category_id" required>

                                <option selected>Choose A Category</option>

                                @for ($i = 0; $i < count($categories); $i++)
                                    <option value="{{ $categories[$i]->id }}">{{ $categories[$i]->name }}</option>
                                @endfor


                            </select>
                            <label class="form-lable"> Category </label>
                        </div>
                        <div class="form-group">
                            <label for="mImage">Choose Image</label>
                            <input type="file" name="pr_mImage" id="pr_mImage" class="form-control" />
                        </div>
                    </div>

                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-info" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">

        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('remove-product') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h4 class="modal-title">Delete Product</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="product_id" id="product_id">
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.editButton', function() {
                var product_id = $(this).val();
                $('#editEmployeeModal').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/edit-product/" + product_id,
                    success: function(response) {

                        console.log(response);
                        $('#pr_id').val(response.product.id);
                        $('#pr_name').val(response.product.name);
                        $('#pr_SKU').val(response.product.SKU);
                        $('#pr_price').val(response.product.price);
                        $('#pr_Item_Number').val(response.product.item_number);
                    }
                })


            })

            $(document).on('click', '.deleteButton', function() {

                $('#deleteEmployeeModal').modal('show');
                var cat_id = $(this).val();
                console.log(cat_id);
                $.ajax({
                    type: "GET",
                    url: "/delete-prodcut/" + cat_id,
                    success: function(response) {
                        console.log(cat_id + " inside JS");
                        $("#product_id").val(cat_id);

                    }
                })

            })



        })
    </script>
@endsection
