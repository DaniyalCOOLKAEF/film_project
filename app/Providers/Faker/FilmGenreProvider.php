<?php

namespace App\Providers\Faker;

use Faker\Provider\Base;

class FilmGenreProvider extends Base
{
    protected static $filmGenres = [
        'Action',
        'Adventure',
        'Comedy',
        'Drama',
        'Fantasy',
        'Horror',
        'Mystery',
        'Romance',
        'Science Fiction',
        'Thriller',
        'Western',
        'Animation',
        'Documentary',
        'Musical',
        'Crime',
        'Historical',
        'War',
        'Family',
        'Biography',
        'Sport',
        'Superhero',
        'Noir',
        'Psychological',
        'Satire',
        'Epic',
        'Dystopian',
        'Post-Apocalyptic',
        'Coming-of-Age',
        'Historical Fiction',
        'Political',
        
    ];

    public function filmGenre()
    {
        return static::randomElement(self::$filmGenres);
    }
}