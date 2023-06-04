<?php

namespace classes;



use classes\Controller\PostController;
use classes\Controller\UserController;
use classes\Views\PostView;
use DivisionByZeroError;

class Home   {

     public function index(){
      
        if (isset($_SESSION["login"]) ) {
         
         if (isset($_GET["p"])){
         
            if (strlen($_GET["p"]) > 0 ) {
               $id = $_SESSION["User_id"];
               $text = $_GET["p"];
               $time = time();
               $post= new PostController($id, $text , $time);
               $post->add();
               header("Location: /?Msg=Your Post was successfully posted");
               
            }
         }
             $posts= new PostView();
             $Div_Post = $posts->GetPosts();
            return View::view('Dashboard' , ['Div_Post'=>$Div_Post])->render(false);

          }else {
             return View::view('Home' , [])->render(false) ;
        }

     }        
} 