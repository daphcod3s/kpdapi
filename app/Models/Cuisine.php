<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Restaurant;

class Cuisine extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name',
    	'is_active',
    	'created_by'
    ];

    public function scopeActive($query){
    	return $query->where('is_active', true);
    }

    public function createdBy(){
    	return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function restaurants(){
        return $this->belongsToMany(Cuisine::class, 'restaurant_cuisines', 'cuisine_id', 'restaurant_id');
    }
}
