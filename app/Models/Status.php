<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    const NEW = 1;

    const UNKNOWN = 2;

    const KNOWN = 3;

    const LEARN = 4;

    const LEARNED = 5;

    public $timestamps = false;

    protected $table = 'status';
    protected $fillable = ['name'];
}
