@include('partials.header')

<form action="{{ route('kategori.store') }}" method="post">
    @csrf
    <input type="text" placeholder="nama kategori" name="namaKategori">
    <button type="submit">Create</button>
</form>

@include('partials.footer')