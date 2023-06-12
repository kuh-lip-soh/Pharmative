@extends('layout.pharm')

@section('pharm')

<body>

<main>
    <div class="container">
    <div class="re">
    <h1>Achat</h1>
        <form>
            <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}"
                placeholder="Rechercher...">
        </form>

        <form action="{{ route('pharm.achat.create') }}" method="POST">
            @csrf
            <button type="submit">Créer un nouvel achat</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Fournisseur</th>
                    <th>Montant</th>
                    <th>Détails</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody id="achats">
                @foreach ($achats as $achat)
                <tr>
                    <td>{{ $achat->created_at }}</td>
                    <td class="name">{{ $achat->fournisseur }}</td>
                    <td>{{ $achat->montant }}</td>
                    <td>
                        <a href="{{ route('pharm.achat.edit', $achat->id) }}" class="btn btn-primary btn-sm">Détails</a></td>
                        <td><form action="{{ route('pharm.achat.destroy', $achat->id) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="test" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('pharm.dashboard') }}">
        <button class="back-button">Retour</button>
        </a>
</div>
    </main>

    <script>
        $(document).ready(function () {
            $('#search').on('input', function () {
                var searchText = $(this).val().toLowerCase();
                $('#achats tr').each(function () {
                    var name = $(this).find('.name').text().toLowerCase();
                    if (name.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
    @endsection