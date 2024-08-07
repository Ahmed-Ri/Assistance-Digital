<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compagne extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_debut',
        'date_fin',
        'objectif',
        'reseaux',
        'details',
        'status'
    ];
   
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    public function images()
    {
        return $this->hasMany(ImageUpload::class, 'compagne_id');
    }
}
