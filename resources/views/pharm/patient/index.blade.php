@extends('layout.pharm')

@section('pharm')

<body>
<div class="re">

  <main>
  <div class="container">
    <h1>Liste des patients</h1>
    <form>
      <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}"
        placeholder="Rechercher...">
    </form>
    <table>
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Adresse</th>
          <th>Date de naissance</th>
          <th>Téléphone</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="patients-table">
        @foreach($patients as $patient)
        <tr>
          <td class="name">{{ $patient->nom }}</td>
          <td>{{ $patient->prenom }}</td>
          <td>{{ $patient->adresse }}</td>
          <td>{{ $patient->date_de_naissance}}</td>
          <td>{{ $patient->telephone }}</td>
          <td><a href="{{ route('pharm.patient.edit', $patient->id) }}" class="btn btn-primary">Détails</a></td>
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
        $('#patients-table tr').each(function () {
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