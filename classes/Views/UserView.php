<?php

namespace classes\Views;

use classes\Controller\UserController;

use classes\View;


class UserView extends UserController
{
    public $gClient;
    public function __construct()
    {
    }
    public function logout()
    {
        if (isset($_SESSION["login"])) {

            session_unset();
            session_destroy();
            $_SESSION["login"] = false;
            header("Location: /");
        } else {
            return View::view('pagenotfound', []);
        }
    }

    public function Login()
    {
        return View::view('login', [])->render(false);
    }
    public function LogUser()
    {

        /* variables  */
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $login_btn = $_POST['login_btn'];

        $ErroMessage = '';

        if ($this->isAcousticExist($_POST["email"]) == false) {
            $ErroMessage .= '- Email not corret  <br>';
        }
        if (strlen($_POST["pwd"]) < 8) {
            $ErroMessage .= '- Password should be more than 8 carac <br>';
        }
        if (!$ErroMessage) {
            ob_start();

            if ($this->isAcousticExist($_POST["email"]) !== false) {
                //User is Passed 
                $DataUser  = $this->isAcousticExist($_POST["email"]);
                $CheckPwd = password_verify($pwd , $DataUser["User_password"]);
                if ($CheckPwd) {
                    //Set Session 
                    $_SESSION['username'] = $DataUser["User_name"];
                    $_SESSION['email'] = $DataUser["User_email"];
                    $_SESSION['User_type'] = $DataUser["User_type"];
                    $_SESSION['User_id'] = $DataUser["Users_id"];
                    $_SESSION["login"] = true;
                    header('Location: /');
                    
                }else {
                    $ErroMessage .= '- password not corret  <br>';
                    header("Location: /login?Error=$ErroMessage");
                    exit;
                }
                
            }
        } else {
            header("Location: /login?Error=$ErroMessage");
            exit;
        }
    }

    public function Signup()
    {
        if (!isset($_SESSION["login"])) {
            require __DIR__ . '/../../config/Config_google.php';
            $login_url ="INDERWORKING";

            return View::view('signup', ['url' =>  $login_url])->render(false);
        } else {
            return View::view('Pagenotfound', [])->render(false);
        }
    }
    public function CreateAcounth()
    {

        $ErroMessage = '';

        if ($this->CheckEmpty($_POST["username"], $_POST["email"], $_POST["pwd"], $_POST["pwdrep"], $_POST["terms"]) != false) {
            $ErroMessage .= '- Empty Unputs <br>';
        }
        if ($this->isAcousticExist($_POST["email"]) != false) {
            $ErroMessage .= '- Email Not Availbe <br>';
        }
        if (!$this->Match_pwd($_POST["pwd"], $_POST["pwdrep"])) {
            $ErroMessage .= '- Pasword not matched <br>';
        }
        if ($_POST["terms"] !== 'Accepted') {
            $ErroMessage .= '- you should Agree with terms <br>';
        }
        if (strlen($_POST["pwd"]) < 8) {
            $ErroMessage .= '- Password should be more than 8 carac <br>';
        }

        if (!$ErroMessage) {
            //User is Passed 
            ob_start();
            echo View::view('loader', [])->render(false);
            $this->AddUser($_POST["username"], $_POST["email"], $_POST["pwd"]);
            
            $DataUser  = $this->isAcousticExist($_POST["email"]);
            //Set Session 
            $_SESSION['username'] = $DataUser["User_name"];
            $_SESSION['email'] = $DataUser["User_email"];
            $_SESSION['User_type'] = $DataUser["User_type"];
            $_SESSION['User_id'] = $DataUser["Users_id"];
            $_SESSION["login"] = true;
            header('Location: /');

            ob_end_flush();
        } else {
            header("Location: /signup?Error=$ErroMessage");
            exit;
        }
    }
}
