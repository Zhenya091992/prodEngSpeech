<?php

namespace Database\Seeders;

use App\Models\EnWord;
use App\Models\RuWord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnRuRelations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $enWords = EnWord::all();
        $this->command->withProgressBar($enWords, function ($enWord) {
            $translate = DB::connection('sqlite')
                ->table('WORD')
                ->where('WORD', '=', $enWord->word)
                ->value('RUS');

            $ruWords = explode(', ', $translate);

            foreach ($ruWords as $word) {
                DB::table('en-ru_relations')->insert([
                    'en_word_id' => $enWord->id,
                    'ru_word_id' => RuWord::where('word', '=', $word)->value('id')
                ]);
            }
        });
    }
}
