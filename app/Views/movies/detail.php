<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">Detail Film</h1>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $movies['sampul']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $movies["judul"]; ?></h5>
                            <p class="card-text"><b>Sutradara : </b><?= $movies['sutradara']; ?></p>
                            <p class="card-text"><small class="text-muted"><b>Penerbit : </b><?= $movies['penerbit']; ?></small></p>

                            <a href="/Movies/edit/<?= $movies['slug']; ?>" class="btn btn-warning">Edit</a>

                            <form action="/Movies/<?= $movies['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin');">Delete</button>
                            </form>
                            <br><br>
                            <a href="/movies">Kembali ke daftar film</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>