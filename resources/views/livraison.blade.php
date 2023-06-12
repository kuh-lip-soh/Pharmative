@extends('layout.header')

@section('content')

<section id="page-header4">
<img src="{{ asset('images/livraison.jpg')}}" alt="">
    <h3 class="title">Livraison </h3>
</section>

<form action="{{ route('validateLivraison', ['id' => $livraison->id]) }}" method="POST">
    @csrf
    <div class="liv">
        <label for="adresse">Adresse de livraison :</label>
        <textarea name="adresse" id="adresse" rows="4" cols="25" required></textarea>
    </div>
    <div class="live">
        <input type="submit" value="Valider la livraison">
    </div>
</form>

@endsection