@include('partials.header')

<form action="{{ route('produk.update', $produk->id) }}" method="post">
    @csrf
    @method('put')
    <input type="text" placeholder="nama produk" required name="namaProduk" value="{{ $produk->namaProduk }}">
    <input type="number" placeholder="berat produk" required name="beratProduk" value="{{ $produk->beratProduk }}">
    <input type="number" placeholder="harga produk" required name="hargaProduk" value="{{ $produk->hargaProduk }}">
    <select name="idKategori" id="kategori" required>
        @foreach ($kategori as $item)
            <option value="{{ $item->id }}">{{ $item->namaKategori }}</option>
        @endforeach
    </select>


    <button type="submit">Edit</button>
</form>

@include('partials.footer')