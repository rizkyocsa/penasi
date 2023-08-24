<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class CreateKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategoris = [
            [
                'id' => '1',
                'jenis' => 'Pengaduan',
                'kategori' => 'Psikologi'

            ],
            [
                'id' => '2',
                'jenis' => 'Pengaduan',
                'kategori' => 'Kekerasan'

            ],
            [
                'id' => '3',
                'jenis' => 'Pengaduan',
                'kategori' => 'Kegiatan Belajar Mengajar (KBM)'

            ],
            [
                'id' => '4',
                'jenis' => 'Pengaduan',
                'kategori' => 'Sarana dan Prasana'

            ],
            [
                'id' => '5',
                'jenis' => 'Aspirasi',
                'kategori' => 'Kegiatan Belajar Mengajar (KBM)'

            ],
            [
                'id' => '6',
                'jenis' => 'Aspirasi',
                'kategori' => 'Sarana dan Prasana'

            ],
        ];

        foreach($kategoris as $key => $value){
            Kategori::create($value);
        }
    }
}
