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
        'link',
    ];

    public $timestamps = false;

    public function genres()
    {
        return $this->belongsToMany(Genre::class);

    }

    public function getLinkUrlAttribute()
    {

        if ($this->link && strpos($this->link, 'posters/') === 0) {
            return Storage::url($this->link);
        }

        return $this->link ? asset($this->link) : asset('images/default-poster.jpg');
    }
}
