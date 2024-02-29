<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'feed_id',
    ];

    public function feed()
    {
        return $this->belongsTo(feed::class,);
    }
}
