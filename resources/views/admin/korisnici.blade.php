@extends('pages.admin')
@section('title')
    Upravljanje korisnicima
@endsection
@section('naslov')
    Upravljanje korisnicima
    @endsection
@section('unos')
            <form method="post" action="{{ isset($user)?asset('/admin/korisnici/'.$user->userId.'/update'):route('insert') }}" role="form" enctype="multipart/form-data">
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
                    <label class="control-label" for="signupName">Ime</label>
                    <input id="signupName" type="text" class="form-control" name="ime" value="{{ isset($user)?$user->ime:'' }}"/>
                </div>
                <div class="form-group">
                    <label class="control-label" for="signupLastname">Prezime</label>
                    <input id="signupEmail" type="text" class="form-control" name="prezime" value="{{ isset($user)?$user->prezime:'' }}"/>
                </div>
                <div class="form-group">
                    <label class="control-label" for="signupEmail">Email</label>
                    <input id="signupEmailagain" type="email" class="form-control" name="email" value="{{ isset($user)?$user->email:'' }}"/>
                </div>
                <div class="form-group">
                    <label class="control-label" for="signupPassword">Password</label>
                    <input id="signupPassword" type="password" class="form-control" name="password"/>
                </div>
                <div class="form-group">
                    <select class="form-control" name="uloga">
                        <option value="0">Izaberite ulogu..</option>
                        @isset($uloge)
                            @foreach($uloge as $uloga)
                                @if(isset($user) && $user->naziv==$uloga->naziv)
                                    <option value="{{ $uloga->id }}" selected>{{ $uloga->naziv }}</option>
                                @else
                                    <option value="{{ $uloga->id }}">{{ $uloga->naziv }}</option>
                                @endif
                                @endforeach
                            @endisset
                    </select>
                </div>
                @isset($user)
                <div class="form-group">
                    <img src="{{ asset($user->slika) }}" alt="{{ $user->ime }}" class="admin-slika" />
                </div>
                @endisset
                <div class="form-group">
                    <label for="exampleFormControlFile1">Postavite sliku</label>
                    <input type="file" class="form-control-file" name="slika">
                </div>
                <div class="form-group">
                    <button id="signupSubmit" type="submit" class="btn btn-primary">{{ isset($user)?'Izmenite nalog':'Napravite nalog' }}</button>
                </div>
            </form>
            @endsection
            @section('tabela')
                <tr>
                    <th>#</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Email</th>
                    <th>Uloga</th>
                    <th>Izmeni</th>
                    <th>Obrisi</th>
                </tr>
                @isset($users)
                    @foreach($users as $user)
                        <tr>
                            <th><img src="{{ asset($user->slika) }}" alt="{{ $user->ime }}" class="korisnik-slika"/></th>
                            <td>{{ $user->ime }}</td>
                            <td>{{ $user->prezime }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->naziv }}</td>
                            <td><a href="{{ asset('/admin/korisnici/'.$user->userId) }}">Izmeni</a></td>
                            <td><a href="{{ asset('/admin/korisnici/delete/'.$user->userId) }}">Obrisi</a></td>
                        </tr>
                        @endforeach
                @endisset
            @endsection