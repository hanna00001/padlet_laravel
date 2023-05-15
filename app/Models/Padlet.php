<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Padlet extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'user_id', 'is_public'];

    public function user() : BelongsTo {
        return $this->BelongsTo(User::class);
    }

    public function entries() : HasMany {
        return $this->hasMany(Entrie::class);
    }

    public function userrights() : HasMany {
        return $this->hasMany(Userright::class);
    }

}
