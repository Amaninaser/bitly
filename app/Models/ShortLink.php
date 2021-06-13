<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ShortLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'url_link',
        'code',
        'user_id',
        'count',
    ];
    public function user()
    {
        return $this->belongsTo(ShortLink::class,'user_id','id');
    }
}
