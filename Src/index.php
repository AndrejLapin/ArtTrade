<?php
session_start();
require("functions.php");

?>

<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>

<!--<h1>Main Page</h1>-->
<p>Menu</p>
<?php

if(!isset($_SESSION['Current_user_ID'])) $_SESSION['Current_user_ID'] = 0;
echo '<p> Current userId: '.$_SESSION['Current_user_ID'] .'</p>'; // should be hidden from users, now only for debugging
if($_SESSION['Current_user_ID'] != 0)
{
    echo '<p>'.$_SESSION['User_Name'].' balance:'.$_SESSION['Currency_Balance'].' coins, art pecies owned: '.$_SESSION['Owned_Art_Amount'].'</p>';
}
?>
<div class="w3-bar w3-border w3-light-grey">
    <div class="w3-bar-item">NFTCAP</div>
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
<?php 
    // log in and register buttons get enabled
    if(!isset($_SESSION['Current_user_ID']) || $_SESSION['Current_user_ID'] == 0)
    echo '  <input class="w3-button w3-white w3-right" type="submit" value="Register" name="MenuAction"> 
            <input class="w3-button w3-white w3-right" type="submit" value="Login" name="MenuAction">';

    // log out button gets enabled
    if(isset($_SESSION['Current_user_ID']) && $_SESSION['Current_user_ID'] != 0)
    echo '  <input class="w3-button w3-white w3-right" type="submit" value="LogOut" name="MenuAction">
            <input class="w3-button w3-white w3-right" type="submit" value="Upload Art" name="MenuAction">'; ?>
</form>
</div>


<?php

if(isset($_POST['MenuAction']))
{
    $menu_action = $_POST['MenuAction'];
    if($menu_action == 'Register' && (!isset($_SESSION['Current_user_ID']) || $_SESSION['Current_user_ID'] == 0))
    {
        include('pages/Register.php');
    }
    else if($menu_action == 'Login' && (!isset($_SESSION['Current_user_ID']) || $_SESSION['Current_user_ID'] == 0))
    {
        include('pages/Login.php');
    }
    else if($menu_action == 'LogOut')
    {
        $_SESSION['Current_user_ID'] = 0;
        $_SESSION['User_Name'] = '';
        $_SESSION['Currency_Balance'] = 0;
        $_SESSION['Owned_Art_Amount'] = 0;

        //header("Location: http://localhost/ArtTrade/Src/");
        header("Refresh:0");
    }
    else if($menu_action == 'Upload Art' && isset($_SESSION['Current_user_ID']) && $_SESSION['Current_user_ID'] != 0)
    {
        include('pages/UploadArt.php');
    }
    else
    {
        echo '<p>ERROR!</p>';
    }
}

?>
<!-- Footer -->
<footer class="w3-center w3-light-grey w3-topbar w3-padding-32">
  <p>NFTCAPⒸ2021. Visos teisės saugomos.</p>
</footer>

</body>
</html>