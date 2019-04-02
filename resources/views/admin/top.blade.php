@extends('pages.admin')
@section('title')
    Izdvajanje iz ponude
@endsection
@section('naslov')
    Izdvajanje iz ponude
@endsection
@section('tabela')
    <tr>
        <td>#</td>
        <td>Naziv</td>
        <td>Upravljanje</td>
        <td>Status</td>
    </tr>
    @foreach($smestaji as $smestaj)
        <tr>
            <td><img src="{{ asset($smestaj->url) }}" alt="{{ $smestaj->alt }}" class="admin-slika"/></td>
            <td>{{ $smestaj->nazivSmestaja }}</td>
            @if($smestaj->top != 1)
                <td><a href="{{ asset('/admin/top/add/'.$smestaj->smestajId) }}">Dodaj</a></td>
                @else
                <td><a href="{{ asset('/admin/top/delete/'.$smestaj->smestajId) }}">Ukloni</a></td>
            @endif
            @if($smestaj->top != 1)
                <td> </td>
            @else
                <td>Top</td>
            @endif
        </tr>
    @endforeach
    @endsection