@extends('layout.fronttemplate')
@section('title')
    Register
@endsection
@section('putanja')
    <div class="row">
        <ol class="breadcrumb adresa">
            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
            <li class="breadcrumb-item active  text-white" aria-current="page">Registracija</li>
        </ol>
    </div>
@endsection
@section('glavno')
  <div class="row visina">
      <div class="col-md-12">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                  <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Log in</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Registration</a>
              </li>
          </ul>
          <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                  <div class="row justify-content-md-center registracija">
                      <div class="col-md-4 align-self-center">
                          @empty(!session('error'))
                              <div class="alert alert-danger" role="alert">
                                  {{ session('error') }}
                              </div>
                          @endempty
                              @empty(!session('success'))
                                  <div class="alert alert-success" role="alert">
                                      {{ session('success') }}
                                  </div>
                              @endempty
                          <form action="{{ route('login') }}" method="post">
                              {{ csrf_field() }}
                              <div class="form-group">
                                  <label for="exampleDropdownFormEmail2">Email address</label>
                                  <input type="email" class="form-control" id="exampleDropdownFormEmail2" name="email" placeholder="email@example.com">
                              </div>
                              <div class="form-group">
                                  <label for="exampleDropdownFormPassword2">Password</label>
                                  <input type="password" class="form-control" id="exampleDropdownFormPassword2" name="password" placeholder="Password">
                              </div>
                              <button type="submit" class="btn btn-primary">Log in</button>
                          </form>
                      </div>
                  </div>
              </div>
              <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                  <div class="row justify-content-md-center registracija">
                      <div class="col-md-4 align-self-center">
                          <form method="post" action="{{ route('register') }}" role="form" enctype="multipart/form-data">
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
                              <div class="form-group">
                                  <label class="control-label" for="signupName">Ime</label>
                                  <input id="signupName" type="text" class="form-control" name="ime"/>
                              </div>
                              <div class="form-group">
                                  <label class="control-label" for="signupLastname">Prezime</label>
                                  <input id="signupEmail" type="text" class="form-control" name="prezime"/>
                              </div>
                              <div class="form-group">
                                  <label class="control-label" for="signupEmail">Email</label>
                                  <input id="signupEmailagain" type="email" class="form-control" name="email"/>
                              </div>
                              <div class="form-group">
                                  <label class="control-label" for="signupPassword">Password</label>
                                  <input id="signupPassword" type="password" class="form-control" name="password"/>
                              </div>
                              <div class="form-group">
                                  <label for="exampleFormControlFile1">Postavite sliku</label>
                                  <input type="file" class="form-control-file" name="slika">
                              </div>
                              <div class="form-group">
                                  <button id="signupSubmit" type="submit" class="btn btn-primary">Napravite nalog</button>
                              </div>

                          </form>
                      </div>
                  </div>
              </div>
          </div>
    </div>
  </div>
@endsection