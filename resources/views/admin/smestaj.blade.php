@extends('pages.admin')
@section('title')
    Upravljanje smestajima
@endsection
@section('naslov')
    Upravljanje smestajima
@endsection
@section('unos')
    <form method="post" action="{{ isset($Smestaj)?asset('/admin/smestaj/'.$Smestaj->smestajId.'/edit'):asset('/admin/smestaj/insert') }}" role="form" enctype="multipart/form-data">
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
            <label class="control-label" for="naziv">Naziv</label>
            <input type="text" class="form-control" name="naziv" value="{{isset($Smestaj)?$Smestaj->nazivSmestaja:''}}"/>
        </div>
        <div class="form-group">
            <label class="control-label" for="naziv">Broj zvezdica</label>
            <input type="number" class="form-control" name="brojzvezdica" value="{{isset($Smestaj)?$Smestaj->brojZvezdica:''}}"/>
        </div>
        <div class="form-group">
            <label class="control-label" for="naziv">Opis</label>
            <textarea class="form-control" name="opis">{{isset($Smestaj)?$Smestaj->opis:''}}</textarea>
        </div>
        <div class="form-group">
            <label class="control-label">Oblast</label>
            <select class="form-control" name="oblast">
                <option value="0">Izaberite oblast..</option>
                @foreach($oblasti as $oblast)
                    @if(isset($Smestaj) && $Smestaj->oblastId == $oblast->oblastId)
                        <option value="{{ $oblast->oblastId }}" selected>{{ $oblast->nazivOblasti }}</option>
                        @else
                        <option value="{{ $oblast->oblastId }}">{{ $oblast->nazivOblasti }}</option>
                        @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="control-label">Tip</label>
            <select class="form-control" name="tip">
                <option value="0">Izaberite tip..</option>
                @foreach($tipovi as $tip)
                    @if(isset($Smestaj) && $Smestaj->tipId == $tip->id)
                        <option value="{{ $tip->id }}" selected>{{ $tip->naziv }}</option>
                        @else
                        <option value="{{ $tip->id }}">{{ $tip->naziv }}</option>
                        @endif
                @endforeach
            </select>
        </div>
        @isset($Smestaj)
            <div class="form-group">
                <img src="{{ asset($Smestaj->url) }}" alt="{{ $Smestaj->alt }}" class="admin-slika" />
            </div>
        @endisset
        <div class="form-group">
            <label for="exampleFormControlFile1">Postavite glavnu sliku</label>
            <input type="file" class="form-control-file" name="slika">
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Postavite cenovnik</label>
            @isset($Smestaj)
                <input type="" class="form-control" name="stariCenovnik" value="{{ $Smestaj->cenovnik }}" readonly/>
            @endisset
            <input type="file" class="form-control-file" name="cenovnik">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Uneti smestaj</button>
        </div>
    </form>
@endsection
@section('tabela')
    <tr>
        <th>#</th>
        <th>Naziv</th>
        <th>Broj Zvezdica</th>
        <th>Opis</th>
        <th>Oblast</th>
        <th>Tip</th>
        <th>Made by</th>
        <th>Made at</th>
        <th>Edit by</th>
        <th>Edit at</th>
        <th>Izmeni</th>
        <th>Obrisi</th>
    </tr>
    @isset($smestaji)
        @foreach($smestaji as $smestaj)
            <tr>
                <td><img src="{{ asset($smestaj->url) }}" alt="{{ $smestaj->alt }}" class="admin-slika"/></td>
                <td>{{ $smestaj->nazivSmestaja }}</td>
                <td>{{ $smestaj->brojZvezdica }}*</td>
                <td>{{ $smestaj->opis}}</td>
                <td>{{ $smestaj->nazivOblasti }}</td>
                <td>{{ $smestaj->nazivTipa }}</td>
                <td>{{ $smestaj->madeIme.' '.$smestaj->madePrezime }}</td>
                <td>{{ date("m.d.y G:i",$smestaj->made_date) }}</td>
                <td>@if($smestaj->editIme == null)
                        /
                    @else
                    {{ $smestaj->editIme.' '.$smestaj->editPrezime }}
                        @endif
                </td>
                <td>@if($smestaj->editIme == null)
                        /
                    @else
                    {{ date("m.d.y G:i",$smestaj->edit_date) }}
                    @endif
                </td>
                <td><a href="{{ asset('/admin/smestaj/'.$smestaj->smestajId) }}">Izmeni</a></td>
                <td><a href="{{ asset('/admin/smestaj/'.$smestaj->smestajId.'/delete') }}">Obrisi</a></td>
            </tr>
        @endforeach
        {{ $smestaji->links() }}
    @endisset
@endsection

