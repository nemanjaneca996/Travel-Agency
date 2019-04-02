@extends('pages.admin')
@section('title')
    Prikaz rezervacija
@endsection
@section('naslov')
    Prikaz rezervacija
@endsection

@section('tabela')
    <tr>
        <th>idKorisnika</th>
        <th>Ime</th>
        <th>Prezime</th>
        <th>Smestaj</th>
        <th>Vreme rezervacije</th>
        <th>Tip sobe</th>
        <th>Datum polaska</th>
        <th>Napomena</th>
    </tr>
    @foreach($rezervacije as $rez)
        <tr>
            <td>{{ $rez->userId }}</td>
            <td>{{ $rez->ime}}</td>
            <td>{{ $rez->prezime }}</td>
            <td>{{ $rez->naziv }}</td>
            <td>{{ date("m.d.y G:i",$rez->vreme) }}</td>
            <td>{{ $rez->tipSobe }}</td>
            <td>{{ $rez->datumPolaska }}</td>
            <td>{{ $rez->napomena }}</td>
        </tr>
    @endforeach
@endsection
