@extends('pages.admin')
@section('title')
    Upravljanje slikama smestaja
@endsection
@section('naslov')
    Upravljanje slikama smestaja
@endsection

@section('unos')
    @isset($smestaj)
        <form method="post" action="{{ asset('/admin/slike/'.$smestaj->smestajId.'/add') }}" role="form" enctype="multipart/form-data">
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
                <label class="control-label" for="naziv">{{ $smestaj->nazivSmestaja }}</label>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Postavite sliku</label>
                <input type="file" class="form-control-file" name="slika">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Uneti sliku</button>
            </div>
        </form>
    @endisset
    @endsection
@section('brisanje')
    @isset($smestaj)
        <form method="post" action="{{ asset('/admin/slike/'.$smestaj->smestajId.'/delete') }}"  enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label">Izaberite sta hocete da izbrisete</label>
            </div>
            <div class="form-group d-flex justify-content-center">
                @foreach($slike as $slika)
                    <div class="text-center">
                        <label class="image-checkbox">
                            <img class="img-responsive admin-slika" src="{{ asset($slika->url) }}" />
                            <input type="checkbox" name="slike[]" value="{{ $slika->url }}" />
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Izbrisi slike</button>
            </div>
        </form>
    @endisset
    @endsection
@section('tabela')
    <tr>
        <th>#</th>
        <th>Naziv</th>
        <th>Izmeni</th>
    </tr>
    @isset($smestaji)
        @foreach($smestaji as $smestaj)
            <tr>
                <td><img src="{{ asset($smestaj->url) }}" alt="{{ $smestaj->alt }}" class="admin-slika"/></td>
                <td>{{ $smestaj->nazivSmestaja }}</td>
                <td><a href="{{ asset('/admin/slike/'.$smestaj->smestajId) }}">Izmeni</a></td>
            </tr>
        @endforeach
        {{ $smestaji->links() }}
    @endisset
    @endsection
