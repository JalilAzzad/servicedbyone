@extends('layouts.app')

@section('content')
    @if($popularServices->count())
    <header class="bg-primary">
        <div class="container text-left">
            <div class="row">
                <div class="col-lg-8 col-md-10 col-sm-12 header-line">
                    <h1 class="header-title-1 tp-margin-bottom--quad mobile-margin-top-40">Hire us for reliable help on a variety of professional services.</h1>
                    {{--<p class="lead">A landing page template freshly redesigned for Bootstrap 4</p>--}}
                </div><!-- .col-8 -->
            </div><!-- .row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="one-title-5 one-margin-bottom--doubule">
                    @if(is_null($location))
                        Popular Services
                    @else
                        Popular services in {{$location->city->city}}, {{$location->city->state_code}}.
                    @endif
                    </div>
                </div><!-- .col-8 -->

                @if($agent->isMobile())
                    <div class="scrolling-wrapper services-item services-item-scroll">
                        @foreach($popularServices as $key => $service)
                            
                            @if ($key < 6) 

                                <div class="card h-100">
                                    @if(is_null($location))
                                        @php($url = 'services/'.$service->slug)
                                    @else
                                        @php($url = $location->city->state_code.'/'.$location->city->slug.'/'.$service->slug)
                                    @endif
                                    <a href="{{url($url)}}">
                                        <img class="card-img-top" src="{{ asset(str_replace("public","storage", $service->resized_featured_image)) }}" alt="{{ $service->name }}" onerror="this.src='{{url('/default.png')}}'">
                                    </a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a class="one-color--black-300" href="{{url($url)}}">{{ $service->name }}</a>
                                        </h4>
                                    </div>
                                </div> 

                            @endif

                        @endforeach
                    </div>

                @else
                    
                        @foreach($popularServices as $service)
                            <div class="col-sm-4 col-md-3 services-item mb-4">
                                <div class="card h-100">
                                    @if(is_null($location))
                                        @php($url = 'services/'.$service->slug)
                                    @else
                                        @php($url = $location->city->state_code.'/'.$location->city->slug.'/'.$service->slug)
                                    @endif
                                    <a href="{{url($url)}}">
                                        <img class="card-img-top" src="{{ asset(str_replace("public","storage", $service->resized_featured_image)) }}" alt="{{ $service->name }}" onerror="this.src='{{url('/default.png')}}'">
                                    </a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="{{url($url)}}">{{ $service->name }}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    
                @endif
            </div>
        </div>
    </header>
    <div class="clearfix"></div>
    @endif

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="title ">
                        <h2 class="header-title-2">What's your next project?</h2>
                        <p class="subtitle">The most popular categories</p>
                    </div>
                </div>
            </div>
            <div class="row category-boxes">
                <div class="col-sm-9">
                    <div class="row">
                    @php($category = $popularCategories->where('id', 1)->first())
                    @if($category)
                        <!-- Category Box -->
                            <div class="col-6 col-sm-4">
                                <a href="{{url('service-categories/'.$category->slug)}}">
                                    <div class="category-box">
                                        <img class="img-fluid" src="{{ asset(str_replace("public","storage", $category->resized_featured_image)) }}" alt="{{ $category->name }}">
                                        <div class="category-box-title">
                                            <h6>
                                                {{ $category->name }}
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    @endif

                    @php($category = $popularCategories->where('id', 2)->first())
                    @if($category)
                        <!-- Category Box -->
                            <div class="col-6 col-sm-4">
                                <a href="{{url('service-categories/'.$category->slug)}}">
                                    <div class="category-box">
                                        <img src="{{ asset(str_replace("public","storage", $category->resized_featured_image)) }}" alt="{{ $category->name }}">
                                        <div class="category-box-title">
                                            <h6>
                                                {{ $category->name }}
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    @endif

                    @php($category = $popularCategories->where('id', 3)->first())
                    @if($category)
                        <!-- Category Box -->
                            <div class="col">
                                <a href="{{url('service-categories/'.$category->slug)}}">
                                    <div class="category-box">
                                        <img src="{{ asset(str_replace("public","storage", $category->resized_featured_image)) }}" alt="{{ $category->name }}">
                                        <div class="category-box-title">
                                            <h6>
                                                {{ $category->name }}
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                    @php($category = $popularCategories->where('id', 4)->first())
                    @if($category)
                        <!-- Category Box -->
                            <div class="col-6 col-sm-4">
                                <a href="{{url('service-categories/'.$category->slug)}}">
                                    <div class="category-box">
                                        <img src="{{ asset(str_replace("public","storage", $category->resized_featured_image)) }}" alt="{{ $category->name }}">
                                        <div class="category-box-title">
                                            <h6>
                                                {{ $category->name }}
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    @endif

                    @php($category = $popularCategories->where('id', 5)->first())
                    @if($category)
                        <!-- Category Box -->
                            <div class="col-6 col-sm-8">
                                <a href="{{url('service-categories/'.$category->slug)}}">
                                    <div class="category-box">
                                        <img src="{{ asset(str_replace("public","storage", $category->resized_featured_image)) }}" alt="{{ $category->name }}">
                                        <div class="category-box-title">
                                            <h6>
                                                {{ $category->name }}
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="row full-height">
                    @php($category = $popularCategories->where('id', 6)->first())
                    @if($category)
                        <!-- Category Box -->
                            <div class="col full-height">
                                <a href="{{url('service-categories/'.$category->slug)}}">
                                    <div class="category-box category-box-alt">
                                        <img src="{{ asset(str_replace("public","storage", $category->resized_featured_image)) }}" alt="{{ $category->name }}">
                                        <div class="category-box-title">
                                            <h6>
                                                {{ $category->name }}
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="how">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="title ">
                        <h2 class="header-title-2">All {{$states->count()}} States</h2>
                        {{--<p class="subtitle">The most popular categories</p>--}}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 mx-auto col-md-12">
                    <p class="leadtext">From big cities to small towns, we’ve got professionals on call covering every county in the U.S, From the smallest job to the toughest we've got it covered.</p>

                    <a href="/our-services" class="btn btn-primary mb-4">Explore our services</a>

                </div>
                <div class="col-lg-4 col-md-12">
                    <img src="{{asset('images/us.png')}}" class="home-map" alt="US Map">
                </div>
                <div class="col-lg-12 mx-auto">
                    <ol class="states-list__list">
                        @foreach($states as $state)
                        <li>
                            <a class="one-link--dark one-color--black-300" href="{{url($state->state_code)}}">{{$state->state}}</a>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <h2 class="header-title-2">About this page</h2>
                    <p class="lead">From big cities to small towns, we’ve got pros covering every county in the United States. From the smallest job to the toughest we've got it covered.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
