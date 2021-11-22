@include('partials.header')

<div class="mesasage">
    @if (session('messageClear'))
        <div>{{ session('messageClear') }}</div>
    @endif
    @if (session('messageUpdate'))
        <div>{{ session('messageUpdate') }}</div>
    @endif
</div>

<div class="list-item">
    <ul>
        <form action="{{ route('cart.checkout') }}" method="post">
            @csrf
            @foreach ($items as $item)
                @if ($item->quantity > 0)
                    id:
                    <input type="text" name="id" value="{{ $item->id }}" readonly>
                    nama:
                    <input type="text" name="name" value="{{ $item->name }}" readonly>
                    harga:
                    <input type="text" name="price" value="{{ $item->price }}" readonly>
                    jumlah:
                    <input type="text" name="quantity" value="{{ $item->quantity }}" readonly>
                @endif
            @endforeach

            @if (\Cart::getTotalQuantity())
                <div class="bagian-kurir" style="margin-top: 40px;">
                    <p>Pilih kurir</p>
                    <select name="kurir" id="kurir">
                        @foreach ($kurirs as $kurir)
                        <option value="{{ $kurir->id }}">{{ $kurir->namaPaket }}: {{ $kurir->hargaPaket }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="totalOrder" value="{{ \Cart::getContent() }}">
                <input type="hidden" name="totalHarga" value="{{ \Cart::getTotal() }}">

                <button type="submit">Checkout</button>
            @endif
        </form> 
    </ul>

    @if (\Cart::getTotalQuantity())
        <a href="{{ route('cart.clear') }}">Bersihkan Keranjang</a>        
    @endif

    @if (\Cart::getTotalQuantity() == 0)
        <p>Keranjang belanja anda kosong</p>
        <a href="{{ route('shop') }}">Kembali belanja</a>
    @endif
</div>

@include('partials.footer')