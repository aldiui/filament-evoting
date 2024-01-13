<?php

namespace App\Models;

use App\Models\User;
use App\Models\Ormawa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggota extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function ormawa(): BelongsTo
    {
        return $this->belongsTo(Ormawa::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}