<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = ['component', 'board', 'tool', 'cable', 'sensor'];
        foreach ($kategori as $item) {
            Kategori::create([
                'namaKategori' => $item
            ]);
        }
    }
}
