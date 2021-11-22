@include('partials.header')

<div class="bagian-produk">
  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Berat</th>
        <th>Harga</th>
      </tr>
    </thead>

    <tbody>
      <tr>
          @foreach ($produks as $produk)
            <td>{{ $produk->id }}</td>
            <td>{{ $produk->namaProduk }}</td>
            <td>{{ $produk->beratProduk }}</td>
            <td>{{ $produk->hargaProduk }}</td>
            <td>
                <form action="{{ route('produk.edit', $produk->id) }}" method="get">
                    @csrf
                    <button type="submit">Edit</button>
                </form>
                |
                <form action="{{ route('produk.delete', $produk->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit">Delete</button>
                </form>
            </td>
          @endforeach
      </tr>
    </tbody>
  </table>
</div>

<form action="{{ route('produk.create') }}" method="get">
  @csrf
  <button type="submit">Add</button>
</form>

<br>
<br>
<br>

<div class="bagian-category">
  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
      </tr>
    </thead>

    <tbody>
      <tr>
          @foreach ($kategori as $item)
            <td>{{ $item->id }}</td>
            <td>{{ $item->namaKategori }}</td>
            <td>
                <form action="{{ route('kategori.edit', $item->id) }}" method="get">
                    @csrf
                    <button type="submit">Edit</button>
                </form>
                |
                <form action="{{ route('kategori.delete', $item->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit">Delete</button>
                </form>
            </td>
          @endforeach
      </tr>
    </tbody>
  </table>
  <form action="{{ route('kategori.create') }}" method="get">
    @csrf
    <button type="submit">Add</button>
</form>
</div>

@include('partials.footer')