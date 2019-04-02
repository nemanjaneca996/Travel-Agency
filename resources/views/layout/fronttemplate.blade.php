@extends('layout.template')
@section('template')
    <div class="container holder">
    @include('components.header')

    @yield('putanja')

    @yield('glavno')

    @include('components.footer')
    </div>
@endsection