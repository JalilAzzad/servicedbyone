@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="">
            <h2 class="">Seo#{{$seo1->id}}</h2>
        </div>
        <table class="table">
            <tbody>
            <tr>
                <th scope="row">#</th>
                <td>{{$seo1->id}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('URL') }}</th>
                <td>{{$seo1->url}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Title') }}</th>
                <td>{{$seo1->slug}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Key-Words') }}</th>
                <td>{{$seo1->keywords}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Meta-Description') }}</th>
                <td>{{$seo1->meta_desc}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Actions') }}</th>
                <td>
                    <a class="btn btn-secondary" href="{{route('seos.edit', $seo1->id)}}">Edit</a>
                    
                    @include('admin.layouts.deleteform', ['action' => route('seos.destroy', $seo1->id), 'id' => $seo1->id])
                   
                </td>
            </tr>
            </tbody>
        </table>
        <div class="clearfix"></div>
        <hr>
        <a class="btn btn-primary" href="{{url()->previous() == url()->current() ? '/admin/seos' :url()->previous()}}">Back</a>
    </div>
@endsection
