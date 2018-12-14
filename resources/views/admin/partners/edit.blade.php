@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="">
            <h2 class="">Service#{{$partner->id}}</h2>
        </div>
        @include('errors.list')
        <form action="{{ route('partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" id="name" value="{{ old('name', false) ? old('name') : $partner->name }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" id="email" value="{{ old('email', false) ? old('email') : $partner->email }}">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input name="phone" type="tel" class="form-control" id="phone" value="{{ old('phone', false) ? old('phone') : $partner->phone }}">
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input name="website" type="text" class="form-control" id="website" value="{{ old('website', false) ? old('website') : $partner->url }}">
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input name="slug" type="text" class="form-control" id="slug" value="{{ old('slug', false) ? old('slug') : $partner->slug }}">
            </div>
            <div class="form-group">
                <label for="name">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description', false) ? old('description') : $partner->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input name="featured_image" type="file" class="form-control" id="featured_image" />
            </div>
            <input type="hidden" name="partnerId" value="{{$partner->id}}">
            <a class="btn btn-danger" href="{{url()->previous() == url()->current() ? '/admin/partners/' :url()->previous()}}">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
