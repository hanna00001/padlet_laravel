<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entrie extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'padlet_id','title', 'content'];

    public function padlet():BelongsTo{
        return $this->belongsTo(Padlet::class);
    }

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function ratings() : hasMany {
        return $this->hasMany(Rating::class);
    }

    public function comments() : hasMany {
        return $this->hasMany(Comment::class);
    }
}
