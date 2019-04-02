@extends('layout.fronttemplate')
@section('title')
    Home
@endsection
@section('putanja')
    <div class="row">
        <ol class="breadcrumb adresa">
            <li class="breadcrumb-item active  text-white" aria-current="page">Home</li>
        </ol>
    </div>
@endsection
@section('glavno')
<div class="row slider">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($sliders as $slider)
                @if($loop->index==0)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="active"></li>
                    @else
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}"></li>
                    @endif
                @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach($sliders as $slider)
                @if($loop->index==0)
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset($slider->url) }}" alt="{{ $slider->alt }}">
                    </div>
                @else
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset($slider->url) }}" alt="{{ $slider->alt }}">
                    </div>
                @endif
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<h2 class="text-center">Top ponuda</h2>
<div class="row d-flex justify-content-around">
    @foreach($tops as $top)
        <div class="card top">
            <img class="card-img-top" src="{{ $top->url }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ $top->nazivSmestaja }}</h5>
                <p class="card-text">{{ $top->nazivOblasti }}</p>
                <p class="card-text">{{ $top->nazivTipa }}</p>
                <a href="{{ asset('/smestaj/'.$top->smestajId) }}" class="btn btn-primary">Prikazi</a>
            </div>
        </div>
        @endforeach
</div>
    @endsection