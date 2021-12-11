<?php
session_start();
require("functions.php");

?>

<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
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

<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
<?php 
    // log in and register buttons get enabled
    if(!isset($_SESSION['Current_user_ID']) || $_SESSION['Current_user_ID'] == 0)
    echo '  <input type="submit" value="Register" name="MenuAction"> 
            <input type="submit" value="Login" name="MenuAction">';

    // log out button gets enabled
    if(isset($_SESSION['Current_user_ID']) && $_SESSION['Current_user_ID'] != 0)
    echo '  <input type="submit" value="LogOut" name="MenuAction">
            <input type="submit" value="Upload Art" name="MenuAction">'; ?>
</form>

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
}//a

?>

</body>
</html>