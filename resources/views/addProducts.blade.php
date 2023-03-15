@extends('layouts.app')

@section('content')
<div class="card-body">
@if (Session::has('product_added'))
<div class="alert alert-success" role="alert">
{{ Session::get('product_added') }}
  </div>

@endif

</div>

<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- 2 column grid layout with text inputs for the first and last names -->
    <div class="row mb-4">
      <div class="col">
        <div class="form-outline">
          <input type="text" name="name" class="form-control" />
          <label class="form-label" for="name">Name</label>
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
      <input type="text" name="price" class="form-control" />
      <label class="form-label" for="price">price </label>
    </div>

    <!-- Text input -->
    <div class="form-outline mb-4">
      <input type="text" name="description" class="form-control" />
      <label class="form-label" for="description">description</label>
    </div>



    <div class="form-outline mb-4">
        <select class="custom-select"  name="category" required>
          <option value="">Open this select menu</option>
          <option value="General Item">General Item</option>
          <option value='cookware'>cookware</option>
          <option value="Flask(Tarmoz)">Flask(Tarmoz)</option>
          <option value="Dining Ware">Dining Ware</option>
          <option value="House Ware">House Ware</option>

        </select>
        <div class="invalid-feedback">Example invalid custom select feedback</div>
      </div>
    <!-- Message input -->
    <div class="form-outline mb-4">
      <textarea class="form-control" name="Item_Number" rows="4"></textarea>
      <label class="form-label" for="Item_Number">Item Number</label>
    </div>

    <div class="form-group">
        <label for="file">Choose Image</label>
        <input type="file" name="file" class="form-control"/>
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">Save</button>
  </form>
  {{-- <div class="form-group">
    <label for="">Categories</label>
    <select class="form-control input-sm" name="category" id="category">
         @foreach($categories as $category)
           <option value="{{$category->id}}">{{$category->name}}     </option>
         @endforeach
    </select>
</div> --}}
