@extends('pages.admin')
@section('title')
    Upravljanje pitanjima za anketu
@endsection
@section('naslov')
    Upravljanje pitanjima za anketu
@endsection
@section('unos')
    <form method="post" action="{{ isset($pitanje)?asset('/admin/pitanja/'.$pitanje->id.'/edit'):asset('/admin/pitanja/add') }}" role="form" enctype="multipart/form-data">
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
            <input id="alt" type="text" class="form-control" name="naziv" value="{{ isset($pitanje)?$pitanje->naziv:'' }}"/>
        </div>
        <div class="form-group">
            <label class="control-label" for="naziv">Aktivno:
                @if(isset($pitanje) && $pitanje->aktivno == 1)
                    <input type="checkbox" name="aktivnost" checked/>
                    @else
                    <input type="checkbox" name="aktivnost"/>
                    @endif
            </label>

        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ isset($pitanje)?'Izmeni pitanje':'Dodaj pitanje' }}</button>
        </div>
    </form>
@endsection
@section('tabela')
    <tr>
        <th>#</th>
        <th>Naziv</th>
        <th>Aktivnost</th>
        <th>Izmeni</th>
        <th>Obrisi</th>
    </tr>
    @foreach($pitanja as $pitanje)
        <tr>
            <td>{{ $pitanje->id }}</td>
            <td>{{ $pitanje->naziv }}</td>
            <td>{{ $pitanje->aktivno }}</td>
            <td><a href="{{ asset('/admin/pitanja/'.$pitanje->id) }}">Izmeni</a></td>
            <td><a href="{{ asset('/admin/pitanja/'.$pitanje->id.'/delete') }}">Obrisi</a></td>
        </tr>
    @endforeach
@endsection
