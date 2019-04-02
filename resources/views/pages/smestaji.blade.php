@extends('layout.fronttemplate')
@section('title')
    {{ $smestaji[0]->nazivOblasti }}
@endsection
@section('putanja')
    <div class="row">
        <ol class="breadcrumb adresa">
            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ asset('/category/'.$smestaji[0]->nazivKontinenta) }}">{{ $smestaji[0]->nazivKontinenta }}</a></li>
            <li class="breadcrumb-item"><a href="{{ asset('/category/'.$smestaji[0]->nazivKontinenta.'/'.$smestaji[0]->nazivDrzave)}}">{{ $smestaji[0]->nazivDrzave }}</a></li>
            <li class="breadcrumb-item active  text-white" aria-current="page">{{ $smestaji[0]->nazivOblasti }}</li>
        </ol>
    </div>
@endsection
@section('glavno')
    <div class="row d-flex justify-content-center">
        <div class="col-md-11 visina bg-light rounded">
            <div class="smestaji">
                @include('pages.smestajiAjax')
            </div>
            <div class="row d-flex justify-content-center paginacija">
                {{ $smestaji->links() }}
            </div>
        </div>
    </div>
    <script>/*
        const url="{{ url()->current() }}";
        $(document).ready(function () {
            $(".page-link:contains(›)").hide();
            $(".page-link:contains(‹)").hide();
        });*/
    </script>
    <script src="{{ asset('/js/ajax.js') }}">
    </script>
@endsection