<!DOCTYPE html>
<html>

<head>
  <title>Profil pharmacien</title>
  <style>
    /* Style des boutons */
    .button {
      display: block;
      width: 200px;
      height: 50px;
      margin: 10px auto;
      text-align: center;
      line-height: 50px;
      background-color: #4CAF50;
      color: white;
      font-size: 20px;
      text-decoration: none;
      border-radius: 5px;
      box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.3);
    }

    /* Style du titre */
    h1 {
      text-align: center;
      margin-bottom: 26px;
    }

    /* Style du conteneur des boutons */
    .button-container {
      margin: 50px auto;
      width: 300px;
    }
  </style>
</head>

<body>

  <h1>Profil pharmacien</h1>
  <div class="button-container">
    <a href="{{ route('pharm.vente') }}" class="button">Vente</a>
    <a href="{{ route('pharm.vente.historique') }}" class="button">Historique des ventes</a>
    <a href="{{ route('pharm.stock') }}" class="button">Gestion du stock</a>
    <a href="{{ route('pharm.achat') }}" class="button">Achat</a>
    <a href="{{ route('pharm.patient') }}" class="button">Gestion des patients</a>
    <a href="{{ route('pharm.personnel') }}" class="button">Gestion du personnel</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
      @csrf
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        class="button">Se déconnecter</a>
    </form> <i class="ri-user"></i></a></li>
  </div>

</body>

</html>