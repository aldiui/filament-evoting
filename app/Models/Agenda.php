<?php

namespace App\Models;

use App\Models\Calon;
use App\Models\Ormawa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agenda extends Model
{
    use HasFactory;

    protected $guarded = ["id"];


    public function ormawa(): BelongsTo
    {
        return $this->belongsTo(Ormawa::class);
    }

    public function calon(): HasMany
    {
        return $this->hasMany(Calon::class);
    }
}