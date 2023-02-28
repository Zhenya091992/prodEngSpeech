<?php

namespace App\Console\Commands;

use App\Models\RuAudio;
use App\Models\RuWord;
use App\Services\RuDictionary;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DownloadRuAudio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:download_ru_audio';

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
        $words = $this->withProgressBar(RuWord::all(), function ($word) {
            try {
                $audioRef = (new RuDictionary($word->word))->getAudio();
            } catch (\Exception $e) {
                $this->error('word: ' . $word->word . ' not found');

                return;
            }

            try {
                $file = file_get_contents($audioRef);
            } catch (\Exception $e) {
                $this->error('href: ' . $audioRef . 'error code:' . $e->getCode());

                return;
            }

            $prefixFolderName = mb_substr($word->word, 0, 1);
            $path = 'public/audio/ru/ogg/' . $prefixFolderName . '/' . $word->word . '.ogg';
            if (Storage::put($path, $file)) {
                $ruAudio = new RuAudio([
                    'word' => $word->word,
                    'path' => $path,
                ]);
                $ruAudio->save();
            }
        });

        return Command::SUCCESS;
    }
}
