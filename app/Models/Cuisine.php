<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
