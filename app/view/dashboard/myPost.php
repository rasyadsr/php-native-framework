<div class="container-fluid">
    <!-- <div class="card p-3"> -->
    <input type="text" id="searchMyPost" name="search">
    <div class="row col-xl-12 my-3">
        <!-- <h4>All your posts</h4> -->
        <table cellpadding="10" celspacing="0">
            <thead>
                <tr class="p-3">
                    <th scope="col">Title</th>
                    <th scope="col">Body</th>
                    <th scope="col">Category</th>
                    <th scope="col">created_at</th>
                    <th scope="col">updated_at</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['posts'] as $post) : ?>
                    <tr>
                        <th><?= $post['title'] ?></th>
                        <td><?= substr($post['body'], 0, 120) ?></td>
                        <td><?= $post['category_id'] ?></td>
                        <td><?= $post['created_at'] ?></td>
                        <td><?= $post['updated_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- </div> -->
</div>