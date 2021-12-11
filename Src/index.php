<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<h1>Main Page</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <input type="submit" value="Register" name="AccountSubmit"> 
    <input type="submit" value="Login" name="AccountSubmit">
</form>

<?php
if(isset($_POST['AccountSubmit']))
{
    $accountPage = $_POST['AccountSubmit'];
    if($accountPage == 'Register')
    {
        include('pages/Register.php');
    }
    else if($accountPage == 'Login')
    {
        include('pages/Login.php');
    }
    else
    {
        echo '<p>ERROR!</p>';
    }
}

?>

</body>
</html>