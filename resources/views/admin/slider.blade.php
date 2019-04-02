@extends('pages.admin')
@section('title')
    Upravljanje slider-om
@endsection
@section('naslov')
    Upravljanje slider-om
@endsection
@section('unos')
    <form method="post" action="{{ route('dodajSlikuZaSlider') }}" role="form" enctype="multipart/form-data">
        {{ csrf_field() }}
        @isset($errors)
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
        @endisset
        @empty(!session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endempty
        @empty(!session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endempty
        <div class="form-group">
            <label class="control-label" for="alt">Alt</label>
            <input id="alt" type="text" class="form-control" name="alt" value=""/>
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Postavite sliku</label>
            <input type="file" class="form-control-file" name="slika">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Dodaj sliku</button>
        </div>
    </form>
@endsection
@section('tabela')
    <tr>
        <th>#</th>
        <th>Alt</th>
        <th>Slika</th>
        <th>Made by</th>
        <th>Made at</th>
        <th>Obrisi</th>
    </tr>
    @isset($slike)
        @foreach($slike as $slika)
            <tr>
                <td>{{ $slika->sliderId }}</td>
                <td>{{ $slika->alt }}</td>
                <td><img src="{{ asset($slika->url) }}" alt="{{ $slika->alt }}" class="slider-slika"/></td>
                <td>{{ $slika->ime.' '.$slika->prezime }}</td>
                <td>{{ date("m.d.y G:i",$slika->made_date) }}</td>
                <td><a href="{{ asset('/admin/slider/'.$slika->sliderId.'/delete') }}">Obrisi</a></td>
            </tr>
        @endforeach
    @endisset
@endsection