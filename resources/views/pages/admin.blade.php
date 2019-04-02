@extends('layout.template')
@section('title')
        AdminPanel
@endsection
@section('template')
    <div class="container-fluid">
        <div class="row visina">
            <div class="col-md-3 bg-dark">
                <h2 class="font-italic text-center text-white">Admin panel</h2>
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{ route('korisnici') }}">Korisnici</a></li>
                    <li class="list-group-item"><a href="{{ route('slider') }}">Slider</a></li>
                    <li class="list-group-item"><a href="{{ route('meni') }}">Meni</a></li>
                    <li class="list-group-item"><a href="{{ route('kontineti') }}">Kontinenti</a></li>
                    <li class="list-group-item"><a href="{{ route('drzave') }}">Zemlje</a></li>
                    <li class="list-group-item"><a href="{{ route('oblasti') }}">Oblasti/Gradovi</a></li>
                    <li class="list-group-item"><a href="{{ route('smestaj') }}">Smestaj</a></li>
                    <li class="list-group-item"><a href="{{ route('slike') }}">Slike smestaja</a></li>
                    <li class="list-group-item"><a href="{{ route('top') }}">Izdvojeno iz ponude</a></li>
                    <li class="list-group-item"><a href="{{ asset('/admin/rezervacije') }}">Rezervacije</a></li>
                    <li class="list-group-item"><a href="{{ route('poslovnice') }}">Poslovnice</a></li>
                    <li class="list-group-item"><a href="{{ route('pitanja') }}">Pitanja-Anketa</a></li>
                    <li class="list-group-item"><a href="{{ route('odgovori') }}">Odgovori-Anketa</a></li>
                </ul>
                <a href="{{ asset('/dokumentacija') }}" class="btn btn-primary">Dokumentacija</a>
            </div>
            <div class="col-md-9 bg-light">
                <div class="row">
                    <div class="col-md-6">
                        <h1>@yield('naslov')</h1>
                    </div>
                    <div class="col-md-6">
                        <div class="dropdown d-flex justify-content-end">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <p class="text-white"><img src="{{ asset(session()->get('user')[0]->slika) }}" alt="{{ session()->get('user')[0]->ime }}" class="rounded-circle admin-slika"/> &nbsp &nbsp{{ session()->get('user')[0]->ime." ".session()->get('user')[0]->prezime }}</p>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ asset('/') }}">Nazad na sajt</a><br/>
                                <a class="dropdown-item" href="{{ asset('/admin/korisnici/'.session()->get('user')[0]->userId) }}">Edituj nalog</a><br/>
                                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        @yield('unos')
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        @yield('brisanje')
                    </div>
                    <table class="table prikaz">
                        @yield('tabela')
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection