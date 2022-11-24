<?php
namespace App\Http\Requests;
use SmyPhp\Core\DatabaseModel;

class EditRequest{
    private $user_id;
    private $post_id;
    private $title;
    private $body;
    private $filename;

    public function setUserId($user_id){
        $this->user_id = $user_id;
    }
    public function getUserId(){
        return $this->user_id;
    }

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
        
    }
}