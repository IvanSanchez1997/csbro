<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Game extends Model
{
    /** @use HasFactory<\Database\Factories\GameFactory> */
    protected $fillable = ['id', 'type', 'preference'];
    use HasFactory;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
