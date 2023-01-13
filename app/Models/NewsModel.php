<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news';
    protected $allowedFields  = ['News'];

    public function search($keyword)
    {
        return $this->table('news')->like('News', $keyword);

        // $builder = $this->table('news');
        // $builder->like('News', $keyword);
        // return $builder;
    }
}
