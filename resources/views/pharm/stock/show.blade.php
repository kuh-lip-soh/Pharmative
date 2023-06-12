@extends('layout.pharm')

@section('pharm')

<body> 

<section id="prodetails" class="section-p1">
    
        <main>
            <div class="container">
           <h1>Détails de l'article</h1>

            <div class="single-pro-image">
              <img src="{{ asset('images/'.$article->image) }}" width="100%" id="MainImg" alt="{{ $article->nom }}">
            </div>
            <div class="single-pro-details">
                <p><b>{{ $article->nom }}</b></p>
                <p>Utilisation : {{ $article->utilisation }}</p>
                <p>Date de péremption : {{ $article->date_de_peremption }}</p>
                <p>Prix : {{ $article->prix }}</p>
                <p>Stock : {{ $article->stock }}
                    @if($article->stock < $article->stock_min)
                        <i class="ri-alert-fill"></i>
                        @endif</p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>Description</h2>
                    <p>{{ $article->description }}</p>
                </div>
            </div>
            </section>
</div>
    </main>
    </section>
 
    </body>
    @endsection
    