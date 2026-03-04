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
                <h2>Products</h2>
                <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
                        class="material-icons">&#xE147;</i> <span>Add New Product</span></a>
            </div>
            @php $grouped = $products->groupBy('category_name'); @endphp
            @foreach ($grouped as $categoryName => $categoryProducts)
            <div class="category-group" style="margin-bottom: 20px;">
                <h5 style="background: #e9ecef; padding: 10px 15px; margin: 0; border-radius: 5px 5px 0 0; color: #1B3A5C; font-weight: 600;">
                    {{ $categoryName }} <span style="font-weight: 400; font-size: 13px; color: #888;">({{ count($categoryProducts) }})</span>
                </h5>
                <table class="table table-striped table-hover table-condensed" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th style="width: 40px"></th>
                            <th>Name</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Orig. Price</th>
                            <th>Set Price</th>
                            <th>Image</th>
                            <th style="text-align: center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="sortable-category">
                        @foreach ($categoryProducts as $product)
                            <tr data-id="{{ $product->id }}">
                                <td class="drag-handle"><i class="material-icons">drag_indicator</i></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->SKU }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>
                                    @if($product->original_price && $product->original_price > $product->price)
                                        <s style="color: #999;">${{ number_format($product->original_price, 2) }}</s>
                                    @else
                                        --
                                    @endif
                                </td>
                                <td>
                                    @if($product->set_price)
                                        ${{ number_format($product->set_price, 2) }}
                                    @else
                                        --
                                    @endif
                                </td>
                                <td>
                                    <img src='{{ url('images/' . $product->image) }}' alt="apple"
                                        style="width:90px; height:90px">
                                </td>
                                <td style="width: 383px">
                                    <div class="btn-group">
                                        <button value={{ $product->id }}
                                            class="btn btn-primary editButton btn-sm slide_start_button action_button_class">Edit</button>
                                        <button value={{ $product->id }}
                                            class="btn btn-danger deleteButton btn-sm slide_stop_button action_button_class">Delete</button>

                                        <div class="form-check form-switch">
                                            <input value={{ $product->id }} class="form-check-input" type="checkbox"
                                                role="switch"
                                                {{ $product->out_of_stock === 0 ? 'checked' : '' }}>
                                            <label class="form-check-label">Out Of Stock</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endforeach
            <div class="clearfix">
                <div class="hint-text" style="padding: 10px 0; color: #888;">Total: <b>{{ count($products) }}</b> products</div>
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm" name="category_id" required>
                                        <option value="" selected>Choose A Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Catalogue</label>
                                    <select class="form-control form-control-sm" name="catalogue_id">
                                        <option value="" selected>None (No Catalogue)</option>
                                        @foreach ($catalogues as $catalogue)
                                            <option value="{{ $catalogue->id }}">{{ $catalogue->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Product Name <span class="text-danger">*</span></label>
                            <input name="name" type="text" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input name="price" step="any" type="number" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Original Price</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input name="original_price" step="any" type="number" class="form-control" placeholder="Before discount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Set Price</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input name="set_price" step="any" type="number" class="form-control" placeholder="Price per set">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input name="quantity" step="any" type="number" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>SKU <span class="text-danger">*</span></label>
                                    <input name="SKU" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Item Number</label>
                                    <input name="Item_Number" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Image <span class="text-danger">*</span></label>
                            <input type="file" name="mImage" class="form-control" required />
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
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('update-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="pr_id" id="pr_id">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Product</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category <span class="text-danger">*</span></label>
                                    <select name="pr_category_id" class="form-control form-control-sm" id="pr_category_id" required>
                                        <option value="">Choose A Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Catalogue</label>
                                    <select name="pr_catalogue_id" class="form-control form-control-sm" id="pr_catalogue_id">
                                        <option value="">None (No Catalogue)</option>
                                        @foreach ($catalogues as $catalogue)
                                            <option value="{{ $catalogue->id }}">{{ $catalogue->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Product Name <span class="text-danger">*</span></label>
                            <input name="pr_name" id="pr_name" type="text" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input id="pr_price" name="pr_price" step="any" type="number" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Original Price</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input id="pr_original_price" name="pr_original_price" step="any" type="number" class="form-control" placeholder="Before discount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Set Price</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input id="pr_set_price" name="pr_set_price" step="any" type="number" class="form-control" placeholder="Price per set">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>SKU <span class="text-danger">*</span></label>
                                    <input id="pr_SKU" name="pr_SKU" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Item Number</label>
                                    <input id="pr_Item_Number" name="pr_Item_Number" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="pr_mImage" id="pr_mImage" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Update">
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
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="product_id" id="product_id">
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
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
                        $('#pr_original_price').val(response.product.original_price || '');
                        $('#pr_set_price').val(response.product.set_price || '');
                        $('#pr_Item_Number').val(response.product.item_number);
                        $('#pr_category_id').val(response.product.category_id);
                        $('#pr_catalogue_id').val(response.product.catalogue_id || '');
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

            });
            $(".form-check  input:checkbox").click(function() {

                var product_id = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "/toggle-product/" + product_id
                })

            });



        });

        // Drag-and-drop sorting per category
        document.querySelectorAll('.sortable-category').forEach(function(el) {
            new Sortable(el, {
                handle: '.drag-handle',
                animation: 150,
                ghostClass: 'sortable-ghost',
                onEnd: function() {
                    var order = [];
                    $(el).find('tr').each(function() {
                        order.push($(this).data('id'));
                    });
                    $.ajax({
                        type: 'POST',
                        url: '/update-product-order',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            order: order
                        },
                        success: function() {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'Order saved',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
