@extends('layout.fronttemplate')
@section('title')
    {{ $smestaj->nazivSmestaja }}
@endsection
@section('putanja')
    <div class="row">
        <ol class="breadcrumb adresa">
            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ asset('/category/'.$smestaj->nazivKontinenta) }}">{{ $smestaj->nazivKontinenta }}</a></li>
            <li class="breadcrumb-item"><a href="{{ asset('/category/'.$smestaj->nazivKontinenta.'/'.$smestaj->nazivDrzave)}}">{{ $smestaj->nazivDrzave }}</a></li>
            <li class="breadcrumb-item"><a href="{{ asset('/oblast/'.$smestaj->oblastId)}}">{{ $smestaj->nazivOblasti }}</a></li>
            <li class="breadcrumb-item active  text-white" aria-current="page">{{ $smestaj->nazivSmestaja }}</li>
        </ol>
    </div>
@endsection
@section('glavno')
    <div class="row d-flex justify-content-center">
        <div class="col-md-11 visina bg-light rounded">
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
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Galerija
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach($slike as $slika)
                                        @if($loop->index==0)
                                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="active"></li>
                                        @else
                                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}"></li>
                                        @endif
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach($slike as $slika)
                                        @if($loop->index==0)
                                            <div class="carousel-item active">
                                                <img class="d-block w-100" src="{{ asset($slika->url) }}" alt="{{ $slika->alt }}">
                                            </div>
                                        @else
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="{{ asset($slika->url) }}" alt="{{ $slika->alt }}">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Opis
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            {{ $smestaj->opis }}
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Cenovnik
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <h5>Preuzmite cenovnik:</h5>
                            <a href="{{ asset('/download/'.$smestaj->smestajId) }}" class="btn btn-primary">download</a>
                        </div>
                    </div>
                </div>
                @if(session()->has('user') && session()->get('user')[0]->uloga_id == 2)
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                    Rezervacije
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body">
                                <form method="post" action="{{ asset('/rezervacija/'.$smestaj->smestajId) }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="control-label">Smestaj*</label>
                                        <input id="alt" type="text" class="form-control" name="naziv" value="{{ $smestaj->nazivSmestaja }}" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tip sobe*</label>
                                        <input id="alt" type="text" class="form-control" name="soba"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Datum polaska*</label>
                                        <p><input type="text" id="datepicker" name="datum"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Napomena</label>
                                        <textarea class="form-control" name="napomena"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" rows="8">Rezervisi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

            </div>
        </div>
    </div>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>
    @endsection
