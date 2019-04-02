@extends('pages.admin')
@section('title')
    Upravljanje odgovorima za anketu
@endsection
@section('naslov')
    Upravljanje odgovorima za anketu
@endsection
@section('unos')
    <form method="post" action="{{ isset($odgovor)?asset('/admin/odgovori/'.$odgovor->id.'/edit'):asset('/admin/odgovori/add') }}" role="form" enctype="multipart/form-data">
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
            <input id="alt" type="text" class="form-control" name="naziv" value="{{ isset($odgovor)?$odgovor->odgovor:'' }}"/>
        </div>
        <div class="form-group">
            <label class="control-label" for="naziv">Pitanje</label>
            <select name="pitanje" class="form-control">
                <option value="0">Izaberite pitanje...</option>
                @foreach($pitanja as $pitanje)
                    @if(isset($odgovor) && $odgovor->pitanje_id == $pitanje->id)
                        <option value="{{ $pitanje->id }}" selected>{{ $pitanje->naziv }}</option>
                        @else
                        <option value="{{ $pitanje->id }}">{{ $pitanje->naziv }}</option>
                        @endif
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ isset($odgovor)?'Izmeni odgovor':'Dodaj odgovor' }}</button>
        </div>
    </form>
@endsection
@section('tabela')
    <tr>
        <th>#</th>
        <th>Odgovor</th>
        <th>Pitanje</th>
        <th>Izmeni</th>
        <th>Obrisi</th>
    </tr>
    @foreach($odgovori as $odgovor)
        <tr>
            <td>{{ $odgovor->odgovorId }}</td>
            <td>{{ $odgovor->odgovor }}</td>
            <td>{{ $odgovor->naziv }}</td>
            <td><a href="{{ asset('/admin/odgovori/'.$odgovor->odgovorId) }}">Izmeni</a></td>
            <td><a href="{{ asset('/admin/odgovori/'.$odgovor->odgovorId.'/delete') }}">Obrisi</a></td>
        </tr>
    @endforeach
@endsection
