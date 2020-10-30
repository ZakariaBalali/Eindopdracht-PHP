<?php
require_once dirname(__FILE__).'/../DAL/LoginDAL.php';
require_once dirname(__FILE__).'/../DAL/UserDAL.php';


   $loginDal = new LoginDAL();
   $userDal = new UserDAL();
   session_start();

//goes throug login process when button is clicked
if (isset($_POST['login']))
{
    $_SESSION['user'] = array(
        'loginEmail' => $_POST['loginEmail'],
        'loginPassword' => $_POST['loginPassword'],
    );
    // Check email and password in DAL layer
    if ($loginDal->UserLogin($_POST['loginEmail'], $_POST['loginPassword']))
    {
        $_SESSION['LoggedIn'] = true;
        header('Location: ../View/AdministrationUsers.php');
    }

    else{
        echo "<script>alert('Incorrect email or password.')</script>";
    }
};

//goes through registration process when register button is clicked
if (isset($_POST['register']))
{

    if($userDal->GetUserByEmail($_POST['registerEmail']) === null) {

        $post = $loginDal->UserRegister($_POST['registerFirstName'], $_POST['registerLastName'], $_POST['registerEmail'], $_POST['registerPassword']);
        header('Location: ../View/RegistrationSuccess.php');
    }

    else{
        echo "<script>alert('Email is already in use')</script>";
    }
};


?>
