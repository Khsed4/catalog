@extends('layouts.app')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::has('failed'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('failed') }}
        </div>
    @endif
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6 position-relative">
                        <div class="position-absolute top-0 start-0">
                            <a href="{{ url('products') }}" class="btn btn-success "><i class="material-icons">&#xE147;</i>
                                <span>Products</span></a>
                            <a href="{{ url('categories') }}" class="btn btn-success"><i class="material-icons">&#xE147;</i>
                                <span>Sub-categories</span></a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
                                class="material-icons">&#xE147;</i> <span>Add New Main-Category</span></a>

                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover table-condensed">
                <thead>
                    <tr>

                        <th>Name</th>

                        <th>Description</th>

                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @for ($i = 0; $i < count($cataloges); $i += 1)
                        <tr>


                            <td>{{ $cataloges[$i]->name }}</td>
                            <td>{{ $cataloges[$i]->description }}</td>

                            <td>
                                <div class="btn-group">
                                    <button value={{ $cataloges[$i]->id }}
                                        class="btn btn-primary editButton btn-sm slide_start_button action_button_class ">Edit</button>
                                    <button value={{ $cataloges[$i]->id }}
                                        class="btn btn-danger deleteButton btn-sm slide_stop_button action_button_class ">Delete</button>

                                </div>
                            </td>
                        </tr>
                    @endfor
                </tbody>

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

    <!-- Add new Category -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('cataloge.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add A Cataloge</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <input type="textarea" name='description' class="form-control" required>
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
    <!-- Edit New category -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('update-cataloge') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="cat_id" id="cat_id">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLable">Edit Cataloge</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label> name</label>
                            <input name="name" id="name" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input name="description" id="description" type="textarea" class="form-control" required>
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
                <form action="{{ url('removedata') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h4 class="modal-title">Delete Employee</h4>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="cataloge_id" id="cataloge_id">
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

                var cat_id = $(this).val();
                $('#editEmployeeModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/edit-cataloge/" + cat_id,
                    success: function(response) {
                        console.log(response.catalog.name);
                        $('#name').val(response.catalog.name);
                        $('#cat_id').val(response.catalog.id);
                        $('#description').val(response.catalog.description);
                    }
                })


            })

            $(document).on('click', '.deleteButton', function() {

                $('#deleteEmployeeModal').modal('show');
                var cat_id = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "/delete-cataloge/" + cat_id,
                    success: function(response) {
                        console.log(cat_id + " inside JS");
                        $("#cataloge_id").val(cat_id);

                    }
                })

            })



        })
    </script>
@endsection
