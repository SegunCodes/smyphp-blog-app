<?php

use SmyPhp\Core\Application;

?>
<div class="container">
    <div class="row">
        <h1><?php echo $value["title"];?></h1>
        <div class="col-md-12">
            <div class="card" style="width: 18rem;">
                <img src="../assets/images/<?php echo $value["image_name"]; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text"><?php echo $value["body"]; ?></p>
                    <?php if(!Application::$app->isGuest()): ?>
                        <?php if(Application::$app->user->id == $value["poster_id"]): ?>
                            <a href="/edit/<?php echo $value["id"]; ?>" class="btn btn-primary">Edit</a>
                            <a href="/delete/<?php echo $value["id"]; ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>