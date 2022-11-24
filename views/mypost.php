<?php

use SmyPhp\Core\Application;
use App\Models\Post;
?>
<div class="container mt-4">
    <div class="row">
        <?php
            $user_id = Application::$app->user->id;
            $myPosts = new Post;
            $posts = $myPosts->findAllWhere([
                'poster_id' => $user_id
            ]);
            foreach ($posts as $post) {
        ?>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="assets/images/<?php echo $post['image_name']; ?>" class="card-img-top" alt="image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $post['title']; ?></h5>
                        <p class="card-text"><?php echo $post['body']; ?></p>
                        <a href="/view/<?php echo $post['id']; ?>" class="btn btn-success">View</a>
                        <a href="/edit/<?php echo $post["id"]; ?>" class="btn btn-primary">Edit</a>
                        <a href="/delete/<?php echo $post["id"]; ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
        
    </div>
</div>