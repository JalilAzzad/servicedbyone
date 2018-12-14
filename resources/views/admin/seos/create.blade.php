@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="">
            <h2 class="">SEO</h2>
        </div>
        @include('errors.list')
        <form action="{{ route('seos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="slug">URL</label>
                <input name="url" type="text" class="form-control" id="url" placeholder="https://servicedbyone.com/example" value="{{old('url')}}">
            </div>
            <div class="form-group">
                <label for="slug">Title</label>
                <input name="slug" type="text" class="form-control" id="slug" placeholder="" value="{{old('slug')}}">
            </div>
            <div class="form-group">
                <label for="keywords">Key-Words</label>
                <input name="keywords" type="text" class="form-control" id="keywords" placeholder="keyword1,keyword2" value="{{old('keywords')}}">
            </div>
            <div class="form-group">
                <label for="meta_desc">Meta-Description</label>
                <input name="meta_desc" type="text" class="form-control" id="meta_desc" placeholder="Description" value="{{old('meta_desc')}}">
            </div>

            <a class="btn btn-danger" href="{{url()->previous() == url()->current() ? '/admin/seos/' :url()->previous()}}">Cancel</a>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
