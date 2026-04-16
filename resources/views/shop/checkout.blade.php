@extends('meubleo::layouts.shop')
@section('title', 'Commander — ' . config('meubleo.shop_name'))
@push('styles')
<script src="https://js.stripe.com/v3/"></script>
@endpush

@section('content')
<div class="container" style="padding:2.5rem 1.5rem 5rem">
    <h1 class="shop-page-title">Finaliser ma commande</h1>
    <div class="shop-checkout-grid">
        <div class="shop-checkout-form">
            <h2>Livraison</h2>
            <form id="checkout-form" action="{{ route('meubleo.checkout.process') }}" method="POST">
                @csrf
                <input type="hidden" name="payment_id" id="payment-id">
                <div class="shop-form-grid-2">
                    <div class="shop-form-group">
                        <label>Nom complet *</label>
                        <input type="text" name="name" class="shop-input" value="{{ $user->name }}" required>
                    </div>
                    <div class="shop-form-group">
                        <label>Téléphone</label>
                        <input type="tel" name="phone" class="shop-input">
                    </div>
                </div>
                <div class="shop-form-group">
                    <label>Adresse *</label>
                    <input type="text" name="address" class="shop-input" required>
                </div>
                <div class="shop-form-grid-2">
                    <div class="shop-form-group">
                        <label>Code postal *</label>
                        <input type="text" name="postal_code" class="shop-input" required>
                    </div>
                    <div class="shop-form-group">
                        <label>Ville *</label>
                        <input type="text" name="city" class="shop-input" required>
                    </div>
                </div>
                <div class="shop-form-group">
                    <label>Notes</label>
                    <textarea name="notes" class="shop-input" rows="2" placeholder="Digicode, étage…"></textarea>
                </div>
                <h2 style="margin-top:2rem">Paiement</h2>
                <div id="card-element" class="shop-stripe-element"></div>
                <div id="card-errors" style="color:#B85450;font-size:.85rem;margin-top:.5rem"></div>
                <button type="submit" id="submit-btn"
                        class="btn-shop btn-shop--primary btn-shop--full btn-shop--lg" style="margin-top:1.5rem">
                    Payer {{ meubleo_price($total) }}
                </button>
            </form>
        </div>

        <div class="shop-checkout-summary">
            <h2>Ma commande</h2>
            @foreach($items as $item)
            <div class="shop-summary-line">
                <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                <span>{{ meubleo_price($item->product->current_price * $item->quantity) }}</span>
            </div>
            @endforeach
            <hr>
            <div class="shop-summary-line"><span>Sous-total</span><span>{{ meubleo_price($subtotal) }}</span></div>
            <div class="shop-summary-line"><span>Livraison</span><span>{{ $shipping > 0 ? meubleo_price($shipping) : 'Offerte' }}</span></div>
            <div class="shop-summary-line shop-summary-line--total"><span>Total</span><span>{{ meubleo_price($total) }}</span></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
const stripe = Stripe('{{ config("meubleo.stripe.key") }}');
const elements = stripe.elements();
const card = elements.create('card', {
    style: { base: { fontFamily: 'DM Sans, sans-serif', fontSize: '16px' } }
});
card.mount('#card-element');
card.on('change', ({error}) => {
    document.getElementById('card-errors').textContent = error ? error.message : '';
});
document.getElementById('checkout-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    const btn = document.getElementById('submit-btn');
    btn.disabled = true; btn.textContent = 'Traitement…';
    const {paymentMethod, error} = await stripe.createPaymentMethod({type:'card', card});
    if (error) {
        document.getElementById('card-errors').textContent = error.message;
        btn.disabled = false; btn.textContent = 'Réessayer';
    } else {
        document.getElementById('payment-id').value = paymentMethod.id;
        e.target.submit();
    }
});
</script>
@endpush
@endsection
