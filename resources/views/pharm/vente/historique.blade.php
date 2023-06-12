@extends('layout.pharm')

@section('pharm')

<body>

    <main>
    <div class="container">
        <div class="re">
        <h1>Histoque des Ventes</h1>
        <form>
            <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}"
                placeholder="Rechercher...">
        </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Patient</th>
                    <th>Montant</th>
                    <th>Etat</th>
                    <th>Détails</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody id="patients">
                @foreach ($ventes as $vente)
                <tr>
                    <td>{{ $vente->created_at }}</td>
                    <td class="name">{{ $vente->nom }} {{ $vente->prenom }}</td>
                    <td>{{ $vente->montant }}</td>
                    <td>{{ $vente->etat }}</td>
                    <td><a href="{{ route('pharm.vente.edit', $vente->id) }}" class="btn btn-primary btn-sm">Détails</a>
                        </td>
                        <td>
                        <form action="{{ route('pharm.vente.destroy', $vente->id) }}" method="POST"
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
        <button class="back-button" onclick="goBack()">Retour</button>
        </a>
</div>
    </main>

    <script>
        $(document).ready(function () {
            $('#search').on('input', function () {
                var searchText = $(this).val().toLowerCase();
                $('#patients tr').each(function () {
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