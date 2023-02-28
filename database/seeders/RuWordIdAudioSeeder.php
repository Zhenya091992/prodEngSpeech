<?php

namespace Database\Seeders;

use App\Models\RuAudio;
use App\Models\RuWord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuWordIdAudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allAudio = RuAudio::all();
        foreach ($allAudio as $audio) {
            $word = RuWord::where('word', '=' , $audio->word)->first();
            $word->id_audio = $audio->id;
            $word->save();
        }
    }
}
