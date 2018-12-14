@php
    $seo_title =  "Partner | Serviced By ONE";
@endphp

@extends('layouts.app')

@section('content')
    <header class="bg-primary">
        <div class="container text-left" >
            <div class="row">
                <div class="col-lg-8 col-md-10 col-sm-12 header-line">
                    <h1 class="header-title-1 tp-margin-bottom--quad">Partner</h1>
                </div><!-- .col-8 -->
            </div><!-- .row -->
            <div class="row ">
                <div class="col-md-4 col-4">
                    <img class="img-thumbnail w-100" src="{{is_null($partner->resized_featured_image) ? asset('/images/partner-default.png') : asset(str_replace("public","storage", $partner->resized_featured_image)) }}" alt="Partner Image"></img>
                    <p class="mt-4 text-wrap">Name: {{$partner->name}}</p>
                    <p class="mt-4 text-wrap">Email: {{$partner->email}}</p>
                    <p class="mt-4 text-wrap">Phone: {{$partner->phone}}</p>
                    <p class="mt-4 text-wrap">Website: {{$partner->url}}</p>
                </div>
                <div class="col-md-8 col-8">
                    <textarea class="w-100 h-100 form-control" disabled>{{$partner->description}}</textarea>
                </div>
              
            </div>
            <div class="clearfix mt-5"></div>
            <a href="{{url()->previous() == url()->current() ? '/' :url()->previous()}}" class="btn btn-primary">Go Back</a>
        </div>
    </header>
@endsection
