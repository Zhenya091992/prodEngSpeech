<?php

namespace App\Services;

use App\Models\EnWord;

class UserEnWordRelationsQuery
{
    protected $tableRelations = 'user-en_word_relations';
    protected $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function getWordsWithStatus($status)
    {
        $query = EnWord::join($this->tableRelations, 'en_words.id', '=', $this->tableRelations . '.en_word_id')
            ->where('user_id', '=', $this->userId)
            ->where('status_id', '=', $status);

        return $query;
    }

    public function getAllUserWordsNoHaweStatus()
    {
        $query = EnWord::leftJoin('user-en_word_relations', function ($join) {
            $join->on('en_words.id', '=', 'user-en_word_relations.en_word_id')
                ->where('user_id', '=', $this->userId);
        })->where('user_id', '=', null);

        return $query;
    }
}
