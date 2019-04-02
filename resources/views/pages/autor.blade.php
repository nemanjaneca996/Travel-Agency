@extends('layout.fronttemplate')
@section('title')
    Autor
@endsection
@section('putanja')
    <div class="row">
        <ol class="breadcrumb adresa">
            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
            <li class="breadcrumb-item active  text-white" aria-current="page">Autor</li>
        </ol>
    </div>
@endsection
@section('glavno')
    <div class="row d-flex justify-content-center">
        <div class="col-md-11 visina bg-light rounded">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('/slike/me.jpg') }}" alt="me" width=100%"/>
                </div>
                <div class="col-md-6">
                    Moje ime je Nemanja Pravdić. Rođen sam 25. Septembra 1996 godine. Zavrsio sam srednju elektrotehničku skolu Nikola Tesla.<br/>
                    Trenutno sam student Visoke ICT škole na smeru Internet Tehnologije, na zavrsnoj godini.<br/>
                    Tri godine se bavim Web-om. Do sada sam napravio pet sajta, a ovo je sesti.<br/>
                    Jezici sa kojima se trenutno bavim su HTML(5), CSS(3), XML, JavaScript, mySQL i PHP(Laravel).

                    <div class="anketa">
                        <br/>
                        <h3>Anketa:</h3>
                        <h4>{{ $anketa[0]->naziv }}</h4>
                        <div id="odgovori">
                            @if(session()->has('user') && $user->glasanje!=$anketa[0]->pitanjeId)
                            <ul>
                                @foreach($anketa as $a)
                                    <li><h5><input type="radio" name="anketa" class="anketa" value="{{ $a->odgovorId }}" onclick="anketa({{ $a->odgovorId }})"/>{{ $a->odgovor }}</h5></li>
                                @endforeach
                            </ul>
                                @else
                                <h5>Rrezultati</h5>
                                <ul>
                                    @foreach($anketa as $odg)
                                        <li><p>{{ $odg->odgovor }}:{{ $odg->vrednost }}</p></li>
                                    @endforeach
                                </ul>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const url="{{ asset('/') }}";
    </script>
    <script src="{{ asset('/js/ajax.js') }}"></script>
@endsection