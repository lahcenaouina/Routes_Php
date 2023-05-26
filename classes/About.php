<?php

namespace classes;

class About {
     public function index(){
      echo "<pre>";
      var_dump($_GET);
      echo "</pre>";

      echo "<pre>";
      var_dump($_POST);
      echo "</pre>";

        echo "
        POST
        <form action=\"/about/create\" method=\"post\">\
            <label >Data</label>\
            <input type=\"text\" name=\"Data\" >\
            <input type=\"submit\"  value=\"SEND DATA\">\
         </form>";
         echo "
         GET
        <form action=\"/about/create\" method=\"get\">\
            <label >Data</label>\
            <input type=\"text\" name=\"Data\" >\
            <input type=\"submit\"  value=\"SEND DATA\">\
         </form>";
         
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
     public function lahcen() {
      return "LAHCEN ADMIN";
     }
} 