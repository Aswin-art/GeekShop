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
    @php
        $total = 0;
        $totalHarga = 0;
    @endphp
    <ul>
        <form action="{{ route('cart.checkout') }}" method="post">
            @csrf
            @if (session('cart'))
                @foreach ($items as $id => $detail)
                @php
                    $total += $detail['jumlah'];
                    $totalHarga += ($detail['jumlah'] * $detail['hargaProduk']);
                @endphp
                    id:
                    <input type="text" name="id" value="{{ $detail['idProduk'] }}" readonly>
                    nama:
                    <input type="text" name="namaProduk" value="{{ $detail['namaProduk'] }}" readonly>
                    harga:
                    <input type="text" name="hargaProduk" value="{{ $detail['hargaProduk'] }}" readonly>
                    jumlah:
                    <input type="text" name="jumlah" value="{{ $detail['jumlah'] }}" readonly>
                @endforeach
            @endif
            {{-- @foreach ($items as $item)
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
            @endforeach --}}

            @if (session('cart'))
                <div class="bagian-kurir" style="margin-top: 40px;">
                    <p>Pilih kurir</p>
                    <select name="kurir" id="kurir">
                        @foreach ($kurirs as $kurir)
                        <option value="{{ $kurir->id }}">{{ $kurir->namaPaket }}: {{ $kurir->hargaPaket }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="totalOrder" value="{{ $total }}">
                <input type="hidden" name="totalHarga" value="{{ $totalHarga }}">

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