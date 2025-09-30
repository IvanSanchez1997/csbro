<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Playtime extends Model
{
    protected $fillable = ['user_id', 'start_time', 'end_time'];

    use HasFactory;

        public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
