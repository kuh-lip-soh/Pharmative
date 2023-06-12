@extends('layout.header')

@section('content')
<title>Inscription</title>
<section id="page-header5">
<img src="{{ asset('images/pp.jpg')}}" alt="">
  <h3 class="title">Inscrivez-vous ici </h3>

</section>

<div class="container6">
 <div id="auth-form" class="section-p1">
  <form method="POST" action="{{ route('patient.signup.submit') }}">
    @csrf
    <h2>S'inscrire</h2>
    <div class="form-group">
      <label for="nom">Nom</label>
      <input type="Text" id="nom" name="nom" alue="{{ old('nom') }}" required autofocus>
      @error('nom')
      <span>{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <label for="prenom">Prénom</label>
      <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
      @error('prenom')
      <span>{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <label for="email">Adresse e-mail</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required>
      @error('email')
      <span>{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <label for="password">Mot de passe</label>
      <input type="password" id="password" name="password" required>
      @error('password')
      <span>{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <label for="date_de_naissance">Date de naissance</label>
      <input type="date" id="date_de_naissance" name="date_de_naissance" value="{{ old('date_de_naissance') }}"
        required>
      @error('date_de_naissance')
      <span>{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <label for="address">Adresse</label>
      <input type="text" id="adresse" name="adresse" rvalue="{{ old('adresse') }}" required>
      @error('adresse')
      <span>{{ $message }}</span>
      @enderror
      <div class="form-group">
        <label for="phone">Numéro de téléphone</label>
        <input type="text" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
        @error('telephone')
        <span>{{ $message }}</span>
        @enderror
      </div>
      <div class="form-group">
        <button type="text" class="btn">S'inscrire</button>
      </div>
  </form>
  <div class="form-group">
    <p>Déjà un compte ? <a href="{{route('patient.login')}}">Se connecter</a></p>
  </div>
   </div>
</div>

<div class="overlay" data-overlay></div>
</body>

@endsection