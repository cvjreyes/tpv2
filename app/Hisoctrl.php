<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hisoctrl extends Model
{
    protected $fillable = ['filename','revision','requested','requestedlead','issued','from', 'to', 'comments', 'user' ];
}
