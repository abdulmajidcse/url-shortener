<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'main_url',
        'short_url_path',
        'click_count',
    ];

    // get user information who's created this url
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
