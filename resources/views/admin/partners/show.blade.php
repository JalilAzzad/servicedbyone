@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="">
            <h2 class="">Partner#{{$partner->id}}</h2>
        </div>
        <table class="table">
            <tbody>
            <tr>
                <th scope="row">#</th>
                <td>{{$partner->id}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Name') }}</th>
                <td>{{$partner->name}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Email') }}</th>
                <td>{{$partner->email}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Phone') }}</th>
                <td>{{$partner->phone}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Website') }}</th>
                <td>{{$partner->url}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Slug') }}</th>
                <td>{{$partner->slug}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Description') }}</th>
                <td>{{$partner->description}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Featured Image') }}</th>
                <td><img class="img-thumbnail" src="{{is_null($partner->featured_image) ? asset('/images/partner-default.png') : asset(str_replace("public","storage", $partner->featured_image)) }}" alt="Service Featured Image"></td>
            </tr>
            <tr>
                <th scope="row">{{ __('Actions') }}</th>
                <td>
                    <a class="btn btn-secondary" href="{{route('partners.edit', $partner->id)}}">Edit</a>
                    @include('admin.layouts.deleteform', ['action' => route('partners.destroy', $partner->id), 'id' => $partner->id])
                </td>
            </tr>
            </tbody>
        </table>
        <div class="clearfix"></div>
        <hr>
        <a class="btn btn-primary" href="{{url()->previous() == url()->current() ? '/admin/partners' :url()->previous()}}">Back</a>
    </div>
@endsection
