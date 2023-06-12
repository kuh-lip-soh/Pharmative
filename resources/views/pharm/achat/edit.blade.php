@extends('layout.pharm')

@section('pharm')
<script>
    $(function () {
        $("#product-search").keyup(function () {
            var searchTerm = $(this).val();
            if (searchTerm.length >= 2) {
                $.ajax({
                    url: "{{ route('pharm.vente.searchArticle') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        search: searchTerm
                    },
                    success: function (data) {
                        $("#product-options").empty();
                        $.each(data, function (index, product) {
                            var option = $("<option>").val(product.id).text(product.nom);
                            $("#product-options").append(option);
                        });
                    }
                });
            }
        });
    });
</script>

<body>
<div class="container">
<button class="back-button" onclick="goBack()">Retour</button>
    <main>
        <h1>Détails de l'achat N° {{ $achat->id }}</h1>
        <div class="search">
            <form action="{{ route('pharm.achat.add', $achat->id) }}" method="POST">
                @csrf
                <label>Fournisseur</label>
                <input type="text" id="fournisseur" name="fournisseur" value="{{ $achat->fournisseur }}">
                <h2>Articles</h2>
                <label for="product-search">Rechercher un produit</label>
                <input type="text" id="product-search" name="product-search" placeholder="Nom du produit">
                <select id="product-options" name="product-options">
                    <option value="">Sélectionner un produit</option>

                </select>
                <br />
                <input type="number" id="product-quantity" name="product-quantity" placeholder="Quantité">
                <button type="submit">Ajouter</button>
            </form>
        </div>

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
                @foreach ($achat->articles as $article)
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
            <h2><strong>{{ $achat->montant }}</strong></h2>
            </td>
        </tr>
            </table>
        
       

        <form action="{{ route('pharm.achat.destroy', $achat) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Supprimer l'achat</button>
        </form>

        <a href="{{ route('pharm.achat') }}">Retour aux achats</a>
    </main>
</div>
</section>
    @endsection