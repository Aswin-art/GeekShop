@include('partials.header')

<div class="cart">

  @php
      $total = 0
  @endphp

  @if (session('cart'))
      @foreach (session('cart') as $id => $item)
        @php
            $total += $item['jumlah']
        @endphp
      @endforeach
  @endif


  {{-- <p>Cart: {{ \Cart::getTotalQuantity() }} items</p> --}}
  <p>Cart: {{ $total }} items</p>
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
      <form action="{{ route('cart.add', $produk->id) }}" method="post">
        @csrf
        <input type="hidden" name="idProduk" value="{{ $produk->id }}">
        <input type="number" name="jumlah" id="jumlah" min="0" value="1">
        <button type="submit">Tambah</button>
      </form>
    </li>
  @endforeach
</ul>

@if (session('cart'))
<a href="{{ route('cart.detail') }}">Checkout</a>
@endif

@include('partials.footer')