@extends('layout.pharm')

@section('pharm')

<body>

    <div class="container1">
        <h1>Pharmative</h1>
        <h2>Portail de connexion</h2>
        
        <form method="POST" action="{{ route('pharm.login.submit') }}">
            @csrf
            <div class="form-group1">
                <label for="email">Adresse e-mail</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                <span>{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group1">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                <span>{{ $message }}</span>
                @enderror
            </div>
            <button type="Test">Se Connecter</button>
        </form>
    </div>


</body>

</html>

@endsection