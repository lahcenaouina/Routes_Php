<?php

namespace classes;

class Home {
     public function index(){

         return 'HOME PAGE / ';

     }
     public function upload() {
          echo "UPLOADS <br> <pre>" ; 
          var_dump($_FILES);
          var_dump(pathinfo($_FILES["receipt"]["tmp_name"]));
          echo "</pre>";
          $file_path_storage_space = STORAGE_IMG_PATH . DIRECTORY_SEPARATOR . $_FILES["receipt"]["name"];

          $file_path_on_server = $_FILES["receipt"]["tmp_name"];
          
          if ($_FILES["receipt"]["type"] ==  ("image/png")) {
               
               if (move_uploaded_file($file_path_on_server , $file_path_storage_space)){
                    // echo "<pre>".var_dump($files = scandir(STORAGE_IMG_PATH . DIRECTORY_SEPARATOR))."</pre>";
                    $images  = scandir(STORAGE_IMG_PATH . DIRECTORY_SEPARATOR);
                    foreach($images as $image) {
                         if ($image == '.' or $image =='..') {
                              continue;
                         }
                         echo "<img height=150 src=\"uploads/img/$image\">"; 
                    }

               }else {
                    echo "FILE DISMISSED";
               }
          }else {
               echo "type not accepted " ; 
          }

          
     }   
} 