<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-2">News</h1>
            <form action="" method="post">
                <div class="input-group mt-3">
                    <input type="text" class="form-control" placeholder="Search..." name="keyword">
                    <button class="btn btn-primary" type="submit" name="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-striped tabel-hover table-light mt-4">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th>News</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (7 * ($current_page - 1)); ?>
                    <?php foreach ($news as $n) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $n['News']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="pagination justify-content-center">
                <?= $pager->Links('news', 'news_pagination'); ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>