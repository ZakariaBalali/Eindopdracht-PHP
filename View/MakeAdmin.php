<?php
require_once '../Logic/LoginLogic.php';
require_once '../Logic/UserLogic.php';

$userLogic = new UserLogic();
$user = $userLogic->SearchUserByEmail($_SESSION['email']);


//checks if user is logged in and is admin
if (!isset($_SESSION['LoggedIn']) || $user[0]->getIsAdmin() == 0) {
    header('Location: ../View/Homepage.php');
}
else {
    $id = $_GET['UserID'];

    if ($userLogic->MakeAdmin($id)) {
        header('Location: ../View/AdministrationUsers.php');
        echo 'User succesfully deleted';
    } else {
        echo "<script>alert('There was en error while granting admin status to user')</script>";
    }
}
?>