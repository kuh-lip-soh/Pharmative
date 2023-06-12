@extends('layout.header')

@section('content')

<section id="page-header2">
<img src="{{ asset('images/cart.png')}}" alt="">
    <h3 class="title">Votre panier </h3>
</section>

<section id="cart" class="section-p1">
    @if ($panier)
    <table width="100%">
        <thead>
            <tr>
                <td>Image</td>
                <td>Article</td>
                <td>Prix</td>
                <td>Quantité</td>
                <td>Total</td>
                <td>Retirer</td>
            </tr>
        </thead>
        <tbody>
            @php
            $totalPrice = 0;
            @endphp
            @foreach ($panier as $article)
            <tr>
                <td><img src="{{ asset('images/'.$article['image']) }}" /></td>
                <td>{{ $article['nom'] }}</td>
                <td>{{ $article['prix'] }} DA</td>
                <td>{{ $article['quantite'] }}</td>
                <td>{{ $article['total'] }} DA</td>
                <td>
                    <form action="{{ route('supprimer.panier', $article['id']) }}" method="POST">
                        @csrf
                        <button type="test">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        
        </tbody>
    </table>
    <section id="cart-add" class="section-p1">
        <div id="subtotal">
            <h3>Totaux du panier </h3>
            <table>
            <tr>
                <td colspan="4">Total</td>
                <td>{{ $total }} DA</td>
                
            </tr>
            <tr>
                <td colspan="4">Livraison</td>
                <td> Gratuite </td>
                
            </tr>
            </table>
            <form action="{{ route('valider.panier') }}" method="POST">
        @csrf
        <button type="submit">Valider l'achat</button>
    </form>
            </div>
       </section>
  
    @else
    <p><strong>Votre panier est vide.</strong></p>
    @endif


    @endsection