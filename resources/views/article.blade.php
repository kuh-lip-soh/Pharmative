@extends('layout.header')

@section('content')
<section id="prodetails" class="section-p1">
    <div class="single-pro-image">
        <img src="{{ asset('images/'.$article->image) }}" width="100%" id="MainImg" alt="{{ $article->nom }}">
    </div>
    <div class="single-pro-details">
        <h5>Accue / {{ $article->type }}</h5>
        <h3> {{ $article->nom }} </h3>
        @if($article->forme)
        <h6>{{ $article->forme }}</h6>
        @endif
        @if($article->age)
            <p><strong>Pour qui : </strong> {{ $article->age }}</p>
        @endif
        @if($article->enceinte)
            <p><strong>Femme enceinte : </strong> {{ $article->enceinte }}</p>
        @endif
        @if($article->allaitement)
            <p><strong>Allaitement : </strong> {{ $article->allaitement }}</p>
        @endif
        <h2> {{ $article->prix }} DA</h2>
        <form action="{{ route('ajouter.panier', $article->id) }}" method="POST">
            @csrf
            <input type="number" name="quantite" value="1" min="1">
            <button type="Text">Ajouter au panier <i class="ri-shopping-cart-2-line cart"></i></button>
        </form>
        <h3>Détails du produit :</h3>
        <span>{{ $article->description }}</span>
    </div>
</section>

@if($article->notice)
<section>
    <div class="">
    
            <h3><strong>Notice d'utilisation : </strong></h3>
            <p>{{ $article->notice }}</p>
        
    </div>
</section>
@endif

@endsection