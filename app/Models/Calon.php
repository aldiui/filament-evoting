<?php

namespace App\Models;

use App\Models\User;
use App\Models\Suara;
use App\Models\Agenda;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Calon extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

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
    
    public function suara(): HasMany
    {
        return $this->hasMany(Suara::class);
    }
}