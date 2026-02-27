@extends('layouts.app')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <h2>Company Settings</h2>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ url('company-settings') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="company_name">Company Name <span class="text-danger">*</span></label>
                            <input type="text" name="company_name" id="company_name" class="form-control"
                                value="{{ $setting->company_name ?? '' }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" class="form-control" rows="2">{{ $setting->address ?? '' }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        value="{{ $setting->phone ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ $setting->email ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="cover_image">Cover Image (for PDF catalogs)</label>
                            @if(isset($setting) && $setting->cover_image)
                                <div class="mb-2">
                                    <img src="{{ url('images/' . $setting->cover_image) }}" alt="Cover Image"
                                        style="max-width: 300px; height: auto; border: 1px solid #ddd; padding: 5px;">
                                </div>
                            @endif
                            <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/*">
                            <small class="form-text text-muted">Recommended size: 800x600px. Max 2MB.</small>
                        </div>

                        <div class="form-group text-end">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="material-icons">&#xE161;</i> Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
