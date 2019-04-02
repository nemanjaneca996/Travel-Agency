<h5>Rrezultati</h5>
<ul>
    @foreach($odgovori as $odg)
        <li><p>{{ $odg->odgovor }}:{{ $odg->vrednost }}</p></li>
    @endforeach
</ul>
