<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'new',
            'unknown',
            'known',
            'learn',
            'learned',
        ];

        foreach ($statuses as $status) {
            (new Status(['name' => $status]))->save();
        }
    }
}
