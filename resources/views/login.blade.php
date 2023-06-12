@extends('layout.header')

@section('content')
<title>Connexion</title>
  <section id="page-header4">
    <h3 class="title">Connectez-vous</h3>
    
 </section>


  <div id="auth-form" class="section-p1">
    <form id="login-form" action="" method="POST">
      <h2>Se connecter</h2>
      <div class="form-group">
        <label for="email">Adresse e-mail</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <button type="submit" class="btn">Se connecter</button>
      </div>
      <div class="form-group">
        <p>Pas encore de compte ? <a href="{{route('signup')}}">S'inscrire</a></p>
      </div>
    </form>
  </div>
  <div class="overlay" data-overlay></div>
</body>

@endsection