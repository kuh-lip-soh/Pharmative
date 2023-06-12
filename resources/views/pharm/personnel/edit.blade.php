@extends('layout.pharm')

@section('pharm')
<section id="page-header">
    <h2 class="title">Modifier les informations du pharmacien</h2>
</section>

<section id="edit-pharmacien" class="section-p1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('pharm.personnel.update', $pharmacien->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                                <div class="col-md-6">
                                    <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror"
                                        name="nom" value="{{ old('nom', $pharmacien->nom) }}" required
                                        autocomplete="nom" autofocus>

                                    @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="prenom" class="col-md-4 col-form-label text-md-right">{{ __('Prénom')
                                    }}</label>

                                <div class="col-md-6">
                                    <input id="prenom" type="text"
                                        class="form-control @error('prenom') is-invalid @enderror" name="prenom"
                                        value="{{ old('prenom', $pharmacien->prenom) }}" required autocomplete="prenom">

                                    @error('prenom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date_de_naissance" class="col-md-4 col-form-label text-md-right">{{ __('Date
                                    de naissance') }}</label>
                                <div class="col-md-6">
                                    <input id="date_de_naissance" type="date"
                                        class="form-control @error('date_de_naissance') is-invalid @enderror"
                                        name="date_de_naissance"
                                        value="{{ old('date_de_naissance', $pharmacien->date_de_naissance) }}" required>

                                    @error('date_de_naissance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="adresse" class="col-md-4 col-form-label text-md-right">{{ __('Adresse')
                                    }}</label>

                                <div class="col-md-6">
                                    <input id="adresse" type="text"
                                        class="form-control @error('adresse') is-invalid @enderror" name="adresse"
                                        value="{{ old('adresse', $pharmacien->adresse) }}" required
                                        autocomplete="adresse">

                                    @error('adresse')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telephone" class="col-md-4 col-form-label text-md-right">{{ __('Téléphone')
                                    }}</label>

                                <div class="col-md-6">
                                    <input id="telephone" type="text"
                                        class="form-control @error('telephone') is-invalid @enderror" name="telephone"
                                        value="{{ old('telephone', $pharmacien->telephone) }}" required
                                        autocomplete="telephone">

                                    @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="profil_patient">Profil Patient</label>
                                <select name="profil_patient" id="profil_patient" class="form-control">
                                    <option value="0">Sélectionner un profil patient</option>
                                    @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ $patient->user_id == $pharmacien->user_id ?
                                        'selected' : '' }}>
                                        {{ $patient->nom }} {{ $patient->prenom }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Enregistrer') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection