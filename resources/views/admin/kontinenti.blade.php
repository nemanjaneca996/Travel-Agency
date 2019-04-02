@extends('pages.admin')
@section('title')
    Upravljanje kontinentima
@endsection
@section('naslov')
    Upravljanje kontinentima
@endsection
@section('unos')
    <form method="post" action="{{ isset($kontinent)?asset('/admin/kontinenti/'.$kontinent->id.'/edit'):asset('/admin/kontinenti/add') }}" role="form" enctype="multipart/form-data">
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
            <input id="alt" type="text" class="form-control" name="naziv" value="{{ isset($kontinent)?$kontinent->naziv:'' }}"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ isset($kontinent)?'Izmeni kontinent':'Dodaj kontinent' }}</button>
        </div>
    </form>
    @endsection
@section('tabela')
    <tr>
        <th>#</th>
        <th>Naziv</th>
        <th>Made by</th>
        <th>Made at</th>
        <th>Edit by</th>
        <th>Edit at</th>
        <th>Izmeni</th>
        <th>Obrisi</th>
    </tr>
    @isset($kontinenti)
    @foreach($kontinenti as $kontinent)
        <tr>
            <td>{{ $kontinent->kontinentId }}</td>
            <td>{{ $kontinent->naziv }}</td>
            <td>{{ $kontinent->madeIme.' '.$kontinent->madePrezime }}</td>
            <td>{{ date("m.d.y G:i",$kontinent->made_date) }}</td>
            <td>@if($kontinent->editIme == null)
                    /
                @else
                    {{ $kontinent->editIme.' '.$kontinent->editPrezime }}
                @endif
            </td>
            <td>@if($kontinent->editIme == null)
                    /
                @else
                    {{ date("m.d.y G:i",$kontinent->edit_date) }}
                @endif
            </td>
            <td><a href="{{ asset('/admin/kontinenti/'.$kontinent->kontinentId) }}">Izmeni</a></td>
            <td><a href="{{ asset('/admin/kontinenti/'.$kontinent->kontinentId.'/delete') }}">Obrisi</a></td>
        </tr>
    @endforeach
    @endisset
    @endsection
