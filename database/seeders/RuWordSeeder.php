<?php

namespace Database\Seeders;

use App\Models\EnWord;
use App\Models\RuWord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $enWords = EnWord::all();
        foreach ($enWords as $enWord) {
            $rewordWord = DB::connection('sqlite')
                ->table('WORD')
                ->where('WORD', '=', $enWord->word)
                ->first();

            $translate = $rewordWord->RUS;
            foreach (explode(', ', $translate) as $ruWord) {
                if (DB::table('ru_words')->where('word', '=', $ruWord)->exists()) {
                    continue;
                }

                $word = new RuWord([
                    'word' => $ruWord,
                    'count_repeated' => 0,
                    'id_status' => Db::table('status')
                        ->where('name', '=', 'new')
                        ->value('id'),
                    'id_audio' => 0,
                ]);

                $word->save();
            }
        }
    }
}
