@extends('layout.pharm')

@section('pharm')
<script>
    $(function () {
        $("#patient-search").keyup(function () {
            var searchTerm = $(this).val();
            if (searchTerm.length >= 1) {
                $.ajax({
                    url: "{{ route('pharm.vente.searchPatient') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        search: searchTerm
                    },
                    success: function (data) {
                        $("#patient-options").empty();
                        $.each(data, function (index, patient) {
                            var optionText = patient.nom + ' ' + patient.prenom + ' - ' + patient.date_de_naissance;
                            var option = $("<option>").val(patient.id).text(optionText);
                            $("#patient-options").append(option);
                        });
                    }
                });
            }
        });
    });
</script>
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


<div class="containerv">
    <a href="{{ route('pharm.dashboard') }}">
        <button class="back-button">Retour</button>
    </a>
    <h1>Vente</h1>
    <div class="search">
        <form action="{{ route('pharm.vente.add') }}" method="POST">
            @csrf
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
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
                <th />
            </tr>
        </thead>
        <tbody>
            @forelse($tableRows as $row)
            <tr>
                <td>{{ $row['name'] }}</td>
                <td>{{ $row['quantity'] }}</td>
                <td>{{ $row['price'] }}</td>
                <td>{{ $row['total'] }}</td>
                <td>
                    <form action="{{ route('pharm.vente.remove', $row['key']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="text" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Aucun article.</td>
            </tr>
            @endforelse
        <tfoot>
            <tr>
                <td colspan="3" class="total">Total :</td>
                <td class="total-price">{{ $totalPrice }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    <form action="{{ route('pharm.vente.cancel') }}" method="POST">
        @csrf
        <button type="submit" class="cancel">Annuler</button>
    </form>
    <div class="search">
        <form action="{{ route('pharm.vente.validate') }}" method="POST">
            @csrf
            <!-- Autres champs du formulaire, y compris la sélection du patient -->
            <label for="patient-search">Rechercher un patient</label>
            <input type="text" id="patient-search" name="patient-search" placeholder="Nom du patient">
            <select id="patient-options" name="patient-options">
                <option value="">Sélectionner un patient</option>
                <!-- Options des patients seront ajoutées ici -->
            </select>
    </div>
    <button type="submit">Valider la vente</button>
    </form>

</div>

@endsection