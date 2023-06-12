@extends('layout.header')

@section('content')
<title>Inscription</title>
  <section id="page-header5">
    <h3 class="title">Inscrivez-vous ici </h3>
    
 </section>


  <div id="auth-form" class="section-p1">
  <form id="register-form" action="" method="POST">
    <h2>S'inscrire</h2>
    <div class="form-group">
      <label for="name">Nom</label>
      <input type="text" id="name" name="name" required>
    </div>
    <div class="form-group">
      <label for="email">Adresse e-mail</label>
      <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="password">Mot de passe</label>
      <input type="password" id="password" name="password" required>
    </div>
    <div class="form-group">
      <label for="confirm-password">Confirmer le mot de passe</label>
      <input type="password" id="confirm-password" name="confirm-password" required>
    </div>
    <div class="form-group">
      <label for="address">Adresse</label>
      <input type="text" id="address" name="address" required>
    </div>
    <div class="form-group">
      <label for="phone">Numéro de téléphone</label>
      <input type="tel" id="phone" name="phone" required>
    </div>
    <div class="form-group">
      <button type="submit" class="btn">S'inscrire</button>
    </div>
    <div class="form-group">
      <p>Déjà un compte ? <a href="{{route('login')}}">Se connecter</a></p>
    </div>
  </form>
  </div>
</div>
<div class="overlay" data-overlay></div>
</body>

@endsection