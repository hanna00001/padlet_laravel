<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Userright extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'padlet_id',
        'read',
        'edit',
        'delete',
    ];

    // Ein Userright gehört zu einem User (ist abhängig von ihm)
    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    // Ein Userright gehört zu einem Padlet (ist abhängig von ihm)
    public function padlet() : BelongsTo {
        return $this->belongsTo(Padlet::class);
    }
}
