<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class CreateStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            [
                'id' => '1',
                'name' => 'Selesai'

            ],
            [
                'id' => '2',
                'name' => 'Ditolak'

            ],
            [
                'id' => '3',
                'name' => 'Pending'
            ]
        ];

        foreach($status as $key => $value){
            Status::create($value);
        }
    }
}
