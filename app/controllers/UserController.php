<?php
include_once "../app/models/UsersModel.php";

class UserController
{
    public function regUser()
    {
       newUser($_POST['mail'],$_POST['pass1'],$_POST['pass2']);

    }
    public function authUser()
    {
        userIn($_POST['mail'],$_POST['pass1']);
    }

    public function  logOut()
    {
        if(isset($_SESSION['email'])){
            unset($_SESSION['email']);
            unset($_SESSION['cart']);
        }
    }

    public function index()
    {
        if(isset($_SESSION['email']))
        {
                userProfile($_SESSION['email']);
        }
        else{
            echo "<script>location.href = '/shop/web/';</script>";
        }
    }
    public function  update_prof()
    {
        updateProfile($_SESSION['email']);

    }
}