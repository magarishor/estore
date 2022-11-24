@extends('layouts.cms')

@section('content')
    <main class="row">
        <div class="col-12 bg-white my-3 py-3">
            <div class="row">
                <div class="col-5 mx-auto">
                    <h1>Add Product</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-5 mx-auto">
                    <form action="{{ route('cms.products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="details" class="form-label">Details</label>
                            <textarea name="details" id="details" class="form-control editor" required>{{ old('details') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="summary" class="form-label">Summary</label>
                            <textarea name="summary" id="summary" class="form-control editor" required>{{ old('summary') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" step="0.01" required>
                        </div>

                        <div class="mb-3">
                            <label for="discounted_price" class="form-label">Discounted Price</label>
                            <input type="number" name="discounted_price" id="discounted_price" class="form-control" value="{{ old('price') }}" step="0.01">
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">Images</label>
                            <input type="file" name="images[]" id="images" class="form-control" accept="image/*" multiple required>
                            <div class="row" id="img-preview"></div>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('$category_id') == $category->id ? 'selected' :'' }}> {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="brand_id" class="form-label">Brand</label>
                            <select name="brand_id" id="brand_id" class="form-select" required>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' :'' }}> {{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Active" {{ old('status') == 'Active'? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ old('status') == 'Inactive'? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="featured" class="form-label">Featured</label>
                            <select name="featured" id="featured" class="form-select" required>
                                <option value="Yes" {{ old('featured') == 'Yes'? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ old('featured') == 'No'? 'selected' : '' }}>No</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fa-solid fa-save me-2"></i>
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('nav')
    @include('cms.includes.nav')
@endsection
