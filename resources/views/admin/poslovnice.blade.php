@extends('pages.admin')
@section('title')
    Upravljanje poslovnicama
    @endsection
@section('naslov')
    Upravljanje poslovnicama
@endsection
@section('unos')
    <form method="post" action="{{ isset($poslovnica)?asset('/admin/poslovnice/edit/'.$poslovnica->id):asset('/admin/poslovnice/add') }}" role="form" enctype="multipart/form-data">
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
            <label class="control-label" for="naziv">Naslov</label>
            <input id="alt" type="text" class="form-control" name="naslov" value="{{ isset($poslovnica)?$poslovnica->naslov:'' }}"/>
        </div>
        <div class="form-group">
            <label class="control-label" for="naziv">Adresa</label>
            <input id="alt" type="text" class="form-control" name="adresa" value="{{ isset($poslovnica)?$poslovnica->adresa:'' }}"/>
        </div>
        <div class="form-group">
            <label class="control-label" for="naziv">Tel</label>
            <input id="alt" type="text" class="form-control" name="tel" value="{{ isset($poslovnica)?$poslovnica->tel:'' }}"/>
        </div>
        <div class="form-group">
            <label class="control-label" for="naziv">Fax</label>
            <input id="alt" type="text" class="form-control" name="fax" value="{{ isset($poslovnica)?$poslovnica->fax:'' }}"/>
        </div>
        <div class="form-group">
            <label class="control-label" for="naziv">Mob</label>
            <input id="alt" type="text" class="form-control" name="mob" value="{{ isset($poslovnica)?$poslovnica->mob:'' }}"/>
        </div>
        <div class="form-group">
            <label class="control-label" for="naziv">Email</label>
            <input id="alt" type="text" class="form-control" name="email" value="{{ isset($poslovnica)?$poslovnica->email:'' }}"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ isset($poslovnica)?'Izmeni poslovnicu':'Dodaj poslovnicu' }}</button>
        </div>
    </form>
    @endsection
@section('tabela')
    <tr>
        <th>#</th>
        <th>Naslov</th>
        <th>Adresa</th>
        <th>Tel</th>
        <th>Fax</th>
        <th>Mob</th>
        <th>Email</th>
        <th>Izmeni</th>
        <th>Obrisi</th>
    </tr>
    @foreach($poslovnice as $pos)
        <tr>
            <td>{{ $pos->id }}</td>
            <td>{{ $pos->naslov }}</td>
            <td>{{ $pos->adresa }}</td>
            <td>{{ $pos->tel }}</td>
            <td>{{ $pos->fax }}</td>
            <td>{{ $pos->mob }}</td>
            <td>{{ $pos->email }}</td>
            <td><a href="{{ asset('/admin/poslovnice/'.$pos->id) }}">Izmeni</a></td>
            <td><a href="{{ asset('/admin/poslovnice/'.$pos->id.'/delete') }}">Obrisi</a></td>
        </tr>
    @endforeach
    @endsection