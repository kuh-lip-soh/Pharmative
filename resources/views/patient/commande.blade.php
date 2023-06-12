@extends('layout.header')

@section('content')

<h2>Détails de la commande : {{ $vente->id }}</h2>

<section id="cart" class="section-p1">
    <h3 class="title">Articles</h3>
    <table width=100%>
        <thead>
            <tr>
                <td>Image</td>
                <td>Article</td>
                <td>Quantité</td>
                <td>Prix unitaire</td>
                <td>Total</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($vente->articles as $article)
            <tr>
                <td><img src="{{ asset('images/'.$article->image) }}" /></td>
                <td>{{ $article->nom }}</td>
                <td>{{ $article->pivot->quantite}}</td>
                <td>{{ $article->prix }}</td>
                <td>{{ $article->prix * $article->pivot->quantite }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <section id="cart-add" class="section-p1">
    <div id="subtotal">
    <table>
    <tr>
    <td>Type de paiement : 
            @if ($vente->paiement)
            {{ $vente->paiement->type }}
            @else
            Aucun paiement
            @endif
            </td>
     </tr> 
     <tr>
     <td>État de la livraison : 
     @if ($vente->livraison)
            {{ $vente->livraison->etat }}
            @else
            Aucune livraison prévue
            @endif
            </td>
            </tr>
            <tr>
            <td>Date : {{ $vente->created_at }}</td>
            </tr> 
            </table>
            </div>
    </section>
    <section id="cart-add" class="section-p1">
    <div id="subtotal">
    <table>
    <tr>
            <td>Total</td>
            <td>
                {{ $vente->montant }}
            </td>
            </tr>
            </table>
            </div>
            
</section>


@endsection