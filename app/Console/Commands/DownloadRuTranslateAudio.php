<?php

namespace App\Console\Commands;

use App\Jobs\DownloadAudio;
use App\Models\EnWord;
use Illuminate\Console\Command;
use Yayheni\Speechgen\SpeechgenAPI;

class DownloadRuTranslateAudio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DownloadRuTranslateAudio';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $words = EnWord::all();
        foreach ($words as $word) {
            $api = new SpeechgenAPI(env('SPEECHGEN_TOKEN'), env('SPEECHGEN_EMAIL'));
            $voice = 'Bot Maksim';
            $ruWords = explode(', ', $word->translation);
            foreach ($ruWords as $oneRuWord) {
                DownloadAudio::dispatch($api, $oneRuWord, $voice);
            }
        }
        return Command::SUCCESS;
    }
}
