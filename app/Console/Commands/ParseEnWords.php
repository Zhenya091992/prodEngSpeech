<?php

namespace App\Console\Commands;

use App\Models\OxfordWord;
use Illuminate\Console\Command;
use voku\helper\HtmlDomParser;

class ParseEnWords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'downloadEnWords';

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
        $homeURI = 'https://www.oxfordlearnersdictionaries.com';
        ini_set('memory_limit', '-1');
        $page = $this->getPage('https://www.oxfordlearnersdictionaries.com/wordlists/oxford3000-5000');

        $dom = HtmlDomParser::str_get_html($page);
        $element = $dom->find('li[data-hw]');

        foreach ($element as $item) {
            $elem = $item->find('a', 0);
            $oxWord = new OxfordWord([
                'word' => $elem->plaintext,
                'link' => $homeURI . $elem->getAttribute('href'),
                'part' => $item->find('span.pos', 0)->plaintext,
                'level' => $item->find('span.belong-to', 0)->plaintext,
                'us_mp3_href' => $homeURI . $item->find('div div', 0)->getAttribute('data-src-mp3'),
                'us_ogg_href' => $homeURI . $item->find('div div', 0)->getAttribute('data-src-ogg'),
                'br_mp3_href' => $homeURI . $item->find('div div', 1)->getAttribute('data-src-mp3'),
                'br_ogg_href' => $homeURI . $item->find('div div', 1)->getAttribute('data-src-ogg'),
            ]);
            $oxWord->save();
        }

        return Command::SUCCESS;
    }

    private function getPage($url)
    {
        $agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_URL,$url);
        $page = curl_exec($ch);
        curl_close($ch);

        return $page;
    }
}
