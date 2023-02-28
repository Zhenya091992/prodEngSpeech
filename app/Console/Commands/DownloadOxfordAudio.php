<?php

namespace App\Console\Commands;

use App\Models\OxfordWord;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DownloadOxfordAudio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:download_oxford_audio';

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
        $words = $this->withProgressBar(OxfordWord::all(), function ($word) {
            try {
                $file = file_get_contents($word->getAttribute('us_mp3_href'));
            } catch (\Exception) {
                $this->error('Error download word: ' . $word);

                return;
            }

            $prefixFolderName = substr($word->word, 0, 1);
            $path = 'public/audio/en/mp3/' . $prefixFolderName . '/' . $word->word . '.mp3';
            Storage::put($path, $file);
        });

        return Command::SUCCESS;
    }
}
