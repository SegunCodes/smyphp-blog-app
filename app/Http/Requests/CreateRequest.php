<?php
namespace App\Http\Requests;
use SmyPhp\Core\DatabaseModel;

class CreateRequest{
    private $user_id;
    private $title;
    private $body;
    private $filename;

    public function setUserId($user_id){
        $this->user_id = $user_id;
    }
    public function getUserId(){
        return $this->user_id;
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

    public function save(){
        $stmt = DatabaseModel::prepare("INSERT INTO posts SET poster_id = :poster_id, title = :title, body = :body, image_name = :image_name");
        $stmt->bindParam(':poster_id', $this->user_id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':image_name', $this->filename);
        if($stmt->execute()){
            return true;
        }
    }
}