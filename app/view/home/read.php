<?php require_once __DIR__ . './navbar.php' ?>
<div class="container">
    <!-- Post Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <img src="<?= BASE_URL . '/assets/img/sample.jpg' ?>" class="img-fluid rounded-3 mb-3">
                    <?php $date = date_create($data['post']['created_at']) ?>
                    <small class="text-secondary"><?= date_format($date, "F j, o") ?></small>
                    <h3 class="fw-bold"><?= $data['post']['title'] ?></h3>
                    <section class="article my-5">
                        <?= $data['post']['body'] ?>
                    </section>
                    <a class="d-flex justify-content-end text-secondary text-decoration-none" href="/">Back</a>
                </div>
            </div>
        </div>
    </article>
</div>
<?php require_once __DIR__ . './footer.php' ?>