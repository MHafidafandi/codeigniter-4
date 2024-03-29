<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | Learnci4'
        ];
        return view('pages/home', $data);
    }
    public function about()
    {
        $data = [
            'title' => 'About Me'
        ];
        return view('pages/about', $data);
    }
    public function contact()
    {
        $data = [
            'title' => 'Contact Us',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'jl. ahmad yani',
                    'kota' => 'Mojokerto'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Pungging',
                    'kota' => 'Sidoarjo'
                ]
            ]
        ];
        return view('pages/contact', $data);
    }
}
