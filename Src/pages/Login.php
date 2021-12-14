<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>

<?php
//require("functions.php");
$name = $name_error = $password = $password_error = "";
$name_not_empty = false;

$db_connection = Connect_to_project_db();

if(isset($_POST["name"]))
{
    if(empty($_POST["name"]))
    {
        $name_error = "To log in you must enter your User Name";
    }
    else
    {
        $name_not_empty = true;
    }
}

if(isset($_POST["password"]))
{
    if(empty($_POST["password"]))
    {
        $password_error = "To log in you must enter your Password";
    }
    else if($name_not_empty)
    {
        Login_user($db_connection, $_POST["name"], $_POST["password"]);
    }
}
?>

<h1 class="w3-container w3-white w3-padding-16">Login</h1>
<form class="w3-container w3-padding-32" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
<<<<<<< HEAD
  Username: <input class="w3-input" type="text" name="name" value="<?php echo $name;?>">
  <span class="error"> <?php echo $name_error;?></span>
=======
  User Name: <input class="w3-input" type="text" name="name" value="<?php echo $name;?>">
  <p class="w3-red"> <?php echo $name_error;?></p>
>>>>>>> 1dd9c739e63a9f3da240bfff8532c04854ea257d
  <br><br>
  Password: <input class="w3-input" type="password" name="password" value="<?php echo $password;?>">
  <p class="w3-red"> <?php echo $password_error;?></p>
  <br><br>
  <input class="w3-btn w3-blue-grey" type="submit" name="MenuAction" value="Login">  
</form>

</body>
</html>