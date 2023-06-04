<?php

namespace classes\Models;

use classes\DBH;
use classes\App;
use PDO;

abstract class Post

{
        protected function Getcommentsbypostid($id_post)
        {

                $sql  = 'SELECT u.User_name , c.comment_content , c.comment_time 
                FROM comments c , users u 
                WHERE u.Users_id = c.users_id and post_id = ?;';


                $stmt = App::connect()->prepare($sql);
                if (!$stmt->execute([$id_post])) {
                        $stmt = null;
                        header("location: /?Msg=stmtFailed");
                        exit();
                }

                if ($stmt->rowCount() > 0) {
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                return false;
        }


        protected function AddcomentToDb($id_post, $comment, $id_User)
        {
                $sql = "INSERT INTO comments(post_id, users_id , comment_content) VALUES (?,?,?)";
                $stmt = App::connect()->prepare($sql);
                if (!$stmt->execute([$id_post, $id_User, $comment])) {
                        $stmt = null;
                        header("location: /signup?Error=stmtFailed");
                        exit();
                }
                $stmt = null;
        }
        protected function AddPost($id, $text, $time)
        {
                $sql = "INSERT INTO `posts`( `Post_Aurther`,`Post_content`, `Post_time`) 
                VALUES (? , ? , ?)";
                $stmt = App::connect()->prepare($sql);
                if (!$stmt->execute([$id, $text, $time])) {
                        $stmt = null;
                        header("location: /signup?Error=stmtFailed");
                        exit();
                }
                $stmt = null;
        }

        protected function GetAllPosts()
        {
                $sql  = 'SELECT * from posts , users where Post_Aurther = users.Users_id ORDER BY posts.Post_time DESC';
                $stmt = App::connect()->prepare($sql);
                if (!$stmt->execute([])) {
                        $stmt = null;
                        header("location: /?Msg=stmtFailed");
                        exit();
                }

                if ($stmt->rowCount() > 0) {
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                return false;
        }
}
