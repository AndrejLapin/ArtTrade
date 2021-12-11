<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<h1>This is a Heading</h1>

<p>This is a paragraph.What</p>
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
        include('files/Register.php');
    }
    else if($accountPage == 'Login')
    {
        include('files/Login.php');
    }
    else
    {
        echo '<p>ERROR!</p>';
    }
}

?>

</body>
</html>