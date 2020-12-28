<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\User;

class Restaurant extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
    	'name',
    	'vendor',
    	'phone',
    	'is_delivering_now',
    	'is_active'
    ];

    public function registerMediaConversions(Media $media = null): void
    {
    	$this->addMediaConversion('thumb')
    		->width(50)
    		->height(50);
    }

    public function owner(){
    	return $this->belongsTo(User::class, 'vendor', 'id');
    }
}
