<?php

namespace App\Models;

use CodeIgniter\Model;

class MoviesModel extends Model
{
    protected $table = 'movies';
    protected $allowedFields  = ['judul', 'slug', 'sutradara', 'penerbit', 'sampul'];

    public function getMovies($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->Where(['slug' => $slug])->first();
    }
}
