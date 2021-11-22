@include('partials.header')

<form action="{{ route('produk.create') }}" method="post">
    @csrf
    <input type="text" placeholder="nama produk" required name="namaProduk">
    <input type="number" placeholder="berat produk" required name="beratProduk">
    <input type="number" placeholder="harga produk" required name="hargaProduk">
    <select name="idKategori" id="kategori" required>
        @foreach ($kategori as $item)
            <option value="{{ $item->id }}">{{ $item->namaKategori }}</option>
        @endforeach
    </select>

    <button type="submit">Create</button>
</form>

@include('partials.footer')