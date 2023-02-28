<?php

namespace Database\Seeders;

use App\Models\EnAudio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EnAudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = Storage::allFiles('public/audio/en/mp3');
        $this->command->withProgressBar($files, function ($path) {
            $audio = new EnAudio([
                'word' => Str::of($path)->basename('.mp3'),
                'path' => $path,
            ]);
            $audio->save();
        });
    }
}
