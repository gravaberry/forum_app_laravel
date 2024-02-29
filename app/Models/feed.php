<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feed extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'content',
    ];
    protected $appends =['liked'];

    public function user()
    {
        return $this->belongsTo(User::class,);
    }
    public function likes()
    {
        return $this->hasMany(like::class,);
    }
    public function comment()
    {
        return $this->hasMany(comment::class,);
    }

    public function getLikedAttribute():bool
    {
       return (bool) $this->likes()->where('feed_id',$this->id)->where('user_id',auth()->id())->exists();
    }
}
