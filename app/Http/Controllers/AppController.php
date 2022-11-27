<?php

namespace App\Http\Controllers;
use SmyPhp\Core\Controller\Controller;
use SmyPhp\Core\Http\Request;
use SmyPhp\Core\Http\Response;
use SmyPhp\Core\Application;
use App\Http\Requests\CreateRequest;
use App\Http\Middleware\Authenticate;
use App\Http\Requests\EditRequest;
use App\Models\Post;

class AppController extends Controller{

    public function __construct(){
        $this->authenticatedMiddleware(new Authenticate(['create', 'myPosts', 'edit']));
    }

    public function homePage(){
        return $this->render('index');
    }

    public function create(Request $request){
        $msg = '';
        if($request->isPost()){
            // if(isset($_POST['submit'])){
                $title = $_POST["title"];
                $body = $_POST["body"];
                
                if(isset($_FILES['file']) && $_FILES['file']["error"] == 0){
                    $allowed = array(
                        "jpg" => "image/jpg", 
                        "jpeg" => "image/jpeg", 
                        "gif" => "image/gif", 
                        "png" => "image/png"
                    );
                    $filename = time().'_'.$_FILES['file']["name"];
                    $filetype = $_FILES['file']["type"];
                    $filesize = $_FILES['file']["size"];
                    $directory = "images";
                    $path = Application::$ROOT_DIR."/routes/assets/$directory";
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    // Verify file extension
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    if(!array_key_exists($ext, $allowed)) $msg = "Select a valid file format";
                
                    // Verify file size
                    $maxsize = 4 * 1024 * 1024;
                    if($filesize > $maxsize) $msg = "Image size is larger than the allowed limit - 4MB";;
        
                    // Verify MYME type of the file
                    if(in_array($filetype, $allowed)){
                        //check if directory name is given
                        if($directory = null){
                            $msg = "Directory name not given";
                        }
                        // Check whether file exists before uploading it
                        if(file_exists($path."/".$filename)){
                            $msg = "File already exists";
                        } else{
                            move_uploaded_file($_FILES['file']["tmp_name"], $path."/".$filename);
                            $create = new CreateRequest();
                            $create->setUserId(Application::$app->user->id);
                            $create->setTitle($title);
                            $create->setBody($body);
                            $create->setFile($filename);
                            $create->save();
                            $msg = "post submitted";
                        } 
                    } else{
                        $msg = "There was a problem uploading the file. Please try again."; 
                    }
                } else{
                    $msg = $_FILES['file']["error"];
                    return $this->render('create', [
                        'msg' => $msg
                    ]);
                }
            // }
        }
        return $this->render('create', [
            'msg' => $msg
        ]);
    }

    public function myPosts(){
        return $this->render('mypost');
    }

    public function view(Request $request, Response $response){
        $id = $request->getParams();
        $post = new Post;
        $value = $post->findAllWhere([
            'id' => implode("",$id)
        ]);
        if(!empty($value)){
            return $this->render('view', $value);
        }else{
            Application::$app->session->setFlash('error', 'Post Not Found');
            Application::$app->response->redirect('/');
        }
    }

    public function edit(Request $request, Response $response){
        $id = $request->getParams();
        $post = new Post;
        $val = $post->findAllWhere([
            'id' => implode("",$id)
        ]);
        //check if id exists
        if(!empty($val)){
            //check if user made the id
            $value = $post->findAllWhere([
                'id' => implode("",$id),
                'poster_id' => Application::$app->user->id
            ]);
            if(!empty($value)){
                return $this->render('edit', $value);
            }
            Application::$app->session->setFlash('error', 'You do not have access to this post');
            Application::$app->response->redirect('/my-posts');
        }else{
            Application::$app->session->setFlash('error', 'Post Not Found');
            Application::$app->response->redirect('/my-posts');
        }
    }

    public function delete(Request $request, Response $response){
        $id = $request->getParams();
        $post = new Post;
        $value = $post->delete([
            'id' => implode("",$id)
        ]);
        if(!empty($value)){
            Application::$app->session->setFlash('success', 'Post Deleted');
            Application::$app->response->redirect('/my-posts');
        }else{
            Application::$app->session->setFlash('error', 'Post Not Found');
            Application::$app->response->redirect('/my-posts');
        }
    }

    public function editPost(Request $request, Response $response){
        if($request->isPost()){
            $title = $_POST["title"];
            $body = $_POST["body"];
            $id = $_POST["id"];
            if(isset($_FILES['file']) && $_FILES['file']["error"] == 0){
                $allowed = array(
                    "jpg" => "image/jpg", 
                    "jpeg" => "image/jpeg", 
                    "gif" => "image/gif", 
                    "png" => "image/png"
                );
                $filename = time().'_'.$_FILES['file']["name"];
                $filetype = $_FILES['file']["type"];
                $filesize = $_FILES['file']["size"];
                $directory = "images";
                $path = Application::$ROOT_DIR."/routes/assets/$directory";
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                // Verify file extension
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if(!array_key_exists($ext, $allowed))
                Application::$app->session->setFlash('error', 'Select a valid file format');
                Application::$app->response->redirect('/my-posts');
                
            
                // Verify file size
                $maxsize = 4 * 1024 * 1024;
                if($filesize > $maxsize)
                Application::$app->session->setFlash('error', 'Image size is larger than the allowed limit - 4MB');
                Application::$app->response->redirect('/my-posts');
    
                // Verify MYME type of the file
                if(in_array($filetype, $allowed)){
                    //check if directory name is given
                    if($directory = null){
                        Application::$app->session->setFlash('error', 'Directory name not given');
                        Application::$app->response->redirect('/my-posts');
                    }
                    // Check whether file exists before uploading it
                    if(file_exists($path."/".$filename)){
                        Application::$app->session->setFlash('error', 'File already exists');
                        Application::$app->response->redirect('/my-posts');
                    } else{
                        move_uploaded_file($_FILES['file']["tmp_name"], $path."/".$filename);
                        $edit = new EditRequest();
                        $edit->setPostId($id);
                        $edit->setTitle($title);
                        $edit->setBody($body);
                        $edit->setFile($filename);
                        $edit->update();
                        Application::$app->session->setFlash('success', 'post updated');
                        Application::$app->response->redirect('/my-posts');
                    } 
                } else{
                    Application::$app->session->setFlash('error', 'There was a problem uploading the file. Please try again.');
                    Application::$app->response->redirect('/my-posts');
                }
            } else{
                $edit = new EditRequest();
                $edit->setPostId($id);
                $edit->setTitle($title);
                $edit->setBody($body);
                $edit->updateNoFile();
                Application::$app->session->setFlash('success', 'post updated');
                Application::$app->response->redirect('/my-posts');
            }
        }
    }
}