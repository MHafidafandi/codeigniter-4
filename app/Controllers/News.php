<?php

namespace App\Controllers;

use \App\Models\NewsModel;

class News extends BaseController
{
    protected $NewsModel;
    public function __construct()
    {
        $this->NewsModel = new NewsModel;
    }
    public function index()
    {

        $current_page = $this->request->getVar('page_news') ? $this->request->getVar('page_news') : 1;
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $berita = $this->NewsModel->search($keyword);
        } else {
            $berita = $this->NewsModel;
        }
        $data = [
            'title' => 'Daftar News',
            'news' => $berita->paginate(7, 'news'),
            'pager' => $this->NewsModel->pager,
            'current_page' => $current_page
            // 'news' => $this->NewsModel->findAll()
        ];

        return view('news/index', $data);
    }
}
