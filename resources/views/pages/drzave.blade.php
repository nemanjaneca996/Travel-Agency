@extends('layout.fronttemplate')
@section('title')
    {{ $drzave[0]->naziv }}
@endsection
@section('putanja')
    <div class="row">
        <ol class="breadcrumb adresa">
            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
            <li class="breadcrumb-item active  text-white" aria-current="page">{{ $drzave[0]->nazivKontinent }}</li>
        </ol>
    </div>
@endsection
@section('glavno')
    <div class="row d-flex justify-content-center">
        <div class="col-md-11 visina bg-light rounded">
            <ul class="list-group">
                @foreach($drzave as $drzava)
                    <li class="list-group-item">
                        <a href="{{ asset('/category/'.$drzava->nazivKontinent.'/'.$drzava->nazivDrzave) }}">{{ $drzava->nazivDrzave }}</a>
                    </li>
                    @endforeach
            </ul>
        </div>
    </div>
    @endsection