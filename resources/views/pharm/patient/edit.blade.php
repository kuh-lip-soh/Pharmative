@extends('layout.pharm')

@section('pharm')
<section id="page-header">
    <h2 class="title">Modifier les informations du patient</h2>
</section>

<section id="edit-patient" class="section-p1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('pharm.patient.update', $patient->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                                <div class="col-md-6">
                                    <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror"
                                        name="nom" value="{{ old('nom', $patient->nom) }}" required autocomplete="nom"
                                        autofocus>

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
                                        value="{{ old('prenom', $patient->prenom) }}" required autocomplete="prenom">

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
                                        value="{{ old('date_de_naissance', $patient->date_de_naissance) }}" required>

                                    @error('date_de_naissance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="poids" class="col-md-4 col-form-label text-md-right">{{ __('Poids')
                                    }}</label>
                                <div class="col-md-6">
                                    <input id="poids" type="number" step="0.01"
                                        class="form-control @error('poids') is-invalid @enderror" name="poids"
                                        value="{{ old('poids', $patient->poids) }}" required>

                                    @error('poids')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="taille" class="col-md-4 col-form-label text-md-right">{{ __('Taille')
                                    }}</label>
                                <div class="col-md-6">
                                    <input id="taille" type="number" step="0.01"
                                        class="form-control @error('taille') is-invalid @enderror" name="taille"
                                        value="{{ old('taille', $patient->taille) }}" required>

                                    @error('taille')
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
                                        value="{{ old('adresse', $patient->adresse) }}" required autocomplete="adresse">

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
                                        value="{{ old('telephone', $patient->telephone) }}" required
                                        autocomplete="telephone">

                                    @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
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