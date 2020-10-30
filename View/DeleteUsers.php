<?php
require_once '../Logic/LoginLogic.php';
require '../Logic/UserLogic.php';

$userLogic = new UserLogic();
//checks if user is logged in
if (! isset($_SESSION['LoggedIn'])){
    header('Location: ../View/Login.php');
}
else {
    $id = $_GET['UserID'];

    if ($userLogic->DeleteUser($id)) {
        header('Location: ../View/AdministrationUsers.php');
    } else {
        echo "<script>alert('There was en error while removing the user')</script>";
    }
}
?>