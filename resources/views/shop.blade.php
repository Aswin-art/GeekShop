@include('partials.header')

<div class="cart">
  <p>Cart: {{ \Cart::getTotalQuantity() }} items</p>
  @if (session('messageAdd'))
      <div>{{ session('messageAdd') }}</div>
  @endif
  @if (session('messageCheckout'))
    <div>{{ session('messageCheckout') }}</div>
  @endif
</div>

<ul class="recipes">
  @foreach ($produks as $produk)
    <li class="recipe">
      <img src="{{ asset('images/smoothie.png') }}" alt="smoothie recipe icon">
      <h4>{{ $produk->namaProduk }}</h4>
      <p>{{ $produk->hargaProduk }}</p>
      <form action="{{ route('cart.add') }}" method="post">
        @csrf
        <input type="hidden" name="idProduk" value="{{ $produk->id }}">
        <input type="number" name="jumlah" id="jumlah" min="0" value="1">
        <button type="submit">Tambah</button>
      </form>
    </li>
  @endforeach
</ul>

@if (\Cart::getTotalQuantity() > 0)
<a href="{{ route('cart.detail') }}">Checkout</a>
@endif

@include('partials.footer')