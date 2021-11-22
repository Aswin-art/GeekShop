<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produk::create([
            'namaProduk' => 'Waspberry',
            'beratProduk' => 200,
            'tanggalProduksi'=> Carbon::now(),
            'hargaProduk' => 1000,
            'idKategori' => 1
        ]);

        Produk::create([
            'namaProduk' => 'adruino',
            'beratProduk' => 100,
            'tanggalProduksi'=> Carbon::now(),
            'hargaProduk' => 5000,
            'idKategori' => 5
        ]);
    }
}
