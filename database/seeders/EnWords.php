<?php

namespace Database\Seeders;

use App\Models\Audio;
use App\Models\EnWord;
use App\Models\OxfordWord;
use App\Models\Word;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EnWords extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oxfordWords = OxfordWord::all();

        foreach ($oxfordWords as $word) {
            $rewordWord = DB::connection('sqlite')
                ->table('WORD')
                ->where('WORD', '=', $word->word)
                ->first();
            if (empty($rewordWord)) {
                continue;
            }
            $enWord = new EnWord([
                'word' => $word->word,
                'transcription' => $rewordWord->TRANSCRIPTION,
                'count_repeated' => 0,
                'id_status' => Db::table('status')
                    ->where('name', '=', 'new')
                    ->value('id'),
                'id_audio' => Db::table('en_audio')
                        ->where('word', '=',$word->word)
                        ->value('id') ?? 0,
            ]);
            $enWord->save();
        }
    }
}
