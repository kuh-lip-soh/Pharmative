@extends('layout.pharm')

@section('pharm')
<body>
 
    <main>
      <h2>Liste des pharmaciens</h2>
      <form>
      <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="Rechercher...">
      </form>
      <table>
        <thead>
            <tr>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Adresse email</th>
              <th>Téléphone</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="pharmaciens-table">
          @foreach($pharmaciens as $pharm)
            <tr>
              <td class="name">{{ $pharm->nom }}</td>
              <td>{{ $pharm->prenom }}</td>
              <td>{{ $pharm->adresse }}</td>
              <td>{{ $pharm->telephone }}</td>
              <td><a href="#">Voir</a> <a href="#">Modifier</a></td>
            </tr>
          @endforeach
            </tbody>
          </table>
        </main>

<script>
    $(document).ready(function() {
        $('#search').on('input', function() {
            var searchText = $(this).val().toLowerCase();
            $('#pharmaciens-table tr').each(function() {
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
