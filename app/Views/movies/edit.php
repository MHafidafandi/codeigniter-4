<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="my-2">Ubah Data Film</h1>
            <form action="/Movies/update/<?= $movies['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $movies['slug']; ?>">
                <input type="hidden" name="sampulLama" value="<?= $movies['sampul']; ?>">
                <div class="mb-3 row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= (old('judul')) ? old('judul') : $movies['judul']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('judul'); ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="sutradara" class="col-sm-2 col-form-label">Sutradara</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="sutradara" name="sutradara" value="<?= (old('sutradara')) ? old('sutradara') : $movies['sutradara']; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= (old('penerbit')) ? old('penerbit') : $movies['penerbit']; ?>">
                    </div>
                </div>
                <div class="input-group mb-3 row">
                    <label for="sampul" class="col-sm-2 form-label">Sampul</label>
                    <div class="col-sm-2">
                        <img src="/img/<?= $movies['sampul']; ?>" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-4">
                        <input type="file" class="form-control <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" id="sampul" name="sampul" onchange="preview()">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('sampul'); ?>
                        </div>
                    </div>
                </div>
                <div class=" mb-3 row">
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary">Ubah Film!</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>