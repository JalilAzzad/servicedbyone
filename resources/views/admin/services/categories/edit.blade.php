@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h3>Update Category</h3>
        @include('errors.list')
        <form action="{{route('service-categories.update', [$category->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-9">
                    <input type="text" name="name" class="form-control" placeholder="Category Name" required min="3" value="{{old('name', false) ? old('name') : $category->name}}">
                </div>
            </div>
            <div class="form-group">
                <label for="featured_image" class="col-sm-2 control-label">Category Featured Image</label>
                <div class="col-sm-9">
                    <input name="featured_image" type="file" class="form-control" id="featured_image" />
                </div>
            </div>
            <div class="">
                <a href="{{url()->previous() == url()->current() ? '/admin/service-categories' :url()->previous()}}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Category</button>
            </div>
        </form>
    </div>
@endsection