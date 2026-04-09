<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestColors extends Model
{
    use HasFactory;

    protected $table = 'user_suggest_colors';

    protected $guarded = ['id'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
