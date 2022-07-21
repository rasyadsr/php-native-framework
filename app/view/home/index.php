<?php require_once __DIR__ . '/navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="px-4 py-5 my-5 text-center">
            <div class="col-lg-6 mx-auto">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" style="height: 300px">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <h1 class="display-5 fw-bold">“It has become appallingly obvious that our technology has exceeded our humanity.”</h1>
                            <p class="lead mb-4">Albert Einstein, Scientist
                            <p>
                        </div>
                        <div class="carousel-item">
                            <h1 class="display-5 fw-bold">“Knowledge is power.” </h1>
                            <p class="lead mb-4">Francis Bacon
                            <p>
                        </div>
                        <div class="carousel-item">
                            <h1 class="display-5 fw-bold">"Programming isn't about what you know; it's about what you can figure out.” </h1>
                            <p class="lead mb-4">FChris Pine
                            <p>
                        </div>
                        <div class="carousel-item">
                            <h1 class="display-5 fw-bold">"Sometimes it's better to leave something alone, to pause, and that's very true of programming."</h1>
                            <p class="lead mb-4">Joyce Wheeler
                            <p>
                        </div>
                        <div class="carousel-item">
                            <h1 class="display-5 fw-bold">"Don't write better error messages, write code that doesn't need them."</h1>
                            <p class="lead mb-4">Jason C. McDonald
                            <p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <?php foreach ($data['posts'] as $post) : ?>
            <div class="col-xl-3 col-md-6">
                <a href="/post/read/<?= $post['id'] ?>" class="text-decoration-none text-dark">
                    <div class="card mb-5 border-0" style="width: 19rem;">
                        <img src="<?= BASE_URL . 'assets/img/sample.jpg' ?>" class="card-img-top card-img-bottom" alt="...">
                        <div class="card-body">
                            <?php $date =  date_create($post['created_at']) ?>
                            <small class="text-secondary"><?= date_format($date, "F j, o") ?></small>
                            <h5 class="card-title"><?= $post['title'] ?></h5>
                            <?php
                            $excerpt = substr($post['body'], 0, 150);
                            ?>
                            <article><?= $excerpt ?></article>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link text-dark" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link bg-dark text-light" href="#">1</a></li>
                <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link text-dark" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<?php require_once __DIR__ . "/footer.php" ?>