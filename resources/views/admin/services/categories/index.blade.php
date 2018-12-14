@extends('admin.layouts.app')

@section('content')
    <div class="container">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(count($categories) > 0)
            <div class ="table-responsive">
                <table class="table table-condensed table-bordered">
                    <thead>
                    <tr>
                        <th colspan="3" style="border:none; font-weight:bold; font-size:20px;">Service Categories</th>
                    </tr>
                    <tr>
                        <th><b>Category ID</b></th>
                        <th><b>Category Featured Image</b></th>
                        <th><b>Category Name</b></th>
                        <th><b>Category Slug</b></th>
                        <th><b>Options</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $c)
                        <tr>
                            <td>{!! $c->id !!}</td>
                            <td>
                                <img class="img-fluid" src="{{ asset(str_replace("public","storage", $c->featured_image)) }}" alt="">
                            </td>
                            <td>{!! $c->name !!}</td>
                            <td>{!! $c->slug !!}</td>
                            <td>
                                <a href="{!! route('service-categories.edit', [$c->id])!!}" class="btn btn-primary">Edit</a>
                                @include('admin.layouts.deleteform', ['action' => route('service-categories.destroy', $c->id), 'id' => $c->id])
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        @endif
        <div class="form-group">
            <label for="categories" class="col-sm-2 control-label"></label>
            <div class="col-sm-9">
                <h3>Add new category</h3>
            </div>
        </div>
        @include('errors.list')
        <form action="{{url('/admin/service-categories')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="categories" class="col-sm-2 control-label">Category Name</label>
                <div class="col-sm-9">
                    <input type="text" name="name" class="form-control" placeholder="Category Name" required>
                </div>
            </div>

            <div class="form-group">
                <label for="featured_image" class="col-sm-2 control-label">Category Featured Image</label>
                <div class="col-sm-9">
                    <input name="featured_image" type="file" class="form-control" id="featured_image" required />
                </div>
            </div>

            <div class="form-group">
                <label for="categories" class="col-sm-2 control-label"></label>
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-default">Add Category</button>
                </div>
            </div>
        </form>
    </div>
@endsection