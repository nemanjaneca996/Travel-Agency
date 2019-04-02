<div class="row d-flex justify-content-center">
    @foreach($smestaji as $smestaj)
        <div class="smestaj">
            <img class="levo smestaj-slika" src="{{ asset($smestaj->url) }}" alt="{{ $smestaj->alt }}">
            <div class="card-body pomoc">
                <h3>{{ $smestaj->nazivSmestaja }}</h3>
                <h5>{{ $smestaj->nazivOblasti }}, {{ $smestaj->nazivDrzave }} </h5>
                <br/>
                <a href="{{ asset('/smestaj/'.$smestaj->smestajId) }}" class="btn btn-primary">Prikazi</a>
            </div>
        </div>
    @endforeach
</div>
