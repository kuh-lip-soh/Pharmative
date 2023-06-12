@extends('layout.pharm')

@section('pharm')

<body>
<div class="container">
    <main>
        <h1>Détails de la vente N° {{ $vente->id }}</h1>

        <h2>Patient</h2>
        <h2><strong>{{ $vente->nom }} {{ $vente->prenom }}</strong></h2>

        <h2>Articles</h2>
        <table>
            <thead>
                <tr>
                    <th>Article</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vente->articles as $article)
                <tr>
                    <td>{{ $article->nom }}</td>
                    <td>{{ $article->pivot->quantite}}</td>
                    <td>{{ $article->prix }}</td>
                    <td>{{ $article->prix * $article->pivot->quantite }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table>
            <tr>
            <td><h2>Total</h2></td>
            <td>
            <h2><strong>{{ $vente->montant }}</strong></h2>
            </td>
        </tr>
            </table>

        <form action="{{ route('pharm.vente.destroy', $vente) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Supprimer la vente</button>
        </form>
     
   

    <table>
    <tr>
        @if($vente->paiement)
        <tr>
        <td> <h3>Informations de paiement</h3></td>
        </tr>
        <tr>
        <td> <strong>Type de paiement : {{ $vente->paiement->type }}</strong></td>
        @endif
        </tr>
        </table>
        <table>
    <tr>  
        @if($vente->livraison)
        <td> <h3>Informations de livraison</h3></td>
        </tr>
        <tr>
        <td> <strong>Adresse : {{ $vente->livraison->adresse }}</strong></td>
    </tr>
        </table>
       <div class="adr">
        <form action="{{ route('pharm.vente.updateLivraison', $vente->livraison->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="adresse">Nouvelle adresse :</label>
            <textarea name="adresse" id="adresse" rows="4" cols="25" required></textarea>
            <input type="submit" value="Modifier">
        </form>
        @endif
        </div>
        <a href="{{ route('pharm.vente.historique') }}">Retour à l'historique des ventes</a>
    </main>
    </div>
    @endsection