@extends('layout.header')

@section('content')
<title>Connexion</title>
<section id="page-header8">
<img src="{{ asset('images/original1.jpeg')}}" alt="">
  <h3 class="title">Connectez-vous</h3>

</section>


<div id="auth-form" class="section-p1">
  <form method="POST" action="{{ route('patient.login.submit') }}">
    @csrf

    <div class="form-group">
      <label for="email">Adresse e-mail</label>
      <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
      @error('email')
      <span>{{ $message }}</span>
      @enderror
    </div>

    <div class="form-group">
      <label for="password">Mot de passe</label>
      <input type="password" name="password" id="password" required>
      @error('password')
      <span>{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <button type="Test" class="btn">Se connecter</button>
    </div>
  </form>
  <div class="form-group">
    <p>Pas encore de compte ? <a href="{{route('patient.signup')}}">S'inscrire</a></p>
  </div>
</div>
<div class="overlay" data-overlay></div>
</body>

@endsection