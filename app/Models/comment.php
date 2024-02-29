<?php

namespace App\Models;

use Database\Seeders\FeedSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'feed_id',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,);
    }

    public function feed()
    {
        return $this->belongsTo(feed::class,);
    }
}
