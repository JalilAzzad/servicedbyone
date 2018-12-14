@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="">
            <h2 class="">Seo#{{$seo1->id}}</h2>
        </div>
        @include('errors.list')
        <form action="{{ route('seos.update', $seo1->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="url">URL</label>
                <input name="url" type="text" class="form-control" id="url" placeholder="https://servicedbyone.com/example" value="{{$seo1->url}}" disabled>
            </div>
            <div class="form-group">
                <label for="slug">Title</label>
                <input name="slug" type="text" class="form-control" id="slug" placeholder="" value="{{$seo1->slug}}">
            </div>
            <div class="form-group">
                <label for="keywords">Key-Words</label>
                <input name="keywords" type="text" class="form-control" id="keywords" placeholder="keyword1,keyword2" value="{{$seo1->keywords}}">
            </div>
            <div class="form-group">
                <label for="meta_desc">Meta-Description</label>
                <input name="meta_desc" type="text" class="form-control" id="meta_desc" placeholder="Description" value="{{$seo1->meta_desc}}">
            </div>


            <a class="btn btn-danger" href="{{url()->previous() == url()->current() ? '/admin/seos/'.$seo1->id :url()->previous()}}">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
