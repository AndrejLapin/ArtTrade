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

<h1>Login</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  User Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error"> <?php echo $name_error;?></span>
  <br><br>
  Password: <input type="password" name="password" value="<?php echo $password;?>">
  <span class="error"> <?php echo $password_error;?></span>
  <br><br>
  <input type="submit" name="AccountSubmit" value="Login">  
</form>

</body>
</html>