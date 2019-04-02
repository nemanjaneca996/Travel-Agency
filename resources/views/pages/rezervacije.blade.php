@extends('layout.fronttemplate')
@section('title')
    Rezervacije
@endsection
@section('putanja')
    <div class="row">
        <ol class="breadcrumb adresa">
            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
            <li class="breadcrumb-item active  text-white" aria-current="page">Rezervacije</li>
        </ol>
    </div>
@endsection
@section('glavno')
    <div class="row d-flex justify-content-center">
        <div class="col-md-11 visina bg-light rounded">
            @if(!empty($rezervacije[0]))
        <table class="table">
            <tr>
                <td>Naziv smestaja</td>
                <td>Datum polaska</td>
                <td>Tip sobe</td>
                <td>Napomena</td>
                <td>Otkazite</td>
            </tr>
                @foreach($rezervacije as $rez)
                    <tr>
                        <td>{{ $rez->naziv }}</td>
                        <td>{{ $rez->datumPolaska }}</td>
                        <td>{{ $rez->tipSobe }}</td>
                        <td>{{ $rez->napomena }}</td>
                        <td><a href="{{ asset('/rezervacija/delete/'.$rez->rezId) }}" class="btn btn-primary">Ukloni</a></td>
                    </tr>
                    @endforeach

        </table>

            @else
                <h4>Trenutno nemate ni jednu rezervaciju!</h4>
            @endif
        </div>
    </div>
@endsection