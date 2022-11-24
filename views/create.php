<?php

use SmyPhp\Core\Application;

?>
<div class="container">
    <div class="row">
        <h1>Create</h1>
        <div class="col-12">
            <form action="<?php Application::$ROOT_DIR."/create"?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" required id="exampleFormControlInput1">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Body</label>
                    <textarea class="form-control" name="body" required id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="input-group mb-3">
                    <input type="file" name="file" class="form-control">
                </div>
                <div class="input-group">
                    <input type="submit" class="btn btn-block btn-primary" value="Create">
                </div>
            </form>
            <?php 
                echo $msg;
            ?>
        </div>
    </div>
</div>