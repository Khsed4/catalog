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
                <h2>Catalogues</h2>
                <a href="#addCatalogueModal" class="btn btn-success" data-toggle="modal"><i
                        class="material-icons">&#xE147;</i> <span>Add New Catalogue</span></a>
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
                    @foreach ($catalogues as $catalogue)
                        <tr>
                            <td>{{ $catalogue->name }}</td>
                            <td>{{ $catalogue->description }}</td>
                            <td>
                                <div class="btn-group">
                                    <button value="{{ $catalogue->id }}"
                                        class="btn btn-primary editButton btn-sm">Edit</button>
                                    <button value="{{ $catalogue->id }}"
                                        class="btn btn-danger deleteButton btn-sm">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add new Catalogue -->
    <div id="addCatalogueModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('store-catalogue') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Catalogue</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="textarea" name="description" class="form-control">
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

    <!-- Edit Catalogue -->
    <div id="editCatalogueModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('update-catalogue') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="cat_id" id="cat_id">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Catalogue</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" id="catalogue_name" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input name="description" id="catalogue_description" type="textarea" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Catalogue Modal -->
    <div id="deleteCatalogueModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('remove-catalogue') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Catalogue</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="catalogue_id" id="catalogue_id">
                        <p>Are you sure you want to delete this catalogue?</p>
                        <p class="text-warning"><small>This action cannot be undone. Products in this catalogue will be unassigned.</small></p>
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
                var catalogue_id = $(this).val();
                $('#editCatalogueModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/edit-catalogue/" + catalogue_id,
                    success: function(response) {
                        $('#catalogue_name').val(response.catalogue.name);
                        $('#cat_id').val(response.catalogue.id);
                        $('#catalogue_description').val(response.catalogue.description);
                    }
                })
            })

            $(document).on('click', '.deleteButton', function() {
                $('#deleteCatalogueModal').modal('show');
                var catalogue_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "/delete-catalogue/" + catalogue_id,
                    success: function(response) {
                        $("#catalogue_id").val(catalogue_id);
                    }
                })
            })

        })
    </script>
@endsection
