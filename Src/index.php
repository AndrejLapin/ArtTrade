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

<h1>Main Page</h1>
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
    echo '<input type="submit" value="Register" name="AccountSubmit"> 
    <input type="submit" value="Login" name="AccountSubmit">';

    // log out button gets enabled
    if(isset($_SESSION['Current_user_ID']) && $_SESSION['Current_user_ID'] != 0)
    echo '<input type="submit" value="LogOut" name="AccountSubmit">'; ?>
</form>

<?php

if(isset($_POST['AccountSubmit']))
{
    $accountPage = $_POST['AccountSubmit'];
    if($accountPage == 'Register' && (!isset($_SESSION['Current_user_ID']) || $_SESSION['Current_user_ID'] == 0))
    {
        include('pages/Register.php');
    }
    else if($accountPage == 'Login' && (!isset($_SESSION['Current_user_ID']) || $_SESSION['Current_user_ID'] == 0))
    {
        include('pages/Login.php');
    }
    else if($accountPage == 'LogOut')
    {
        $_SESSION['Current_user_ID'] = 0;
        $_SESSION['User_Name'] = '';
        $_SESSION['Currency_Balance'] = 0;
        $_SESSION['Owned_Art_Amount'] = 0;

        header("Location: http://localhost/ArtTrade/Src/");
    }
    else
    {
        echo '<p>ERROR!</p>';
    }
}

?>

</body>
</html>