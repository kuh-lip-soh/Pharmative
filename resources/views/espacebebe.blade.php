@extends('layout.header')

@section('content')
<section id="page-header">
<img src="{{ asset('images/baby-food.jpg')}}" alt="">
    <h3 class="title">Espace Bébé</h3>
</section>

<section id="product1" class="section-p1">
    <div class="title">
        <h2>Espace Bébé</h2>
    </div>
    @if ($articles->isEmpty())
    <p>Aucun article trouvé.</p>
    @else
    <div class="pro-container">
        @foreach($articles as $article)
        <div class="pro">
            <a href="{{ route('article', $article->id) }}">
                <img src="{{ asset('images/'.$article->image) }}" alt="{{ $article->nom }}">
                <div class="des">
                    <span>{{ $article->nom }}</span>
                    <h5>{{ $article->utilisation }} </h5>
                    <h4>{{ $article->prix }}DA</h4>
                </div>
                <form action="{{ route('ajouter.panier', $article->id) }}" method="POST">
                    @csrf
                    <button type="Test">Ajouter au panier</button>
                </form>
            </a>
        </div>
        @endforeach
    </div>
    <section id="pagination" class="section-p1">
        {{ $articles->links() }}
    </section>
    @endif
</section>

@endsection