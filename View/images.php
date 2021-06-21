<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <meta name="description" content="Flight Tickets">
    <meta name="keywords" content="keyword1, keyword2, keyword3">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
require_once '../Logic/LoginLogic.php';
require_once '../Logic/UserLogic.php';
?>

<section class="topnav">
    <img src="images/logo.png" alt="Airplane" title="AirplaneLogo" class="logoImage">
    <a href="Homepage.php">Home</a>
    <?php
    if (isset($_SESSION['LoggedIn'])) {
        $user = $userLogic->SearchUserByEmail($_SESSION['email']);
        if ($user[0]->getIsAdmin() == 1) {
            echo '<a href="AdministrationUsers.php">Admin</a>';
        }


    }
    ?>
    <a href="TicketPage.php">Tickets</a>
    <a class="active" href="images.php">Upload images</a>

    <section class="topnavRight">

        <?php
        //checks if user is logged in and shows corresponding buttons
        if (isset($_SESSION['LoggedIn'])) {

            echo '<a href="Logout.php">Logout</a>';
        } else {
            echo '<a href="Register.php">Register</a>';
            echo '<a href="Login.php">Login</a>';
        }

        ?>
        <a href="Shoppingcart.php">Shopping Cart</a>
    </section>
</section>


<h1>Files</h1>
<?php
$dir = 'uploads/';
// Sort in ascending order - this is default
$files = scandir($dir, 1);

?>
<br>
<h1>UPLOAD FILES</h1> <br>
<form action="Upload.php" method="post" enctype="multipart/form-data"> Select image to upload:<input
            type="file" name="fileToUpload" id="fileToUpload"><input type="submit" value="Upload
Image" name="submit"></form>

<h1>Uploaded images</h1> <br>
<?php
foreach ($files as $file) {
    if (getimagesize($dir . $file) !== false) {
        ?>

        <img class="uploadedImage" src="<?php echo $dir;
        echo $file; ?>"</img><?php
    }
} ?>


</body>
</html>
