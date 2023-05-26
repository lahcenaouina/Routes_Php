<?php

namespace classes;

class Home {
     public function index(){
      echo "<pre> GET =>";
      var_dump($_GET);
      echo "</pre>";

      echo "<pre>POST => ";
      var_dump($_POST);
      echo "</pre>";
        return "HOME PAGE";
     }
} 