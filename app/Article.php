<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $table = "articles";
    protected $fillable = [
        'title',
        'body',
        'user_id'
    ];
}
