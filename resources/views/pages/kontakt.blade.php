@extends('layout.fronttemplate')
@section('title')
    Kontakt
@endsection
@section('putanja')
    <div class="row">
        <ol class="breadcrumb adresa">
            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
            <li class="breadcrumb-item active  text-white" aria-current="page">Kontakt</li>
        </ol>
    </div>
@endsection
@section('glavno')
    <div class="row d-flex justify-content-center">
        <div class="col-md-11 visina bg-light rounded">
            @foreach($poslovnice as $pos)
                <br/>
            <div class="row text-center d-flex justify-content-center">
                <div class="col-md-5">
                    <h3>{{ $pos->naslov }}</h3>
                    <p>{{ $pos->adresa }}</p>
                    Tel: {{ $pos->tel }}<br/>
                    Fax: {{ $pos->fax }}<br/>
                    <p>Mob: {{ $pos->mob }}</p>
                    <p>E-mail:{{ $pos->email }}</p>
                </div>
            </div><br/>
            @endforeach
        </div>
    </div>
@endsection