<?php

namespace App\Controllers;

use \App\Models\MoviesModel;

class Movies extends BaseController
{
    protected $MoviesModel;
    public function __construct()
    {
        $this->MoviesModel = new MoviesModel;
    }
    public function index()
    {
        $data = [
            'title' => 'Daftar Film',
            'movies' => $this->MoviesModel->getMovies()
        ];

        return view('movies/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Movie',
            'movies' => $this->MoviesModel->getMovies($slug)
        ];

        if (empty($data['movies'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul film ' . $slug . ' tidak ditemukan');
        }

        return view('/movies/detail', $data);
    }

    public function create()
    {

        $data = [
            'title' => 'Tambah Data Film',
            'validation' => \Config\Services::validation()
        ];
        return view('movies/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[movies.judul]',
                'errors' => [
                    'required' => '{field} film harus diisi.',
                    'is_unique' => '{field} film sudah terdaftar'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,2048]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar maximal 2mb',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]

        ])) {
            // $validation = \Config\Services::validation();

            // return redirect()->to('movies/create')->withInput()->with('validation', $validation);
            return redirect()->to('movies/create')->withInput();
        }
        $fileSampul = $this->request->getFile('sampul');
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.png';
        } else {
            // pindahkan file ke img
            $fileSampul->move('img');
            $namaSampul = $fileSampul->getName();
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->MoviesModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'sutradara' => $this->request->getVar('sutradara'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');
        return redirect()->to('/movies');
    }

    public function delete($id)
    {
        $movies = $this->MoviesModel->find($id);
        // cek jika gambar default
        if ($movies['sampul'] != 'default.png') {
            // hapus gambar di folder
            unlink('img/' . $movies['sampul']);
        }
        $this->MoviesModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to('/movies');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Ubah Data Film',
            'validation' => \Config\Services::validation(),
            'movies' => $this->MoviesModel->getMovies($slug)
        ];
        return view('movies/edit', $data);
    }

    public function update($id)
    {

        $moviesOld = $this->MoviesModel->getMovies($this->request->getVar('slug'));
        if ($moviesOld['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[movies.judul]';
        }
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} film harus diisi.',
                    'is_unique' => '{field} film sudah terdaftar'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,2048]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar maximal 2mb',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {

            return redirect()->to('movies/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            $namaSampul = $fileSampul->getName();
            $fileSampul->move('img');
            unlink('img/' . $this->request->getVar('sampulLama'));
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->MoviesModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'sutradara' => $this->request->getVar('sutradara'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah!');
        return redirect()->to('/movies');
    }
}
