@include('partials.header')

<form action="{{ route('kategori.update', $kategori->id) }}" method="post">
    @csrf
    @method('put')
    <input type="text" placeholder="nama produk" required name="namaKategori" value="{{ $kategori->namaKategori }}">

    <button type="submit">Edit</button>
</form>

@include('partials.footer')