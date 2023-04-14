<?php

namespace App\Services;

use App\Models\EnWord;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserEnRelations
{
    protected $db;
    protected $table = 'user-en_word_relations';
    protected User $user;
    protected EnWord $enWord;
    protected Status $status;

    public function __construct(User $user, EnWord $enWord, Status $status)
    {
        $this->user = $user;
        $this->enWord = $enWord;
        $this->status = $status;
        $this->db = DB::table($this->table);
    }

    public function save()
    {
        return $this->db->updateOrInsert([
            'user_id' => $this->user->id,
            'en_word_id' => $this->enWord->id,
        ],[
            'status_id' => $this->status->id,
        ]);
    }
}
