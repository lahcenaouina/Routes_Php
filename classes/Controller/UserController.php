<?php

namespace classes\Controller;

use classes\Models\User;
use EmptyIterator;

class UserController extends User
{
        protected function CheckEmpty($name  ,$email , $pwd , $pwdrep , $terms) {
                return (empty($name) || empty($email) || empty($pwd) || empty($pwdrep) || empty($terms));
        }
        protected function isAcousticExist($email) {
                return $this->IsCheckUserExist($email);
        }
        protected function Match_pwd($pwd , $pwd_rep){
                return $pwd == $pwd_rep ;
 
        }
  
}