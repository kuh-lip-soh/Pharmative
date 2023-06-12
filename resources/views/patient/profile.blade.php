@extends('layout.header')

@section('content')
<section id="page-header6">
  
<img src="{{ asset('images/ivaoes_partners.jpg')}}" alt="">
  <h3 class="title">Votre Profil</h3>



</section>
<section class="container3" class="section-p1">
  <div id="form" class="section-p1">
    <div class="profile">
      <h2>Informations personnelles</h2>
      <br />
      <p>Nom : <span id="nom">{{ Auth::user()->patient->nom }}</span></p>
      <p>Prénom : <span id="nom">{{ Auth::user()->patient->prenom }}</span></p>
      <p>Email : <span id="email">{{ Auth::user()->email }}</span></p>
      <p>Date de naissances : <span id="date_de_naissance">{{ Auth::user()->patient->date_de_naissance }}</span></p>
      <p>Taille : <span id="taille">{{ Auth::user()->patient->taille }}</span></p>
      <p>Poids : <span id="poids">{{ Auth::user()->patient->poids }}</span></p>
      <p>Adresse : <span id="adresse">{{ Auth::user()->patient->adresse }}</span></p>
      <p>Telephone : <span id="telephone">{{ Auth::user()->patient->telephone }}</span></p>
      <button id="editButton" onclick="openPopup()">Modifier</button>
    </div>
 </div>
</section>
<section class="re" class="section-p1">
  <div id="popup" class="popup">
      <form action="{{ route('patient.profile.update') }}" method="POST">
        @csrf
        <input type="text" id="nom" name="nom" value="{{ Auth::user()->patient->nom }}">
        <input type="text" id="prenom" name="prenom" value="{{ Auth::user()->patient->prenom }}">
        <input type="text" id="email" name="email" value="{{ Auth::user()->email }}">
        <input type="text" id="dateNaissance" name="dateNaissance"
          value="{{ Auth::user()->patient->date_de_naissance }}">
        <input type="text" id="taille" name="taille" value="{{ Auth::user()->patient->taille }}">
        <input type="text" id="poids" name="poids" value="{{ Auth::user()->patient->poids }}">
        <input type="text" id="adresse" name="adresse" value="{{ Auth::user()->patient->adresse }}">
        <input type="text" id="telephone" name="telephone" value="{{ Auth::user()->patient->telephone }}">
        <button type="test">Enregistrer</button>
      </form>
    </div>
</section>
<section id="cart" class="section-p1">
  @if ($ventes->isEmpty())
  <p>Aucune commande effectué.</p>
  @else
  <h3 class="title">Mes commandes</h3>
  <table width=100%>
    <thead>
      <tr>
        <td>N°</td>
        <td>Nombre de produits</td>
        <td>Montant</td>
        <td>Type de paiement</td>
        <td>Etat de livraison</td>
        <td>Date</td>
        <td />
      </tr>
    </thead>
    <tbody>
      @foreach ($ventes as $vente)
      <tr>
        <td>{{ $vente->id }}</td>
        <td>{{ $vente->articles->count() }}</td>
        <td>{{ $vente->montant }} DA</td>
        <td>
          @if ($vente->paiement)
          {{ $vente->paiement->type }}
          @else
          Aucun paiement
          @endif
        </td>
        <td>
          @if ($vente->livraison)
          {{ $vente->livraison->etat }}
          @else
          Aucune livraison
          @endif
        </td>
        <td>{{ $vente->created_at }}</td>
        <td><a href="{{ route('patient.profile.commande', $vente->id) }}"><button class="details-btn">Détails
            </button></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endif
</section>

<script>
  function openPopup() {
    var popup = document.getElementById("popup");
    popup.classList.add("show");
  }
</script>


@endsection