<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <a href="/movies/create" class="btn btn-primary mt-2">Tambah Data Film</a>
            <h1 class="mt-2">Daftar Film</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-bordered table-striped tabel-hover table-light mt-4">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th>Sampul</th>
                        <th>Judul</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($movies as $movie) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="img/<?= $movie['sampul']; ?>" alt="" class="poster"></td>
                            <td><?= $movie['judul']; ?></td>
                            <td>
                                <a href="/Movies/<?= $movie['slug']; ?>" class="btn btn-success">Details</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>