@extends('layout.fronttemplate')
@section('title')
        {{ $oblasti[0]->naziv }}
@endsection
@section('putanja')
    <div class="row">
        <ol class="breadcrumb adresa">
            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ asset('/category/'.$oblasti[0]->nazivKontinenta) }}">{{ $oblasti[0]->naziv }}</a></li>
            <li class="breadcrumb-item active  text-white" aria-current="page">{{ $oblasti[0]->nazivDrzave }}</li>
        </ol>
    </div>
    @endsection
@section('glavno')
    <div class="row d-flex justify-content-center">
        <div class="col-md-11 visina bg-light rounded">
            <h2 align="center">Oblasti/Gradovi</h2>
            <div class="row d-flex justify-content-around">
                @foreach($oblasti as $oblast)

                        <div class="card oblasti">
                            <img class="card-img-top oblasti-slika center-block" src="{{ asset($oblast->slika) }}" alt="{{ $oblast->naziv }}">
                            <div class="card-body">
                                <h3 class="card-title">{{ $oblast->nazivOblasti }}</h3>
                                <a href="{{ asset('/oblast/'.$oblast->oblastId) }}" class="btn btn-primary">Prikazi</a>
                            </div>
                        </div>

                    @endforeach
            </div>
        </div>
    </div>
    @endsection