<?php

namespace assignment\image;

class Image {

    private $name;
    private $image_error;
    private $image_size;
    private $image_tmp_name;
    private $ext;
    private $errors = [];
    public function __construct($name, $image_error, $image_size, $image_tmp_name){
        $this->name = $name;
        $this->image_error = $image_error;
        $this->image_size = $image_size;
        $this->image_tmp_name = $image_tmp_name;
        $this->ext = strtolower(pathinfo($this->name, PATHINFO_EXTENSION));
    }

    public function validate(){
        $arr_ext = ['png','jpg','jpeg','gif'];
            
            if($this->image_error != 0){
                $this->errors[] = "choose correct image";
            }elseif($this->image_size > 1){
                $this->errors[] = "image is large size";
            }elseif(!in_array($this->ext,$arr_ext)){
                $this->errors[] = "image not correct";
            }
            return $this->errors;
    }

    public function rename(){
        $random = uniqid().time();
        $this->name = $random.".".$this->ext;
        return $this;
    } 

    public function upload(){
        move_uploaded_file($this->image_tmp_name, 'upload/'.$this->name);
        return "is Uploaded";
    } 
}