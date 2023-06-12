@extends('layout.header')

@section('content')
<section id="hero">
<img src="{{ asset('images/hero.jpg')}}" alt="">
    <h3 class="title">Bienvenue dans votre <br>&nbsp;
        pharmacie en ligne</h3>

</section>


<section id="product1" class="section-p1">
    <div class="title">
        <h2>Médicaments</h2>
    </div>
    <div class="pro-container">
        @foreach($medicaments as $medicament)
        <div class="pro">
            <a href="{{ route('article', $medicament->id) }}">
                <img src="{{ asset('images/'.$medicament->image) }}" alt="{{ $medicament->nom }}">
                <div class="des">
                    <span>{{ $medicament->nom }}</span>
                    <h5>{{ $medicament->utilisation }} </h5>
                    <h4>{{ $medicament->prix }}DA</h4>
                </div>
                <form action="{{ route('ajouter.panier', $medicament->id) }}" method="POST">
                    @csrf
                    <button type="test">Ajouter au panier</button>
                </form>
            </a>
        </div>
        @endforeach
    </div>
</section>
<section id="product1" class="section-p1">
    <div class="title">
        <h2>Materiels</h2>
    </div>
    <div class="pro-container">
        @foreach($materiels as $materiel)
        <div class="pro">
            <a href="{{ route('article', $materiel->id) }}">
                <img src="{{ asset('images/'.$materiel->image) }}" alt="{{ $materiel->nom }}">
                <div class="des">
                    <span>{{ $materiel->nom }}</span>
                    <h5>{{ $materiel->utilisation }} </h5>
                    <h4>{{ $materiel->prix }}DA</h4>
                </div>
                <form action="{{ route('ajouter.panier', $materiel->id) }}" method="POST">
                    @csrf
                    <button type="Test">Ajouter au panier</button>
                </form>
            </a>
        </div>
        @endforeach
    </div>
</section>
<section id="product1" class="section-p1">
    <div class="title">
        <h2>Espace-Bébé</h2>
    </div>
    <div class="pro-container">
        @foreach($espacesBebe as $espaceBebe)
        <div class="pro">
            <a href="{{ route('article', $espaceBebe->id) }}">
                <img src="{{ asset('images/'.$espaceBebe->image) }}" alt="{{ $espaceBebe->nom }}">
                <div class="des">
                    <span>{{ $espaceBebe->nom }}</span>
                    <h5>{{ $espaceBebe->utilisation }} </h5>
                    <h4>{{ $espaceBebe->prix }}DA</h4>
                </div>
                <form action="{{ route('ajouter.panier', $espaceBebe->id) }}" method="POST">
                    @csrf
                    <button type="Test">Ajouter au panier</button>
                </form>
            </a>
        </div>
        @endforeach
    </div>
</section>


@endsection