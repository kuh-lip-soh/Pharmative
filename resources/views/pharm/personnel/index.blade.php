@extends('layout.pharm')

@section('pharm')

<body>
<div class="re">

   <main>
   <div class="container">
    <h1>Liste des pharmaciens</h1>
    <form>
      <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}"
        placeholder="Rechercher...">
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
          <td><a href="{{ route('pharm.personnel.edit', $pharm->id) }}" class="btn btn-primary">Modifier</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <a href="{{ route('pharm.dashboard') }}">
        <button class="back-button">Retour</button>
        </a>
</div>
   </main>
  
</div>
  <script>
    $(document).ready(function () {
      $('#search').on('input', function () {
        var searchText = $(this).val().toLowerCase();
        $('#pharmaciens-table tr').each(function () {
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