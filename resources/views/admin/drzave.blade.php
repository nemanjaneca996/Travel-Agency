@extends('pages.admin')
@section('title')
    Upravljanje zemljama
@endsection
@section('naslov')
    Upravljanje zemljama
@endsection
@section('unos')
    <form method="post" action="{{ isset($zemlja)?asset('/admin/drzave/'.$zemlja->id.'/edit'):asset('/admin/drzave/add') }}" role="form" enctype="multipart/form-data">
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
            <input id="alt" type="text" class="form-control" name="naziv" value="{{ isset($zemlja)?$zemlja->naziv:'' }}"/>
        </div>
        <div class="form-group">
            <label class="control-label">Kontinent</label>
            <select class="form-control" name="kontinent">
                <option value="0">Izaberite kontinent..</option>
                @isset($kontinenti)
                    @foreach($kontinenti as $kontinent)
                        @if(isset($zemlja) && $zemlja->kontinent_id==$kontinent->id)
                        <option value="{{ $kontinent->id }}" selected>{{ $kontinent->naziv }}</option>
                        @else
                            <option value="{{ $kontinent->id }}">{{ $kontinent->naziv }}</option>
                            @endif
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ isset($zemlja)?'Izmeni kontinent':'Dodaj kontinent' }}</button>
        </div>
    </form>
@endsection
@section('tabela')
    <tr>
        <th>#</th>
        <th>Naziv</th>
        <th>Kontinent</th>
        <th>Izmeni</th>
        <th>Obrisi</th>
    </tr>
    @isset($zemlje)
        @foreach($zemlje as $zemlja)
            <tr>
                <td>{{ $zemlja->drzavaId }}</td>
                <td>{{ $zemlja->nazivDrzave }}</td>
                <td>{{ $zemlja->nazivKontinent }}</td>
                <td><a href="{{ asset('/admin/drzave/'.$zemlja->drzavaId) }}">Izmeni</a></td>
                <td><a href="{{ asset('/admin/drzave/'.$zemlja->drzavaId.'/delete') }}">Obrisi</a></td>
            </tr>
        @endforeach
    @endisset
@endsection
