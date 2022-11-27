<?php
namespace App\Http\Requests;
use SmyPhp\Core\DatabaseModel;

class EditRequest{
    private $post_id;
    private $title;
    private $body;
    private $filename;

    public function setPostId($post_id){
        $this->post_id = $post_id;
    }
    public function getPostId(){
        return $this->post_id;
    }

    public function setTitle($title){
        $this->title = $title;
    }
    public function getTitle(){
        return $this->title;
    }

    public function setBody($body){
        $this->body = $body;
    }
    public function getBody(){
        return $this->body;
    }

    public function setFile($filename){
        $this->filename = $filename;
    }
    public function getFile(){
        return $this->filename;
    }

    public function update(){
        $stmt = DatabaseModel::prepare("UPDATE posts SET title = :title, body = :body, image_name = :image_name WHERE id = :post_id");
        $stmt->bindParam(':post_id', $this->post_id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':image_name', $this->filename);
        if($stmt->execute()){
            return true;
        }
    }

    public function updateNoFile(){
        $stmt = DatabaseModel::prepare("UPDATE posts SET title = :title, body = :body WHERE id = :post_id");
        $stmt->bindParam(':post_id', $this->post_id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        if($stmt->execute()){
            return true;
        }
    }
}