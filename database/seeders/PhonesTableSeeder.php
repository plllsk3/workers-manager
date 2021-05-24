<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Worker;

class PhonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('phones')->insert([
            'phone' => '+7(902)356-00-12',
            'phoneable_id' => Worker::find(1)->id,
            'phoneable_type' => Worker::class
        ]);
    }
}
