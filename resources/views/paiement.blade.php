@extends('layout.header')

@section('content')

<section id="page-header3">
<img src="{{ asset('images/ccp1.jpeg')}}" alt="">
    <h3 class="title">Paiement </h3>
</section>

<form action="{{ route('validatePaiement', $paiement->id) }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $paiement->id }}">
    <div class="pay">
        <label for="payment_type">Type de paiement :</label>
        <select name="payment_type" id="payment_type">
            <option value="CCP">CCP</option>
            <option value="CIB">CIB</option>
            <option value="CHIFA">CHIFA</option>
        </select>
    </div>
    <div id="ccp" class="section-p1">
        <div class="form-group">
            <label for="card-number">Numéro de carte</label>
            <input type="text" id="card-number" name="card-number" required>
        </div>
        <div class="form-group" id="card-expiry">
            <label for="card-expiry">Date d'expiration</label>
            <input type="text" id="card-expiry" name="card-expiry" placeholder="MM/AA" required>
        </div>

        <div class="form-group" id="card-cvc">
            <label for="card-cvc">Code de sécurité</label>
            <input type="text" id="card-cvc" name="card-cvc" required>
        </div>

        <input type="submit" value="Valider le paiement">
    </div>
</form>

<script>
    const paymentTypeSelect = document.getElementById('payment_type');
    const expirationDateInput = document.getElementById('card-expiry');
    const securityCodeInput = document.getElementById('card-cvc');

    paymentTypeSelect.addEventListener('change', function () {
        const selectedPaymentType = paymentTypeSelect.value;

        if (selectedPaymentType === 'CHIFA') {
            expirationDateInput.style.display = 'none';
            securityCodeInput.style.display = 'none';
        } else {
            expirationDateInput.style.display = 'block';
            securityCodeInput.style.display = 'block';
        }
    });
</script>


@endsection