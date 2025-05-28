<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Film extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'genre_id',
        'published',
        'link'
    ];
    public $timestamps = false;

    public function genres(){
        return $this->belongsToMany(Genre::class, 'genre_film');

    }
   public function getLinkUrlAttribute()
    {
        // Если link — путь в хранилище (начинается с posters/), используем Storage::url
        if ($this->link && strpos($this->link, 'posters/') === 0) {
            return Storage::url($this->link);
        }
        // Иначе используем asset для дефолтного изображения или пути в public
        return $this->link ? asset($this->link) : asset('images/default-poster.jpg');
    }
}

