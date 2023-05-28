<?php

namespace classes;

class About {
     public function index(){
      echo "ABOUT";
         return View::view('FromUpload' ,['title'=>'UPLOAD PAGE' , 'time' => time()])->render(false);
     }
     public function getter() {
      echo"hello";
      return "U Maked GET ";
     }
     
     public function poster() {
      return "U Maked Post ";
     }
     public function create(){
        return "ABOUT\create PAGE";
     }
     public function login() {
      $_SESSION['login'] = true  ;
      return 'LOGINED';
     }

        public function logout() {
      $_SESSION['login'] = false  ;
      return 'LOG OUT  : ' .(string) $_SESSION['login'];
     }
} 