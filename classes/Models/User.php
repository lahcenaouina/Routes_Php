<?php

namespace classes\Models;

use classes\DBH;
use classes\App;
use PDO ;
abstract class User
{       
        
        protected function IsCheckUserExist($email) {
                $sql  = "SELECT * from users Where User_email= ?" ; 
                $stmt = App::connect()->prepare($sql) ; 
                if (!$stmt->execute([$email])) {
                        $stmt = null ;
                        header("location: /signup?Error=stmtFailed");
                        exit();
                    }
            
                    if ($stmt->rowCount() > 0) {
                        return $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                    return false;
        }
        protected function AddUser($name , $email ,$pwd){
                $Hashed_Password = password_hash($pwd, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users`( `User_name`, `User_email`, `User_password`,`User_last_visite`, `User_type`) 
                VALUES (?,?,?,?,?)";

                $stmt = App::connect()->prepare($sql); 
                
                if (!$stmt->execute([$name , $email , $Hashed_Password , time() , 'USER'])) {
                        $stmt= null;
                        header('Location: /signup?Error=STMTFAILED');
                        exit;
                }
                
                $stmt= null; 
                
        }


}