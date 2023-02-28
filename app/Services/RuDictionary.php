<?php

namespace App\Services;

use App\Exceptions\RuDictionaryException;
use Illuminate\Support\Facades\Log;
use voku\helper\HtmlDomParser;

class RuDictionary
{
    protected HtmlDomParser $dom;
    protected $word;
    protected $audioSelector = 'div.word audio';
    const PAGE = 'https://vfrsute.ru/';
    public function __construct(string $word)
    {
        $this->word = $word;

        $this->getDom();
    }

    public function getAudio()
    {
        $str = $this->dom->find($this->audioSelector, 0)->src;
        if (empty($str)) {

            throw new RuDictionaryException("href audio for '$this->word' not found");
        }
        return self::PAGE . trim($str, '/');
    }

    protected function getDom()
    {
        $GETRequest = self::PAGE . $this->word;
        $page = $this->getPage($GETRequest);

        $this->dom = HtmlDomParser::str_get_html($page);
    }

    private function getPage($url)
    {
        $agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $page = curl_exec($ch);
        curl_close($ch);

        return $page;
    }
}
