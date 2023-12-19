<?php

namespace App\Models;

use App\Models\User;
use App\Models\Agenda;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Calon extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function agenda(): BelongsTo
    {
        return $this->belongsTo(Agenda::class);
    }   
    
    public function ketua(): BelongsTo
    {
        return $this->belongsTo(User::class, "ketua_id", "id");
    }    
    
    public function wakil(): BelongsTo
    {
        return $this->belongsTo(User::class, "wakil_id", "id");
    }    
}