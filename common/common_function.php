<?php

namespace MVC\Common;

class Common_function
{
    public static function upload_img_file()
    {
        var_dump($_FILES);
        if (isset($_FILES['img'])){
            $folder = '/img/';		
            $upload_file = $_FILES['img']['tmp_name'];
            $filename = basename($_FILES['img']['name']);
            $target_dir = $_SERVER['DOCUMENT_ROOT'] . $folder;
            $target_file = $target_dir . $filename;
            $result_upload_file = move_uploaded_file($upload_file, $target_file);
            if($result_upload_file) return $folder.$filename;
        }
        return;
    }
} 


