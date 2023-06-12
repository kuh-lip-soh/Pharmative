@extends('layout.pharm')

@section('pharm')

<body>
<div class="re">
    
    <main>
    <div class="container">
    <a href="{{ route('pharm.dashboard') }}">
        <button class="back-button" >Retour</button>
    </a>
        <h1>Gestion de Stock</h1>
        <form>
            <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}"
                placeholder="Rechercher...">
        </form>
        <form>
            
            <div class="form-group">
                <label for="utilisation">Filtrer par utilisation :</label>
                <select name="utilisation" id="utilisation" class="form-control">
                    <option value="">Tout afficher</option>
                    @foreach($utilisations as $utilisation)
                    <option value="{{ $utilisation }}">{{ $utilisation }}</option>
                    @endforeach
                </select>
            </div>
        
        </form>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Date de péremption</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Utilisation</th>
                    <th />
                </tr>
            </thead>
            <tbody id="articles">
                @foreach($articles as $article)
                <tr>
                    <td class="nom">{{ $article->nom }}</td>
                    <td>{{ $article->date_de_peremption }}</td>
                    <td>{{ $article->prix }}</td>
                    <td>{{ $article->stock }}
                        @if($article->stock < $article->stock_min)
                            <i class="ri-alert-fill"></i>
                            @endif
                    </td>
                    <td class="utilisation">{{ $article->utilisation }}</td>
                    <td>
                        <a href="{{ route('pharm.stock.show', $article->id) }}" class="btn btn-primary">Détails</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
    </main>
</div>

    <script>
        $(document).ready(function () {
            $('#search').on('input', function () {
                var searchText = $(this).val().toLowerCase();
                $('#articles tr').each(function () {
                    var name = $(this).find('.nom').text().toLowerCase();
                    if (name.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#utilisation').on('change', function () {
                var selectedUtilisation = $(this).val();
                $('#articles tr').each(function () {
                    var utilisation = $(this).find('.utilisation').text();
                    if (selectedUtilisation === '' || utilisation === selectedUtilisation) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>


    @endsection