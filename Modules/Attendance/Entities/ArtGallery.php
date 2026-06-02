<?php

namespace Modules\Attendance\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ArtGallery extends Model
{
    protected $table = 'art_galleries';

    protected $fillable = ['user_id', 'slug', 'title', 'image', 'description', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
