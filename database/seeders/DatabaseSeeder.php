<?php

namespace Database\Seeders;

use App\Models\Audio;
use App\Models\EnWord;
use App\Models\OxfordWord;
use App\Models\Status;
use App\Models\Word;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //(new StatusSeeder())->run();
        //(new EnWordsSeeder())->run();
        //(new RuWordsSeeder())->run();
        (new EnRuRelationsSeeder())->run();
        (new EnAudioSeeder())->run();
        (new RuAudioSeeder())->run();
    }
}
