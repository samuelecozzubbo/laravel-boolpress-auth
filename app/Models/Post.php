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

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    protected $fillable = ['category_id', 'title', 'slug', 'txt', 'reading_time', 'path_image', 'image_original_name'];
    protected $casts = [
        'created_at' => 'datetime:d/m/Y',
    ];
}
