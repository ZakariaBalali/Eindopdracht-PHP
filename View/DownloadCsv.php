<?php
require_once '../Logic/LoginLogic.php';
require_once '../Logic/UserLogic.php';

$users = [];
$userLogic = new UserLogic();
$users = (array)$userLogic->GetAllUsers();

$data = "ID,FirstName,LastName,Email,IsAdmin\n";

foreach ($users as $user) {
    $data .=
        $user->getUserID() . "," .
        $user->getFirstName() . "," .
        $user->getLastName() . "," .
        $user->getEmail() . "," .
        $user->getIsAdmin() . "\"\n";
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"my-data.csv\"");

echo $data;
?>