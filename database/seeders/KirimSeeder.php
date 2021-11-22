<?php

namespace Database\Seeders;

use App\Models\Kirim;
use Illuminate\Database\Seeder;

class KirimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kirim::create([
            'namaPaket' => 'JNE',
            'hargaPaket' => 2000
        ]);

        Kirim::create([
            'namaPaket' => 'JNT',
            'hargaPaket' => 2500
        ]);

        Kirim::create([
            'namaPaket' => 'Si Cepat',
            'hargaPaket' => 5000
        ]);
    }
}
