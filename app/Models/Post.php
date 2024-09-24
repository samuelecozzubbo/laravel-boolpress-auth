<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //Questo metodo che verrà visto come una propietà ($mioPost->category)
    //mi restituisce la tabella in relazione
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = ['title', 'slug', 'txt', 'reading_time'];
    protected $casts = [
        'created_at' => 'datetime:d/m/Y',
    ];
}
