@extends('pages.admin')
@section('title')
    Upravljanje meni-om
@endsection
@section('naslov')
    Upravljanje meni-om
@endsection
@section('unos')
    <form method="post" action="{{ isset($Meni)?asset('/admin/meni/'.$Meni->id.'/edit'):asset('/admin/meni/add') }}" role="form" enctype="multipart/form-data">
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
            <input id="alt" type="text" class="form-control" name="naziv" value="{{ isset($Meni)?$Meni->naziv:'' }}"/>
        </div>
        <div class="form-group">
            <label class="control-label" for="adresa">Adresa</label>
            <input id="alt" type="text" class="form-control" name="adresa" value="{{ isset($Meni)?$Meni->adresa:'' }}"/>
        </div>
        <div class="form-group">
            <label class="control-label">Roditelj</label>
            <select class="form-control" name="roditelj">
                <option value="0">Izaberite roditelja..</option>
                @isset($meni)
                    @foreach($meni as $m)
                        @if(isset($Meni) && $Meni->parent == $m->id)
                            <option value="{{ $m->id }}" selected>{{ $m->naziv }}</option>
                            @else
                            <option value="{{ $m->id }}">{{ $m->naziv }}</option>
                            @endif
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Dodaj stavku u meni</button>
        </div>
    </form>
    @endsection
@section('tabela')
    <tr>
        <th>#</th>
        <th>Naziv</th>
        <th>Adresa</th>
        <th>Roditelj</th>
        <th>Izmeni</th>
        <th>Obrisi</th>
    </tr>
    @foreach($meni as $m)
        <tr>
            <td>{{ $m->id }}</td>
            <td>{{ $m->naziv }}</td>
            <td>{{ $m->adresa }}</td>
            <td>{{ $m->parent }}</td>
            <td><a href="{{ asset('/admin/meni/'.$m->id) }}">Izmeni</a></td>
            <td><a href="{{ asset('/admin/meni/'.$m->id.'/delete') }}">Obrisi</a></td>
        </tr>
    @endforeach
    @endsection