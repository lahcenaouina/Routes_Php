<?php

namespace classes;
use classes\App;
use PDO ; 
class Home  {
     public function index(){
        $sql = 'SELECT * from users';
        $stmt = App::connect()->prepare($sql); 
        $stmt->execute();
        
        print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
         return 'HOME PAGE / ';

     }        
} 