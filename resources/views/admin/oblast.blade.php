@extends('pages.admin')
@section('title')
    Upravljanje oblastima/gradovima
@endsection
@section('naslov')
    Upravljanje oblastima/gradovima
@endsection
@section('unos')
    <form method="post" action="{{ isset($oblast)?asset('/admin/oblasti/'.$oblast->id.'/edit'):asset('/admin/oblasti/add') }}" role="form" enctype="multipart/form-data">
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
            <input id="alt" type="text" class="form-control" name="naziv" value="{{ isset($oblast)?$oblast->naziv:'' }}"/>
        </div>
        <div class="form-group">
            <label class="control-label">Drzava</label>
            <select class="form-control" name="drzava">
                <option value="0">Izaberite kontinent..</option>
                @foreach($drzave as $drzava)
                    @if(isset($oblast) && $oblast->drzava_id==$drzava->drzavaId)
                    <option value="{{ $drzava->drzavaId }}" selected>{{ $drzava->nazivDrzave }}</option>
                    @else
                        <option value="{{ $drzava->drzavaId }}">{{ $drzava->nazivDrzave }}</option>
                        @endif
                @endforeach
            </select>
        </div>
        @isset($oblast)
            <div class="form-group">
                <img src="{{ asset($oblast->slika) }}" alt="{{ $oblast->naziv }}" class="admin-slika" />
            </div>
        @endisset
        <div class="form-group">
            <label for="exampleFormControlFile1">Postavite sliku</label>
            <input type="file" class="form-control-file" name="slika">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ isset($oblast)?'Izmeni oblast':'Dodaj oblast' }}</button>
        </div>
    </form>
@endsection
@section('tabela')
    <tr>
        <th>#</th>
        <th>Naziv</th>
        <th>Drzava</th>
        <th>Izmeni</th>
        <th>Obrisi</th>
    </tr>
    @foreach($oblasti as $oblast)
        <tr>
            <td><img src="{{ asset($oblast->slika) }}" alt="{{ $oblast->naziv }}" class="admin-slika"/></td>
            <td>{{ $oblast->nazivOblasti }}</td>
            <td>{{ $oblast->nazivDrzave }}</td>
            <td><a href="{{ asset('/admin/oblasti/'.$oblast->oblastId) }}">Izmeni</a></td>
            <td><a href="{{ asset('/admin/oblasti/'.$oblast->oblastId.'/delete') }}">Obrisi</a></td>
        </tr>
    @endforeach
@endsection
