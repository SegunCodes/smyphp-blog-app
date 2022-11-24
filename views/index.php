<?php

use SmyPhp\Core\Application;
use SmyPhp\Core\DatabaseModel;

?>
<div class="container mt-3">
    <div class="row">
        <?php 
            $stmt = DatabaseModel::prepare("SELECT * FROM posts");
            $stmt->execute();
            $posts = $stmt->fetchAll();
            foreach ($posts as $post) {
        ?>
         <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img src="assets/images/<?php echo $post['image_name']; ?>" class="card-img-top" alt="image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $post['title']; ?></h5>
                    <p class="card-text"><?php echo $post['body']; ?></p>
                    <a href="/view/<?php echo $post['id']; ?>" class="btn btn-primary">View</a>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</div>