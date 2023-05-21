@extends('layouts.app')

@section('content')
    <div class="card-body">
        @if (Session::has('product_added'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('product_added') }}
            </div>
        @endif


    </div>

    <form class="product_form" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 2 column grid layout with text inputs for the first and last names -->
        <div class="row mb-4">
            <div class="col">
                <div class="form-outline">
                    <input type="text" name="name"  class="form-control" />
                    <label class="form-label" for="name" >Name</label>
                </div>
            </div>
            <div class="col">
                <div class="form-outline">
                    <input type="text" name="SKU" class="form-control" />
                    <label class="form-label" for="SKU">SKU</label>
                </div>
            </div>
        </div>

        <!-- Text input -->
        <div class="form-outline mb-4">
            <input type="text" name="price" class="form-control" value=1 />
            <label class="form-label" for="price">1 </label>
        </div>

        <!-- Text input -->
        <div class="form-outline mb-4">
            <input type="text" name="description" value="None" class="form-control" />
            <label class="form-label" for="description">This is a description</label>
        </div>


        <div class="form-outline mb-4">
            <select class="custom-select" name="category" required>

                <option value="Spice Set">Spice Set</option>
                <option value="Snack Dish" >Snack Dish</option>
                <option value="Dishes">Dishes </option>
                <option value='Tea Glass'>Tea Glasses</option>
                <option value="Teapot" >Teapot </option>
                <option value="Cooker">Cooker</option>
                <option value="Pressure Cooker">Pressure Cooker</option>
                <option value="Table Cloth" >Table Cloth </option>
                <option value="Tea Glass">Tea Glass</option>
                <option value="Cultery Set" >Cultery Set</option>
                <option value="Spoon Holder">Spoon Holder </option>
                <option value="Decorative">Decorative</option>
                <option value="Nut Pot">Nut Pot</option>
                <option value="Kitchenware" >Kitchenware</option>
                <option value="Cake Pot" >Cake Pot</option>
                <option value="Tray">Tray </option>
                <option value="Coffee Set">Coffee Set</option>
                <option value="Square Plate">Square Plate</option>
                <option value="Kitchen Accessorie">Kitchen Accessorie</option>
                <option value="Nut Plate">Nut Plate</option>
                <option value="Sport">Sport</option>
                <option value="Dinner Set" >Dinner Set</option>
                <option value="Dinner Set" selected='select'>Rugs</option>

            </select>
            <div class="invalid-feedback">Example invalid custom select feedback</div>
        </div>
        <!-- Message input -->
        <div class="form-outline mb-4">
            <textarea class="form-control" name="Item_Number" rows="4"  placeholder="Dinner Set"></textarea>
            <label class="form-label" for="Item_Number"  >Item Number</label>
        </div>

        <div class="form-group">
            <label for="file">Choose Image</label>
            <input type="file" name="file" class="form-control" />
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-4" style="font-size: 25px">Save</button>
    </form>
